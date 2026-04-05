<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta name="description" content="Playonlineds">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playonlineds Result</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: black;
            color: white;
        }
        table {
            width: 100%;
            text-align: center;
        }
        th, td {
            min-width: 68px;
            padding: 5px;
            white-space: nowrap;
            border: 1px solid white;
        }
        th {
            background: #ffff79;
            color: #FF0000;
        }
        .container{
            width: 100%;
            margin: auto;
        }
        .d-flex{
            display: flex;
        }
        .w-100{
            width: 100%;
        }
        .justify-content-between{
            justify-content: space-between;
        }
        .gap-2{
            gap: 10px;
        }
        .selectmonth{
            display: block;
    text-align: center;
    font-size: 20px;
    margin-top: 20px;
        }
        .result_title{
            text-align: center;
    background: #ffff79;
    color: #000;
    font-size: 20px;
    padding: 10px;
    
    border-radius: 5px;
        }
        .w-100{
            width: 100%;
        }
        .width_new_all{
            width: 50%;
            margin: auto;
        }
        @media(max-width:767px){
            .width_new_all{
            width: 100%;
            margin: auto;
        }
        }
    </style>
</head>
<body>

<div class="container">
    <label for="month" class="text-white selectmonth">Select Month</label>
 <div class="width_new_all">
 <form method="get" class="form-inline mb-3 d-flex justify-content-between  gap-2">

<div class="w-100">
<select name="month" id="month" class="w-100 form-control mx-2" style="width:100%">
           @for ($i = 0; $i < 2; $i++)
               <option value="{{ \Carbon\Carbon::now()->subMonths($i)->format('Y-m') }}"
                   {{ request('month', now()->format('Y-m')) == \Carbon\Carbon::now()->subMonths($i)->format('Y-m') ? 'selected' : '' }}>
                   {{ \Carbon\Carbon::now()->subMonths($i)->format('F Y') }}
               </option>
           @endfor
       </select>
</div>
     <div>
     <button type="submit" class="btn btn-primary">Show Results</button>
     </div>
   </form>
 </div>

    <h2 class="result_title">{{ \Carbon\Carbon::parse($month)->format('F Y') }} Results</h2>

   <div class="table-responsive">
   <table class="table table-bordered text-white">
        <thead>
            <tr>
                <th>Date</th>
                @foreach ($markets as $market)
                    <th>{{ $market->market_id }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $row)
                <tr>
                    <td>{{ $row['date'] }}</td>
                   
                    @foreach ($markets as $market)
                    
                        <td>{{ $row[$market->market_id] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
   </div>
</div>

</body>
</html>
