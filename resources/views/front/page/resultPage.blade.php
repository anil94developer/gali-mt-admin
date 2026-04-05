<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="" content="">
    <title>Playonlineds</title>
    <meta name="description" content="">
    <meta name="author" content="company">
    <meta name="keywords" content="">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="{{URL::asset('front')}}/assets/css/newfront.css" rel="stylesheet">
<style>
    .linkmenu a{
      font-weight:bold;
            padding: 10px;
    margin-top: 20px;
    display: inline-block;
    }
    </style>
</head>

<body>
    <section id="" class="">
        <div class="">
            <div class="title-four text-center wow fadeInUp">
                <img src="{{URL::asset('front')}}/assets/images/kgflogo.png" style="width:150px;height:110px;" class="mt-2 rounded">
              <div class="linkmenu">
                 <a href="privacy-policy-page">Privacy Policy</a>
                                 <a href="contact-us-page">Contact Us</a>
              </div>
                <h4 class="text-light mt-3" style="font-weight: 800; font-size: 16px; line-height: 40px ;background:#e78827">
                    &nbsp; RESULT SECTION &nbsp; </h4>
                <br>
                <div class="">
                    <div class="row align-items-center">
                    
                        @foreach($Market as $marketValue)
                        
                        
                        <div class="col-lg-4">
                            <div class="single_result">
                               
                                <h4>{{$marketValue->market_name}}</h4>
                                
                                <ul>
                                @if(!empty(@$marketValue->result))
                               
                                    
                                        @if(@$marketValue->result->result == '' && @$marketValue->result->result2 == '' && @$marketValue->result->result3 == '')
                                        
                                        <li>
                                            <p>Loading..</p>
                                        </li>
                                        <li>
                                            <p class="bold-sec">Loading..</p>
                                        </li>
                                        <li>
                                            <p>Loading..</p>
                                        </li>
                                        @else
                                        @if(@$marketValue->result->result == '' && @$marketValue->result->result2 == '')
                                        
                                        <li>
                                            <p>00</p>
                                        </li>
                                        @else
                                        
                                        <li>
                                            <p>{{@$marketValue->result->result}}</p>
                                        </li>
                                        @endif

                                        @if(@$marketValue->result->result2 == 0)
                                        <li>
                                            <p>00</p>
                                        </li>
                                        @else
                                        <li>
                                            <p>{{@$marketValue->result->result2}}</p>
                                        </li>
                                        @endif

                                        @if(@$marketValue->result->result3 == 0)
                                        
                                        <li>
                                            <p>00</p>
                                        </li>
                                        @else
                                        <li>
                                            <p>{{@$marketValue->result->result3}}</p>
                                        </li>
                                        @endif
                                        @endif
                                    @else


                                    
                                    <li>
                                            <p>Loading..</p>
                                        </li>
                                        <li>
                                            <p class="bold-sec">Loading..</p>
                                        </li>
                                        <li>
                                            <p>Loading..</p>
                                        </li>
                                    @endif

                               


                                </ul>
                             
                                <div class="g_rtime">
                                    <p><?php echo date('h:i A',strtotime($marketValue->market_view_time_open))?><span><?php echo date('h:i A',strtotime($marketValue->market_view_time_close))?></span></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                    @endforeach
                    </div>
                </div>
            </div>
    </section>


    <!-- Popup-START-->
    <div class="popup-wrapper">
        <div class="bg-layer"></div>
        <!-- Popup1-START-->
        <div data-rel="1" class="popup-content">
            <div class="layer-close"></div>
            <div class="popup-container searhPopup size-2">
                <form>
                    <h5 class="h5 as light">Search</h5>
                    <input type="text" placeholder="Enter keyword" class="simple-input light">
                    <div class="searchBorderBottom"></div>
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                <!-- Popup close button-START-->
                <div class="button-close style2"><i class="icon-close icons"></i></div>
                <!-- Popup close button-END-->
            </div>
        </div>
    </div>

    <h4 class="text-light text-center" style="font-weight: 800; font-size: 16px; line-height: 40px ;background-color:#e78827;">TIME
        TABLE
    </h4>
    <div style="padding: 15px">
        <table class="table table-bordered" style="font-size: 12px" font-family: arial, sans-serif;>
            <tr class="bg-primary">
                <th>MARKET</th>
                <TH>OPEN</TH>
                <TH>CLOSE</TH>
            </tr>

            @foreach($Market as $marketValue)
            <tr style="background-color: gold; font-weight:800">
                <td>{{$marketValue->market_name}} 
                </td>
                <td><?php echo date('h:i A',strtotime($marketValue->market_view_time_open))?></td>
                <td><?php echo date('h:i A',strtotime($marketValue->market_view_time_close))?></td>
            </tr>
            @endforeach

   
        </table>
    </div>
    </div>
    </div>

    </table>
    </div>
    </div>
    </div>

</body>

</html>