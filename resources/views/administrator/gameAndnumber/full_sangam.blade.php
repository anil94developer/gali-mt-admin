@extends('administrator.layout.administrator')
@section('content')
<section>
    <div>
        <div class="row">
            
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>single</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.pb-3, .py-3 {
    padding-bottom: 1rem!important;
}

.pt-3, .py-3 {
    padding-top: 1rem!important;
}
.mt-3, .my-3 {
    margin-top: 1rem!important;
}
.mb-2, .my-2 {
    margin-bottom: 0.5rem!important;
}
.d-block {
    display: block!important;
}
@media (min-width: 768px){
.d-md-flex {
    display: -ms-flexbox!important;
    display: flex!important;
}
}

*, ::after, ::before {
    box-sizing: border-box;
}

.main-container {
    min-height: 100vh;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
    padding: 10px 0 0 10px;
}
body {
    color: #888ea8;
    height: 100%;
    background: #f1f2f3;
    overflow-x: hidden;
    overflow-y: auto;
    letter-spacing: 0.0312rem;
    font-family: 'Nunito', sans-serif;
}

.page-title {
    float: left;
    margin-bottom: 16px;
    margin-top: 30px;
}
.border-right {
    border-right: 1px solid!important;
}
.text-center {
    text-align: center!important;
}

@media (min-width: 768px){
.pr-md-3, .px-md-3 {
    padding-right: 1rem!important;
}
.mr-md-3, .mx-md-3 {
    margin-right: 1rem!important;
}
}

.m-0 {
    margin: 0!important;
}

.page-title {
    float: left;
    margin-bottom: 16px;
    margin-top: 30px;
}
.border-right {
    border-right: 1px solid!important;
}
.text-center {
    text-align: center!important;
}
@media (min-width: 768px){
.pr-md-3, .px-md-3 {
    padding-right: 1rem!important;
}
.mr-md-3, .mx-md-3 {
    margin-right: 1rem!important;
}
}

.m-0 {
    margin: 0!important;
}
.float-none {
    float: none!important;
}

.align-self-center {
    -ms-flex-item-align: center!important;
    align-self: center!important;
}

.ml-auto, .mx-auto {
    margin-left: auto!important;
}

.breadcrumb-four .breadcrumb li a {
    color: #555;
    vertical-align: sub;
}

.breadcrumb-four .breadcrumb li span {
    vertical-align: text-bottom;
}

.page-title h3 {
    margin: 0;
    margin-bottom: 0;
    font-size: 20px;
    color: #3b3f5c;
    font-weight: 600;
}

.layout-spacing {
    padding-bottom: 40px;
}
.widget-content-area {
    padding: 20px;
    position: relative;
    background-color: #fff;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}
.br-6 {
    border-radius: 6px!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}
.mt-4, .my-4 {
    margin-top: 1.5rem!important;
}

.row-data-center {
    display: flex;
    justify-content: center;
    align-items: center;
}

.breadcrumb-four .breadcrumb li {
    position: relative;
    font-size: 14px;
    background: #fff;
    margin-right: 20px;
    margin-bottom: 6px;
    padding: 7px 10px;
    border-radius: 10px;
    border: 1px solid #e0e6ed;
    -webkit-box-shadow: 2px 5px 17px 0 rgb(31 45 61 / 10%);
    box-shadow: 0px 1px 8px 0px rgb(31 45 61 / 10%);
}
.mt-5, .my-5 {
    margin-top: 3rem!important;
}
.number-box {
    border-radius: 25px;
    border: 1px solid Purple;
    padding: 10px;
    text-align: center;
}

.pb-2, .py-2 {
    padding-bottom: 0.5rem!important;
}

.pt-2, .py-2 {
    padding-top: 0.5rem!important;
}
    </style>
</head>
<body>
<div class="container">
<div class="layout-px-spacing">
                        <div class="page-header d-block d-md-flex py-3 mb-2 mt-3">
                <div class="page-title float-none border-right align-self-center m-0 text-center mr-md-3 pr-md-3">
                    <h3>Game_rate</h3>
                </div>

                <div class="breadcrumb-four" aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>                            </a>
                        </li>
                        <li class="active">
                                                        
                            <a href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>                               <span>Game_rate</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>                              <span>
                                    Game List                               </span>
                            </a>
                        </li>
                    </ul>
                </div>

                                    <a href="#" class="ml-auto mr-0">
                        <button class="btn btn-primary btn-lg">
                            Add New Game_rate                       </button>
                    </a>
                            </div>
            <div class="row" id="cancel-row">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <form method="post">
                <div class="mb-4 mt-4">
                    <center><h4>Full Sangam</h4></center>
                    <div class="row mt-5 row-data-center">
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">100</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">110</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">111</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">112</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">113</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">114</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">115</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">116</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">117</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">118</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">119</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">120</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">122</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">123</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">124</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">125</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">126</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">127</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">128</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">129</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">130</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">133</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">134</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">135</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">136</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">137</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">138</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">139</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">140</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">144</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">145</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">146</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">147</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">148</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">149</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">150</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">155</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">156</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">157</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">158</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">159</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">160</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">166</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">167</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">168</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">169</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">170</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">177</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">178</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">179</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">180</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">188</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">189</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">190</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">199</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">200</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">220</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">222</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">223</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">224</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">225</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">226</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">227</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">228</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">229</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">230</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">233</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">234</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">235</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">236</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">237</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">238</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">239</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">240</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">244</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">245</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">246</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">247</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">248</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">249</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">250</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">255</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">256</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">257</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">258</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">259</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">260</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">266</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">267</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">268</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">269</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">270</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">277</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">278</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">279</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">280</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">288</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">289</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">290</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">299</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">300</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">330</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">333</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">334</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">335</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">336</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">337</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">338</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">339</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">340</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">344</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">345</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">346</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">347</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">348</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">349</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">350</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">355</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">356</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">357</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">358</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">359</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">360</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">366</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">367</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">368</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">369</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">370</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">377</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">378</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">379</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">380</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">388</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">389</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">390</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">399</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">400</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">440</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">444</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">445</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">446</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">447</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">448</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">449</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">450</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">455</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">456</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">457</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">458</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">459</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">460</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">466</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">467</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">468</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">469</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">470</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">477</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">478</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">479</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">480</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">488</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">489</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">490</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">499</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">500</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">550</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">555</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">556</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">557</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">558</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">559</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">560</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">566</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">567</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">568</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">569</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">570</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">577</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">578</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">579</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">580</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">588</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">589</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">590</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">599</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">600</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">660</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">666</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">667</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">668</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">669</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">670</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">677</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">678</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">679</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">680</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">688</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">689</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">690</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">699</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">700</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">770</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">777</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">778</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">779</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">780</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">788</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">789</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">790</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">799</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">800</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">880</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">888</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">889</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">890</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">899</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">900</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">990</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">999</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">100</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">110</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">111</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">112</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">113</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">114</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">115</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">116</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">117</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">118</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">119</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">120</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">122</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">123</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">124</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">125</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">126</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">127</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">128</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">129</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">130</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">133</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">134</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">135</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">136</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">137</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">138</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">139</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">140</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">144</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">145</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">146</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">147</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">148</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">149</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">150</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">155</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">156</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">157</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">158</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">159</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">160</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">166</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">167</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">168</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">169</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">170</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">177</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">178</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">179</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">180</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">188</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">189</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">190</div>
                        </div>
                        <div class="col-md-1 col-4 py-2">
                            <div class="number-box">199</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div>
</div>
</body>
</html>
        </div>
    </div>
</section>

<!-- Modal -->

<!-- Modal -->

@endsection
@push('scripts')
<script src="{{asset('/backend/developer/js/market.js')}}"></script>
<script>

</script>

@endpush
