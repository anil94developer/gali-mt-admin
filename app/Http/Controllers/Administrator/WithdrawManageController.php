<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StarlineGameRate;
use App\Models\Result;
use App\Models\Point;
use App\Models\PointTable;
use App\Models\Market;
use App\Models\User;
use App\Models\Walletreport;
use App\Models\BlockUser;
use App\Models\BonusReport;
use Session;
use Hash;
use URL;
use DB;
use App\Helpers\Helper;
use Carbon\Carbon;
use MongoDB\BSON\ObjectId;

class WithdrawManageController extends Controller
{
    public function __construct()
    {

    }

    private function normalizeMongoRouteId($id): ?string
    {
        if ($id === null || $id === '') {
            return null;
        }

        if (is_array($id)) {
            foreach ($id as $value) {
                $normalized = $this->normalizeMongoRouteId($value);
                if ($normalized !== null && $normalized !== '') {
                    return $normalized;
                }
            }

            return null;
        }

        if (is_object($id)) {
            if (method_exists($id, '__toString')) {
                $id = (string) $id;
            } elseif (property_exists($id, '$oid')) {
                $id = $id->{'$oid'};
            } elseif (property_exists($id, 'oid')) {
                $id = $id->oid;
            } else {
                $id = json_encode($id);
            }
        }

        $id = trim((string) $id);

        if ($id === '' || $id === '[object Object]') {
            return null;
        }

        if (preg_match('/ObjectId\(["\']?([a-f0-9]{24})["\']?\)/i', $id, $matches)) {
            return $matches[1];
        }

        if (preg_match('/"\\$oid"\s*:\s*"([a-f0-9]{24})"/i', $id, $matches)) {
            return $matches[1];
        }

        return trim($id, "\"'");
    }

    private function collectWithdrawLookupCandidates($input): array
    {
        $values = is_array($input) ? $input : [$input];
        $candidates = [];

        foreach ($values as $value) {
            $normalized = $this->normalizeMongoRouteId($value);
            if ($normalized !== null && $normalized !== '') {
                $candidates[] = $normalized;
            }
        }

        return array_values(array_unique(array_filter($candidates, function ($value) {
            return $value !== '';
        })));
    }

    private function stringifyWithdrawRequestIds(array $values): string
    {
        $flatValues = [];

        foreach ($values as $value) {
            if (is_array($value)) {
                foreach ($value as $nestedValue) {
                    $normalized = $this->normalizeMongoRouteId($nestedValue);
                    if ($normalized !== null && $normalized !== '') {
                        $flatValues[] = $normalized;
                    }
                }
                continue;
            }

            $normalized = $this->normalizeMongoRouteId($value);
            if ($normalized !== null && $normalized !== '') {
                $flatValues[] = $normalized;
            }
        }

        return implode(', ', array_values(array_unique($flatValues)));
    }

    private function decodeWithdrawToken(Request $request): array
    {
        $token = $this->withdrawRequestValue($request, 'token');

        if (empty($token) || !is_string($token)) {
            return [];
        }

        $decoded = base64_decode($token, true);
        if ($decoded === false) {
            return [];
        }

        $payload = json_decode($decoded, true);

        return is_array($payload) ? $payload : [];
    }

    private function withdrawRequestValue(Request $request, string $key, $default = null)
    {
        $value = $request->input($key);
        if ($value !== null && $value !== '') {
            return $value;
        }

        $nestedValue = $request->input('id.' . $key);
        if ($nestedValue !== null && $nestedValue !== '') {
            return $nestedValue;
        }

        return $default;
    }

    private function findWithdrawPointByRouteId($id)
    {
        $candidates = $this->collectWithdrawLookupCandidates($id);

        if (empty($candidates)) {
            return null;
        }

        foreach ($candidates as $candidate) {
            $point = PointTable::find($candidate);
            if ($point) {
                return $point;
            }

            $point = PointTable::where('_id', $candidate)->first();
            if ($point) {
                return $point;
            }

            $point = PointTable::where('id', $candidate)->first();
            if ($point) {
                return $point;
            }

            $point = PointTable::where('uniquid', $candidate)->first();
            if ($point) {
                return $point;
            }

            $point = PointTable::where('transaction_id', $candidate)->first();
            if ($point) {
                return $point;
            }

            if (is_numeric($candidate)) {
                $point = PointTable::where('id', (int) $candidate)->first();
                if ($point) {
                    return $point;
                }
            }

            if (preg_match('/^[a-f\d]{24}$/i', $candidate)) {
                try {
                    $point = PointTable::where('_id', new ObjectId($candidate))->first();
                    if ($point) {
                        return $point;
                    }
                } catch (\Throwable $e) {
                    // invalid ObjectId
                }
            }
        }

        return null;
    }

    private function findWithdrawPointByRequest(Request $request)
    {
        $tokenPayload = $this->decodeWithdrawToken($request);

        $point = $this->findWithdrawPointByRouteId([
            $this->withdrawRequestValue($request, 'id'),
            $this->withdrawRequestValue($request, 'legacy_id'),
            $this->withdrawRequestValue($request, 'mongo_id'),
            $this->withdrawRequestValue($request, 'uniquid'),
            $this->withdrawRequestValue($request, 'transaction_id'),
            $tokenPayload['id'] ?? null,
            $tokenPayload['legacy_id'] ?? null,
            $tokenPayload['mongo_id'] ?? null,
            $tokenPayload['uniquid'] ?? null,
            $tokenPayload['transaction_id'] ?? null,
        ]);

        if ($point) {
            return $point;
        }

        $transactionId = trim((string) ($this->withdrawRequestValue($request, 'transaction_id') ?: ($tokenPayload['transaction_id'] ?? '')));
        $userId = trim((string) ($this->withdrawRequestValue($request, 'user_id') ?: ($tokenPayload['user_id'] ?? '')));
        $requestTrValue = $this->withdrawRequestValue($request, 'tr_value');
        $trValue = ($requestTrValue !== null && $requestTrValue !== '') ? $requestTrValue : ($tokenPayload['tr_value'] ?? null);
        $date = trim((string) ($this->withdrawRequestValue($request, 'date') ?: ($tokenPayload['date'] ?? '')));
        $accountNo = trim((string) ($this->withdrawRequestValue($request, 'account_no') ?: ($tokenPayload['account_no'] ?? '')));

        foreach ([PointTable::class] as $modelClass) {
            if (!empty($transactionId) && !empty($userId)) {
                $point = $modelClass::where('transaction_id', $transactionId)
                    ->where('user_id', $userId)
                    ->where('tr_nature', 'TRWITH003')
                    ->where('tr_status', 'Pending')
                    ->first();

                if ($point) {
                    return $point;
                }
            }

            if (!empty($userId) && $trValue !== null && $trValue !== '') {
                $query = $modelClass::where('user_id', $userId)
                    ->where('tr_nature', 'TRWITH003')
                    ->where('tr_status', 'Pending');

                if (!empty($date)) {
                    $query->where('date', $date);
                }

                if (!empty($accountNo)) {
                    $query->where('account_no', $accountNo);
                }

                $amountCandidates = array_values(array_unique(array_filter([
                    $trValue,
                    (string) $trValue,
                    (int) $trValue,
                    (float) $trValue,
                ], function ($value) {
                    return $value !== null && $value !== '';
                })));

                foreach ($amountCandidates as $amountCandidate) {
                    $point = (clone $query)->where('tr_value', $amountCandidate)->orderBy('created_at', 'desc')->first();
                    if ($point) {
                        return $point;
                    }
                }

                $point = $query->orderBy('created_at', 'desc')->first();

                if ($point) {
                    return $point;
                }
            }

            if (!empty($accountNo) && !empty($date) && $trValue !== null && $trValue !== '') {
                $baseQuery = $modelClass::where('tr_nature', 'TRWITH003')
                    ->where('tr_status', 'Pending')
                    ->where('account_no', $accountNo)
                    ->where('date', $date);

                $amountCandidates = array_values(array_unique(array_filter([
                    $trValue,
                    (string) $trValue,
                    (int) $trValue,
                    (float) $trValue,
                ], function ($value) {
                    return $value !== null && $value !== '';
                })));

                foreach ($amountCandidates as $amountCandidate) {
                    $point = (clone $baseQuery)->where('tr_value', $amountCandidate)->orderBy('created_at', 'desc')->first();
                    if ($point) {
                        return $point;
                    }
                }
            }
        }

        return null;
    }

    private function updatePendingWithdrawByRequest(Request $request, array $fields)
    {
        $tokenPayload = $this->decodeWithdrawToken($request);

        $transactionId = trim((string) ($this->withdrawRequestValue($request, 'transaction_id') ?: ($tokenPayload['transaction_id'] ?? '')));
        $userId = trim((string) (($this->withdrawRequestValue($request, 'resolved_user_id') ?: ($tokenPayload['resolved_user_id'] ?? null)) ?: ($this->withdrawRequestValue($request, 'user_id') ?: ($tokenPayload['user_id'] ?? ''))));
        $requestTrValue = $this->withdrawRequestValue($request, 'tr_value');
        $trValue = ($requestTrValue !== null && $requestTrValue !== '') ? $requestTrValue : ($tokenPayload['tr_value'] ?? null);
        $date = trim((string) ($this->withdrawRequestValue($request, 'date') ?: ($tokenPayload['date'] ?? '')));
        $accountNo = trim((string) ($this->withdrawRequestValue($request, 'account_no') ?: ($tokenPayload['account_no'] ?? '')));

        $amountCandidates = array_values(array_unique(array_filter([
            $trValue,
            (string) $trValue,
            (int) $trValue,
            (float) $trValue,
        ], function ($value) {
            return $value !== null && $value !== '';
        })));

        $queries = [];

        if ($transactionId !== '' && $userId !== '') {
            $queries[] = PointTable::where('transaction_id', $transactionId)
                ->where('user_id', $userId)
                ->where('tr_nature', 'TRWITH003')
                ->where('tr_status', 'Pending');
        }

        if ($accountNo !== '' && $date !== '' && !empty($amountCandidates)) {
            foreach ($amountCandidates as $amountCandidate) {
                $query = PointTable::where('account_no', $accountNo)
                    ->where('date', $date)
                    ->where('tr_nature', 'TRWITH003')
                    ->where('tr_status', 'Pending')
                    ->where('tr_value', $amountCandidate);

                if ($userId !== '') {
                    $query->where('user_id', $userId);
                }

                $queries[] = $query;
            }
        }

        if ($transactionId !== '' && $date !== '' && !empty($amountCandidates)) {
            foreach ($amountCandidates as $amountCandidate) {
                $query = PointTable::where('transaction_id', $transactionId)
                    ->where('date', $date)
                    ->where('tr_nature', 'TRWITH003')
                    ->where('tr_status', 'Pending')
                    ->where('tr_value', $amountCandidate);

                if ($userId !== '') {
                    $query->where('user_id', $userId);
                }

                $queries[] = $query;
            }
        }

        foreach ($queries as $query) {
            $point = (clone $query)->orderBy('created_at', 'desc')->first();
            if ($point) {
                $updated = (clone $query)->update($fields) > 0;
                if (!$updated) {
                    foreach ($fields as $field => $value) {
                        $point->{$field} = $value;
                    }
                    $updated = $point->save();
                }

                if ($updated) {
                    foreach ($fields as $field => $value) {
                        $point->{$field} = $value;
                    }
                    return $point;
                }
            }
        }

        return null;
    }

    private function findWithdrawUser($point, Request $request)
    {
        $tokenPayload = $this->decodeWithdrawToken($request);

        if ($point && !empty($point->user_data)) {
            return $point->user_data;
        }

        $candidates = array_values(array_unique(array_filter([
            $point->user_id ?? null,
            !empty($point->user_data) ? ($point->user_data->user_id ?? null) : null,
            !empty($point->user_data) ? ($point->user_data->mob ?? null) : null,
            $this->withdrawRequestValue($request, 'user_id'),
            $this->withdrawRequestValue($request, 'resolved_user_id'),
            $this->withdrawRequestValue($request, 'user_mob'),
            $tokenPayload['user_id'] ?? null,
            $tokenPayload['resolved_user_id'] ?? null,
            $tokenPayload['user_mob'] ?? null,
        ], function ($value) {
            return $value !== null && $value !== '';
        })));

        foreach ($candidates as $candidate) {
            $user = User::where('user_id', $candidate)->first();
            if ($user) {
                return $user;
            }

            $user = User::where('user_id', (string) $candidate)->first();
            if ($user) {
                return $user;
            }

            $trimmedCandidate = trim((string) $candidate);
            $user = User::where('user_id', 'regexp', '^' . preg_quote($trimmedCandidate, '/') . '$')->first();
            if ($user) {
                return $user;
            }

            $user = User::where('mob', $trimmedCandidate)->first();
            if ($user) {
                return $user;
            }

            $user = User::where('mob', 'regexp', '^' . preg_quote($trimmedCandidate, '/') . '$')->first();
            if ($user) {
                return $user;
            }

            $digitCandidate = preg_replace('/\D+/', '', $trimmedCandidate);
            if ($digitCandidate !== '') {
                $user = User::where('user_id', $digitCandidate)->first();
                if ($user) {
                    return $user;
                }

                $user = User::where('mob', $digitCandidate)->first();
                if ($user) {
                    return $user;
                }

                $user = User::where('user_id', 'regexp', preg_quote($digitCandidate, '/'))->first();
                if ($user) {
                    return $user;
                }

                $user = User::where('mob', 'regexp', preg_quote($digitCandidate, '/'))->first();
                if ($user) {
                    return $user;
                }
            }

            if (preg_match('/^[a-f\d]{24}$/i', $trimmedCandidate)) {
                try {
                    $user = User::where('_id', new ObjectId($trimmedCandidate))->first();
                    if ($user) {
                        return $user;
                    }
                } catch (\Throwable $e) {
                    // invalid ObjectId
                }

                $user = User::where('_id', $trimmedCandidate)->first();
                if ($user) {
                    return $user;
                }
            }
        }

        return null;
    }

    private function updateWithdrawPointFields($point, array $fields): bool
    {
        $updated = false;
        $mongoId = $point->getOriginal('_id') ?? $point->_id ?? null;
        $modelClass = get_class($point);

        if ($mongoId !== null) {
            if (is_object($mongoId)) {
                $updated = $modelClass::where('_id', $mongoId)->update($fields) > 0;
            } elseif (is_string($mongoId) && preg_match('/^[a-f\d]{24}$/i', $mongoId)) {
                $result = $modelClass::raw(function ($collection) use ($mongoId, $fields) {
                    try {
                        return $collection->updateOne(
                            [
                                '$or' => [
                                    ['_id' => $mongoId],
                                    ['_id' => new ObjectId($mongoId)],
                                ],
                            ],
                            ['$set' => $fields]
                        );
                    } catch (\Throwable $e) {
                        return $collection->updateOne(['_id' => $mongoId], ['$set' => $fields]);
                    }
                });

                $updated = method_exists($result, 'getModifiedCount')
                    ? ($result->getModifiedCount() > 0 || $result->getMatchedCount() > 0)
                    : (bool) $result;
            } else {
                $updated = $modelClass::where('_id', $mongoId)->update($fields) > 0;
            }
        }

        if (!$updated && !empty($point->id)) {
            $updated = $modelClass::where('id', $point->id)->update($fields) > 0;
        }

        if (!$updated && !empty($point->uniquid)) {
            $updated = $modelClass::where('uniquid', $point->uniquid)->update($fields) > 0;
        }

        if (!$updated) {
            foreach ($fields as $field => $value) {
                $point->{$field} = $value;
            }
            $updated = $point->save();
        }

        return (bool) $updated;
    }

    private function withdrawActionId($point): string
    {
        if (!empty($point->uniquid)) {
            return (string) $point->uniquid;
        }

        if (!empty($point->id)) {
            return (string) $point->id;
        }

        return $this->normalizeMongoRouteId($point->getOriginal('_id') ?? $point->_id ?? '') ?? '';
    }

    private function withdrawActionPayload($point): array
    {
        $payload = [
            'id' => $this->withdrawActionId($point),
            'legacy_id' => !empty($point->id) ? (string) $point->id : '',
            'mongo_id' => $this->normalizeMongoRouteId($point->getOriginal('_id') ?? $point->_id ?? '') ?? '',
            'uniquid' => !empty($point->uniquid) ? (string) $point->uniquid : '',
            'transaction_id' => !empty($point->transaction_id) ? (string) $point->transaction_id : '',
            'user_id' => !empty($point->user_id) ? (string) $point->user_id : '',
            'resolved_user_id' => !empty($point->user_data) && !empty($point->user_data->user_id) ? (string) $point->user_data->user_id : '',
            'user_mob' => !empty($point->user_data) && !empty($point->user_data->mob) ? (string) $point->user_data->mob : '',
            'tr_value' => $point->tr_value ?? '',
            'date' => !empty($point->date) ? (string) $point->date : '',
            'account_no' => !empty($point->account_no) ? (string) $point->account_no : '',
        ];

        $payload['token'] = base64_encode(json_encode($payload));

        return $payload;
    }

    /*-------Show List Page ---------*/
    public function index()
    {
        return view('administrator.galidisawar.index');
    }
    
    public function withdraw_dateway_pending()
    {      
        return view('administrator.withdraw.datewaypending');
    }
    public function withdraw_pending()
    {      
        return view('administrator.withdraw.pending');
    }
    public function withdraw_success()
    {
        
        return view('administrator.withdraw.success');  
    }
   
    public function withdraw_cancelled()
    {
        return view('administrator.withdraw.cancelled');
    }
    
    public function WithdrawManageData(Request $request)
    {
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table._id',
            1 => 'point_table.tr_value',
            2 => 'point_table.tr_status',
            3 => 'point_table.date',
            4 => 'point_table.tr_nature',
        );
        $totalItems = PointTable::where('tr_nature', 'TRWITH003')->where('tr_status', 'Pending')->count();
        $totalFiltered = $totalItems;
        $items = PointTable::with('user_data')->where('tr_nature', 'TRWITH003')->where('tr_status', 'Pending')->orderBy('created_at', 'desc');

        /*if ($requestData['search']['value']) {
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'Like','%'.$filtered.'%')->orwhere('mob', 'Like','%'.$filtered.'%');
            });
        }*/
        if (!empty($requestData['search']['value'])) {
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'like', '%' . $filtered . '%')
                  ->orWhere('mob', 'like', '%' . $filtered . '%');
            });
        }

        if (!empty($request->market_date)) {
            $date = Carbon::parse($request->market_date);
            $startOfDay = $date->startOfDay();
            $endOfDay = $date->endOfDay();
    
            $items = $items->where('date',date('d-m-Y',strtotime($request->market_date)));
        }

        if ($request->orderBy) {
            $items = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // dd($items);
        foreach ($items as $item) {
            $i++;
            $actionPayload = $this->withdrawActionPayload($item);
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->FullName;
            $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->mob;
            $nestedData[] = $item->account_no;
            $nestedData[] = $item->ifsc_code;
            $nestedData[] = $item->upi_id ?? "N/A";
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("h:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));
            $nestedData[] = $item->tr_status;
            
            // $approve = '<a href="' . url('/administrator/withdraw-approve/' . $item->id) . '" onclick="approvedwidth(' . $item->id . ',this)" title="Approve"><button onclick="javascript=this.disabled = true" class="btn btn-warning ">Approve</button></a>';

            $approve = '<a href="javascript:void(0);" onclick=\'approvedwidth(' . json_encode($actionPayload) . ', this)\' title="Approve"><button type="button" class="btn btn-warning">Approve</button></a>';
            $cancelled = '<a href="javascript:void(0);" onclick=\'cancelledwidth(' . json_encode($actionPayload) . ', this)\' title="Cancelled">
                <button type="button" class="btn btn-primary">Cancelled</button>
              </a>';


            // $deleteLink = '<a href="' . url('/administrator/delete/' . $item->id) . ' " onclick="return confirm("Are you sure want to delete?")" title="Delete"><button class="btn btn-info "><i class="icon-trash"></i></button></a>';
            // $cancelled = '<a href="' . url('/administrator/withdraw-cancelled/' . $item->id) . ' " title="Cancelled"><button onclick="javascript=this.disabled = true" class="btn btn-primary">Cancelled</button></a>';
            $nestedData[] = $cancelled . " " . $approve;
            // $nestedData[] = $ViewLink . " " . $editLink . "  " . $deleteLink . " " . $result . " " . $history;
            $datas[] = $nestedData;
        };

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );

        echo json_encode($json_data);
    }

    public function DateWithdrawManageData(Request $request)
    {   
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table._id',
            1 => 'point_table.tr_value',
            2 => 'point_table.user_id',
            3 => 'point_table.tr_status',
            4 => 'point_table.date',
            5 => 'point_table.tr_nature',
        );

        $totalItems = PointTable::where('tr_status','Success')->where('tr_nature','TRWITH003')->groupBy("date")->get()->count();
        $totalFiltered = $totalItems;
        $items = PointTable::orderBy('created_at', 'desc')->where('tr_nature','TRWITH003')->where('tr_status','Success')->groupBy("date");
        
        
        if (!empty($request->withdraw_date)) {
            $format_date=date("d-m-Y", strtotime($request->withdraw_date));
            $items = PointTable::where('date',$format_date)->where('tr_nature', 'TRWITH003')->where('tr_status','Success')->groupBy("date");
        }

        if ($requestData['search']['value']) {
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('date', 'Like','%'.$filtered.'%')->orwhere('mob', 'Like','%'.$filtered.'%');
            });
        }
        if (!empty($requestData['search']['value'])) {
            $filtered = $requestData['search']['value'];
            $items = $items->where('date', 'Like','%'.$filtered.'%')->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'like', '%' . $filtered . '%')
                  ->orWhere('mob', 'like', '%' . $filtered . '%');
            });
        }

        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }

        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;

        foreach ($items as $item) {
            //PointTable::where('tr_status','Success')->groupBy("date")->sum('tr_value');
            $i++;
            $date = $item->date;
            $nestedData = array();
            $nestedData[] = $i;
            // $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->FullName;
            // $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->mob;
            $widthraw_amount=Helper::widthrawamout($date);
            //dd($profit_loss);
            $nestedData[] =$widthraw_amount;
            $widthraw_amount_count=Helper::widthrawamout_count($date);
            $nestedData[] =$widthraw_amount_count;
            // $nestedData[] = $item->tr_remark;
            $nestedData[] = date("d-m-Y", strtotime($item->date));
            // $nestedData[] = date("h:i:s A", strtotime($item->created_at));
            //dd($profit_loss);
            $nestedData[] = $item->tr_status;
            $ViewLink = '<a href="' . url('/administrator/game/withdraw-success-view/'.date("Y-m-d", strtotime($item->date))). ' " title="View"><button class="btn btn-primary">View</button></a>';
            $nestedData[] = $ViewLink;
            $datas[] = $nestedData;
        };

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );

        echo json_encode($json_data);
    }

    public function withdraw_success_view($date)
    {
        $date =  date("d-m-Y", strtotime($date));
        $select = PointTable::where('tr_status','Success')->where('tr_nature','TRWITH003')->where('date',$date)->get();
        // dd($select);
        return view('administrator.withdraw.view',compact('select'));
    }



    public function withdraw_view_dataa($id)
    {
        // dd($id);
        // $select = PointTable::where('id', $request->id)->first();
        // $select = PointTable::findOrFail($id);
        $select = PointTable::where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),$id)->where('tr_status','Success')->get();
        // dd($select);
        return view('administrator.withdraw.view',compact('select'));  
    }



    public function withdraw_cancel(Request $request)
    {
        $point = $this->findWithdrawPointByRequest($request);
        $tokenPayload = $this->decodeWithdrawToken($request);
        $requestTrValue = ($request->tr_value !== null && $request->tr_value !== '') ? $request->tr_value : ($tokenPayload['tr_value'] ?? 0);

        $user = $this->findWithdrawUser($point, $request);

        if (!$user) {
            $message = 'User not found.';
            return $request->ajax()
                ? response()->json(['message' => $message], 404)
                : back()->with('error_message', $message);
        }

        $withdrawAmount = $point->tr_value ?? $requestTrValue ?? 0;
        $user->win_amount = ($user->win_amount ?? 0) + $withdrawAmount;
        $user->save();

        $fields = [
            'tr_status' => 'Cancelled',
            'tr_value_updated' => $user->win_amount,
        ];

        if ($point) {
            $this->updateWithdrawPointFields($point, $fields);
        } else {
            $point = $this->updatePendingWithdrawByRequest($request, $fields);
        }

        if (!$point) {
            $message = 'Invalid withdrawal request. Received IDs: ' . $this->stringifyWithdrawRequestIds([
                $request->id,
                $request->legacy_id,
                $request->mongo_id,
                $request->uniquid,
                $request->transaction_id,
                $request->user_id,
                $request->tr_value,
                $request->date,
                $request->account_no,
                $request->token,
            ]);
            return $request->ajax()
                ? response()->json(['message' => $message], 404)
                : back()->with('error_message', $message);
        }

        $message = 'Withdrawal status updated to Cancelled successfully.';

        return $request->ajax()
            ? response()->json(['message' => $message])
            : redirect('administrator/game/withdraw-pending')->with('success_message', $message);
    }
    public function withdraw_approve(Request $request){
        $request->validate([
            'id' => ['required'],
        ]);

        $point = $this->findWithdrawPointByRequest($request);
        $tokenPayload = $this->decodeWithdrawToken($request);
        $requestUserId = trim((string) (($point->user_id ?? null) ?: ($request->user_id ?: ($tokenPayload['user_id'] ?? ''))));
        $requestTrValue = ($request->tr_value !== null && $request->tr_value !== '') ? $request->tr_value : ($tokenPayload['tr_value'] ?? 0);

        $user = $this->findWithdrawUser($point, $request);
        if (!$user) {
            $message = 'User not found.';
            return $request->ajax()
                ? response()->json(['message' => $message], 404)
                : back()->with('error_message', $message);
        }

        $updatedBalance = (int) (($user->credit ?? 0) + ($user->win_amount ?? 0));

        $walletData = [
            'user_id' => $point->user_id ?? $requestUserId,
            'app_id' => $point->app_id ?? 'com.dubaiking',
            'transaction_id' => $point->transaction_id ?? ($request->transaction_id ?: ($tokenPayload['transaction_id'] ?? '')),
            'tr_value' => $point->tr_value ?? $requestTrValue,
            'tr_status' => 'Success',
            'tr_nature' => 'TRWITH003',
            'type' => 'Debit',
            'tr_remark' => $point->tr_remark ?? 'Withdraw Approved',
            'date' => Carbon::now()->format('d-m-Y'),
            'date_time' => !empty($point->date_time)
                ? Carbon::parse($point->date_time)->format('Y-m-d H:i:s')
                : Carbon::now()->format('Y-m-d H:i:s'),
            'value_update_by' => 'Withdraw',
            'tr_value_updated' => $updatedBalance,
            'point_table_id' => $point->uniquid ?? (string) ($point->_id ?? ''),
        ];

        $fields = [
            'tr_status' => 'Success',
            'tr_value_updated' => $updatedBalance,
        ];

        if ($point) {
            $updated = $this->updateWithdrawPointFields($point, $fields);
        } else {
            $point = $this->updatePendingWithdrawByRequest($request, $fields);
            $updated = (bool) $point;
            if ($point && empty($walletData['point_table_id'])) {
                $walletData['point_table_id'] = $point->uniquid ?? (string) ($point->_id ?? '');
            }
        }

        if (!$updated) {
            $message = 'Invalid withdrawal request. Received IDs: ' . $this->stringifyWithdrawRequestIds([
                $request->id,
                $request->legacy_id,
                $request->mongo_id,
                $request->uniquid,
                $request->transaction_id,
                $request->user_id,
                $request->tr_value,
                $request->date,
                $request->account_no,
                $request->token,
            ]);
            return $request->ajax()
                ? response()->json(['message' => $message], 404)
                : back()->with('error_message', $message);
        }

        Walletreport::create($walletData);

        $message = 'Withdrawal status updated to Success successfully.';

        return $request->ajax()
            ? response()->json(['message' => $message])
            : redirect('administrator/game/withdraw-pending')->with('success_message', $message);
    }
    
    public function withdraw_reverse($id){
        $updated = false;

        if (preg_match('/^[a-f\d]{24}$/i', (string) $id)) {
            $result = PointTable::raw(function ($collection) use ($id) {
                try {
                    return $collection->updateOne(
                        [
                            '$or' => [
                                ['_id' => $id],
                                ['_id' => new ObjectId($id)],
                            ],
                        ],
                        ['$set' => ['tr_status' => 'Pending']]
                    );
                } catch (\Throwable $e) {
                    return $collection->updateOne(['_id' => $id], ['$set' => ['tr_status' => 'Pending']]);
                }
            });

            $updated = method_exists($result, 'getModifiedCount')
                ? ($result->getModifiedCount() > 0 || $result->getMatchedCount() > 0)
                : (bool) $result;
        }

        if (!$updated) {
            $point = $this->findWithdrawPointByRouteId($id);
            if (!$point) {
                return back()->with('error_message', 'Invalid withdrawal request.');
            }

            $updated = $this->updateWithdrawPointFields($point, ['tr_status' => 'Pending']);
        }

        if (!$updated) {
            return back()->with('error_message', 'Unable to update withdrawal status to Pending.');
        }

        return redirect('administrator/game/withdraw-success')->with('success_message', 'Withdrawal status updated to Pending successfully.');
    }
    
    public function WithdrawManageData_success(Request $request)
    {
        // dd('ppp');
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table._id',
            1 => 'point_table.tr_value',
            2 => 'point_table.user_id',
            3 => 'point_table.tr_status',
            4 => 'point_table.date',
            5 => 'point_table.tr_nature',
        );
        $totalItems = PointTable::where('tr_nature', 'TRWITH003')->where('tr_status','Success')->get()->count();
        $totalFiltered = $totalItems;
        $items = PointTable::where('tr_nature', 'TRWITH003')->with('user_data')->orderBy('created_at', 'desc')->where('tr_status','Success');

        if (!empty($requestData['search']['value'])) {
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'like', '%' . $filtered . '%')
                  ->orWhere('mob', 'like', '%' . $filtered . '%');
            });
        }

        if (!empty($request->market_date)) {
            $date = Carbon::parse($request->market_date);
            $startOfDay = $date->startOfDay();
            $endOfDay = $date->endOfDay();
    
            $items = $items->whereBetween('created_at', [$startOfDay, $endOfDay]);
        }

        if ($request->orderBy) {
            $items = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        foreach ($items as $item) {
            $i++;
            $actionId = $this->withdrawActionId($item);
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->FullName;
            $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->mob;
            $nestedData[] = $item->account_no;
            $nestedData[] = $item->ifsc_code;
            $nestedData[] = $item->upi_id;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("h:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));
            $nestedData[] = $item->tr_status;
       
$nestedData[] = '<a href="' . url('/administrator/withdraw-reverse/' . $actionId) . '" onclick="return confirm(\'Are you sure you want to revert this?\')" title="Reverse">
    <button type="button" class="btn btn-warning">Reverse</button>
</a>';
            $datas[] = $nestedData;
        };

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );
        echo json_encode($json_data);
    }

    public function WithdrawManageData_cancelled(Request $request)
    {
        // dd('ppp');
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'point_table._id',
            1 => 'point_table.tr_value',
            2 => 'point_table.user_id',
            3 => 'point_table.tr_status',
            4 => 'point_table.date',
            5 => 'point_table.tr_nature',
        );
        $totalItems = PointTable::where('tr_nature', 'TRWITH003')->where('tr_status','Cancelled')->get()->count();
        $totalFiltered = $totalItems;
        $items = PointTable::where('tr_nature', 'TRWITH003')->orderBy('created_at', 'desc')->where('tr_status','Cancelled');

        if (!empty($requestData['search']['value'])) {
            $filtered = $requestData['search']['value'];
            $items = $items->whereHas('user_data', function ($q) use ($filtered) {
                $q->where('FullName', 'like', '%' . $filtered . '%')
                  ->orWhere('mob', 'like', '%' . $filtered . '%');
            });
        }

        if (!empty($request->market_date)) {
            $date = Carbon::parse($request->market_date);
            $startOfDay = $date->startOfDay();
            $endOfDay = $date->endOfDay();
            $items = $items->whereBetween('created_at', [$startOfDay, $endOfDay]);
        }

        if ($request->orderBy) {
            $point = $items->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC');
        }
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderColumnDir = $requestData['order'][0]['dir'];
        $limit = $requestData['length'];
        $offset = $requestData['start'];

        $items = $items->offset($offset)->limit((int)$limit)->orderBy($orderColumn, $orderColumnDir)->get();
        $datas = array();
        $i = $offset;
        // dd($items);
        foreach ($items as $item) {
            $i++;
            $nestedData = array();
            $nestedData[] = $i;
            $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->FullName;
            $nestedData[] = is_null($item->user_data)?"NA":$item->user_data->mob;
            // $nestedData[] = is_null($item->user_id)?"NA":$item->user_id;
            $nestedData[] = $item->account_no;
            $nestedData[] = $item->ifsc_code;
            $nestedData[] = $item->tr_value;
            $nestedData[] = $item->tr_remark;
            $nestedData[] = date("h:i:s", strtotime($item->created_at));
            $nestedData[] = date("d-m-Y", strtotime($item->created_at));
            $nestedData[] = $item->tr_status;

            // $approve = '<a href="' . url('/administrator/withdraw-approve/' . $item->id) . '" title="Approve"><button onclick="javascript=this.disabled = true" class="btn btn-warning ">Approve</button></a>';

            // $cancelled = '<a href="' . url('/administrator/withdraw-cancelled/' . $item->id) . ' " title="Cancelled"><button onclick="javascript=this.disabled = true" class="btn btn-primary">Cancelled</button></a>';

            // $nestedData[] = $approve;

            $datas[] = $nestedData;
        }
        ;

        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalItems),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $datas
        );

        echo json_encode($json_data);
    }

    // public function success_withdraw_cancel($id){
    //     // dd($id);
    //      $point = Point::where('id', $id)->first();
    //     $user = User::where('user_id', $point->user_id)->first();
    //     $amt = $user->win_amount + $point->tr_value;
    //     // dd($amt);
    //     $user = User::where('user_id', $point->user_id)->update(['win_amount'=>$amt]);
    //     Point::where('id',$id)->update(['tr_status'=>'Cancelled','tr_value_updated'=>$amt]);
    //     return redirect('administrator/game/withdraw-cancelled');
    // }

    
}