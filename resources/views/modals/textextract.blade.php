@extends('layouts.modal')

@push('header')
Text Extract
@endpush

@push('aside')

<a href="{{url('/speechtotext')}}">Speech To Text</a>
<a href="{{url('/texttospeech')}}">Text To Speech</a>
<a href="{{url('/textextract')}}" class="selected">Text Extract</a>
<a href="{{url('/comprehend')}}">Comprehend Demonstration</a>
<a href="{{url('/objectrecognisation')}}">Object Recognition</a>

@endpush

@push('artical')
<!-- text extract  container -->
<div class="orcontainer">

  <div class="imagediv">
    <p class="title">Document Name</p>
    <picture>
      <img src="/assets/images/NoPath.png">
    </picture>
    <!-- <input type="file" class="btn" id="btnChoose" name="myfile"> -->
    <select class="btn" id="btnChoose">Choose Sample Document
      <option value="">Choose Sample Document</option>
    </select>

    <!-- <div> -->
    <!-- <input id="uploadimage" type="file" name="myfile" hidden />
    <button class="btn" id="btnUpld" for="#uploadimage">Upload Document</button> -->
    <input type="file" id="actual-btn" hidden />

    <!--our custom file upload button-->
    <label id="labelbtnUpld" for="actual-btn" class="btn" onclick="uploadpicture()">Upload Document</label>
    <!-- </div> -->

  </div>

  <hr class="hrSeperator">

  <div class="informationDiv">
    <p class="title">Results</p>
    <div id="tabs" class="responsive sticky-top bg-white">
      <!-- <div class="tabs tabs-center"> -->
      <a id="btnrawtext" class="tab active" onclick="test('rawtext','btnrawtext')">
        Raw Text
      </a>
      <a id="btnform" class="tab" onclick="test('form','btnform')">
        Forms
      </a>
      <a id="btntbl" class="tab" onclick="test('tbl','btntbl')">
        Tables
      </a>
      <a id="btnqry" class="tab" onclick="test('qry','btnqry')">
        Queries
      </a>
      <!-- </div> -->
    </div>

    <div id="rawtext" class="rawtext tabcontent">
      <div class="tools">
        <div class="iconinputbox">
          <span class="material-symbols-outlined">
            search
          </span>
          <input id="searchtext" class="nooutline" type="text" placeholder="Search..">
        </div>
        <select id="segmentline" name="" id="">
          <option value="">Segment by line</option>
        </select>
      </div>

      <div class="tagstext">
        <span class="item">Adobe InDesign</span>
        <span class="item">Hello adaffsdf</span>
        <span class="item">Hello a </span>
        <span class="item">Hello fsfsff fsdfs f</span>
        <span class="item">Hello fsdfs</span>
        <span class="item">Hello a </span>
        <span class="item">Hello 4554</span>
        <span class="item">Hello sdklasjkd ajdkaj akdfjakl</span>
      </div>
    </div>

    <div id="form" class="forms tabcontent">
      <div class="tools">
        <div class="iconinputbox">
          <span class="material-symbols-outlined">
            search
          </span>
          <input id="searchtext" class="nooutline" type="text" placeholder="Search..">
        </div>
      </div>

      <div class="fromsitems">
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
        <div class="fromsitem">
          <p>Rech Nr.</p>
          <p>4572</p>
        </div>
      </div>
    </div>

    <div id="tbl" class="tables tabcontent">
      <div class="tools">
        <div class="iconinputbox">
          <span class="material-symbols-outlined">
            search
          </span>
          <input id="searchtext" class="nooutline" type="text" placeholder="Search..">
        </div>
      </div>

      <div class="tablebody">
        <table>
          <tr>
            <th class="itemname">Item</th>
            <th class="qty">Qty.</th>
            <th class="price">Price</th>
            <th class="total">Total</th>
          </tr>
          <tr>
            <td>Latte Macchiato</td>
            <td>2</td>
            <td>4.50</td>
            <td>9</td>
          </tr>
          <tr>
            <td>Gloki</td>
            <td>1</td>
            <td>5</td>
            <td>5</td>
          </tr>

        </table>
      </div>
    </div>

    <div id="qry" class="queries tabcontent">
      <div class="tools">
        <div class="iconinputbox">
          <span class="material-symbols-outlined">
            search
          </span>
          <input id="qrysearch" class="nooutline" type="text" placeholder="Search..">
        </div>
        <button id="qrysubmit" name="" id="" class="btn">
          Submit
        </button>
        <p id="notetext">Note: Limit of 200 characters per query. Duplicate queries not permitted</p>
      </div>

      <div class="qryitems">
        <div class="qryitem">
          <span>What is the item name?</span>
          <span class="alias">Alias: Name</span>
          <p>4575</p>
        </div>
        <div class="qryitem">
          <span>What is the item name?</span>
          <span class="alias">Alias: Name</span>
          <p>4575</p>
        </div>
        <div class="qryitem">
          <span>What is the item name?</span>
          <span class="alias">Alias: Name</span>
          <p>4575</p>
        </div>
        <div class="qryitem">
          <span>What is the item name?</span>
          <span class="alias">Alias: Name</span>
          <p>4575</p>
        </div>


      </div>

    </div>

  </div>
</div>
@endpush

@push('footer')
<div class="footerDiv">
  <button class="btn download"><svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
      <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
    </svg>Download</button>
  <button class="btn reset">
    RESET DEMO</button>
</div>
@endpush

<style>
  .orcontainer {
    margin: 15px 0 10px 0px;
    display: flex;
  }

  .title {
    color: #0091FF;
    font-size: 13px !important;
    font-weight: bold !important;
  }

  .footerDiv {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 20px;
    /* margin: 5px 10px 10px 10px; */
    /* height: 100%; */
    align-items: center;
  }

  .hrSeperator {
    border: 1px solid #EEEEEE;
    margin: 5px 0 20px 0;
  }

  .imagediv {
    display: grid;
    grid-template-columns: 1fr;
    column-gap: 15px;
    /* background-color: #EEEEEE; */
    width: 400px;

  }

  .imagediv p,
  .informationDiv p {
    grid-column: 1/4;
    margin: 5px 0 10px 15px;
    /* height: 5px; */
  }

  img {
    height: 100%;
    width: 80%;
  }

  picture {
    text-align: center;
    grid-column: 1/4;
    border: 1px solid #DDDDDD;
    border-radius: 8px;
    margin: 0px 0px 10px 20px;
    height: 400px;
    width: 360px;
  }

  #labelbtnUpld {
    width: 140px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #btnChoose {
    width: 210px;
    margin-left: 20px;
    border: 1px solid #DDDDDD;
    color: #000000 !important;
    /* font-weight: 600; */
    font-weight: 400;
    padding: 5px 15px;
    /* width: max-content; */
  }


  .informationDiv {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 7% 10% auto;
    width: 100%;
    align-items: start;
  }

  /* Style the tab */
  #tabs {
    overflow: hidden;
    border-bottom: 1px solid #EEEEEE;
    margin: 0 25px 0 25px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    grid-column: 1/4;
  }

  .tab {
    /* margin: 5px; */
    text-decoration: none;
    font-size: 13px;
    color: #111111;
    font-weight: bold;
    padding: 0 10px 8px 10px;
    box-sizing: border-box;
    border-bottom: 3px solid transparent;
  }

  .active {
    border-bottom: 3px solid #0091FF;
  }

  /* Style the buttons inside the tab */
  /* .tab a {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  } */

  /* Change background color of buttons on hover */
  /* .tab a:hover {
  background-color: #ddd;
  } */

  /* Create an active/current tablink class */
  /* .tab a.active {
  background-color: #0091FF;
  } */

  /* Style the tab content */
  .tabcontent {
    height: 100%;
    /* width: 100%; */
    margin: 0 20px 0 20px;
    grid-column: 1/2;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 15% auto;
  }

  .tabcontent .tools {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  .iconinputbox {
    border: 1px solid #DDDDDD;
    border-radius: 16px;
    padding: 7px 5px 7px 10px;
    display: flex;
  }

  #searchtext {
    font-size: 13px;
    font-family: "Open Sans", sans-serif;
    color: #000000;
    width: 180px;
    border: none;
  }

  #segmentline {
    border-radius: 21px;
    font-size: 13px;
    border: 1px solid #DDDDDD;
    padding: 7px 5px 7px 10px;
    font-family: "Open Sans", sans-serif;
    color: #000000;
    height: 40px;
  }


  #searchtext::placeholder {
    font-size: 13px;
    color: #000000;
  }

  .tagstext {
    display: flex;
    flex-wrap: wrap;
    /* justify-content: space-between; */
    align-content: flex-start;
    align-items: center;
    /* grid-template-rows: 1fr; */
  }

  .tagstext span {
    background-color: #F5F5F5;
    padding: 5px 10px 5px 10px;
    font-size: 14px;
    margin: 7px;
    color: #000000;
    font-family: "Open Sans", sans-serif;
    font-weight: 400;
    text-transform: capitalize;
    /* width: ; */
  }

  span.material-symbols-outlined {
    margin: 0 10px 0 5px;
    font-size: 18px;
  }

  .material-symbols-outlined {
    font-variation-settings:
      'FILL'1,
      'wght'700,
      'GRAD'0,
      'opsz'24
  }


  .download {
    /* color: #FFFFFF !important; */
    background-color: #0091FF !important;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 50px;
    padding-left: 9px;
  }

  .download {
    background-color: transparent !important;
    color: #0091FF !important;
    gap: 40px;
  }

  .reset {
    text-align: center;
    margin-right: 20px;
  }

  /* tab toggle manual */
  .rawtext {
    display: grid;
  }

  .tables {
    display: none;
  }

  .forms {
    display: none;
  }

  .queries {
    display: none;
  }



  .forms #searchtext {
    width: 350px;
  }

  .tables #searchtext {
    width: 350px;
  }

  .fromsitems {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: repeat(5, 50px);
    row-gap: 30px;
    column-gap: 20px;
    overflow: hidden;
  }

  .fromsitem p {
    font-size: 13px;
    margin: 0;
  }

  .fromsitem p:first-child {
    font-weight: 700;
    padding: 5px;
  }

  .fromsitem p:last-child {
    width: 180px;
    height: 20px;
    background-color: #F5F5F5;
    padding: 5px 10px 5px 10px;
  }

  /* css code for table tab */


  table td {
    background-color: #F0F0F0;
    padding: 5px;
  }

  table th {
    text-align: start;
  }

  table .itemname {
    width: 400px;
  }

  table .qty {
    width: 150px;
  }

  table .price {
    width: 150px;
  }

  table .total {
    width: 150px;
  }


  /* css for queries tab   */

  .queries {
    overflow: hidden;
  }

  #notetext {
    font-size: 10px;
  }

  .qryitems {
    display: grid;
    /* margin-left: 20px; */
    margin-top: 20px;
  }

  .qryitem {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: repeat(6, 30px);
    height: 80px;
  }

  .qryitem span:first-child {
    font-weight: bold;
    margin-left: 10px;
  }

  .qryitem .alias {
    font-weight: 400;
  }

  .qryitem p {
    height: 20px;
    background-color: #F5F5F5;
    padding: 5px 10px 5px 10px;
    margin: 0;
  }

  #qrysubmit {
    width: 100px;
  }

  #qrysearch {
    font-size: 13px;
    font-family: "Open Sans", sans-serif;
    color: #000000;
    border: none;
    width: 220px;
  }

  /* css for Object recognixation  */
  .informationDiv2 {
    display: grid;
    display: none;

    grid-template-columns: 1fr;
    grid-template-rows: 15% auto;
    row-gap: 20px
  }

  .informationDiv2 .tools {
    margin-left: 25px;
    width: 400px;
    display: grid;
    grid-template-columns: 1fr;
  }

  .informationDiv2 .tools p {
    margin-top: 15px;
    text-align: center;
    font-weight: 600;
  }

  /* 9175431127 avinash*/
  #lblsearch {
    grid-column: 1/2;
    font-size: 13px;
    font-family: "Open Sans", sans-serif;
    color: #000000;
    width: 320px;
    border: none;
  }

  #lblsearch::placeholder {
    font-weight: bold;
  }

  .objectinformation {
    margin-left: 20px;
  }

  .objectinformation .Oinfolist {
    margin: 20px 0 10px 0;
    font-weight: 500;
    border-bottom: 1px solid #EEEEEE;
    display: flex;
    justify-content: space-between;
    padding: 5px 0 5px 0;
  }
</style>
<script>
  function test(id, btnid) {
    hideall();
    var x = document.getElementById(id);
    if (x.style.display === "none") {
      x.style.display = "grid";
      var btnx = document.getElementById(btnid);
      btnx.classList.add("active");
    } else {
      x.style.display = "none";
    }
  }

  function hideall() {
    var rawtext = document.getElementById('rawtext');
    var btnrawtext = document.getElementById('btnrawtext');
    var form = document.getElementById('form');
    var btnform = document.getElementById('btnform');
    var tbl = document.getElementById('tbl');
    var btntbl = document.getElementById('btntbl');
    var qry = document.getElementById('qry');
    var btnqry = document.getElementById('btnqry');
    rawtext.style.display = "none";
    btnrawtext.classList.remove("active");
    form.style.display = "none";
    btnform.classList.remove("active");
    tbl.style.display = "none";
    btntbl.classList.remove("active");
    qry.style.display = "none";
    btnqry.classList.remove("active");
  }

  function uploadpicture() {
    alert("img")
  }
</script>