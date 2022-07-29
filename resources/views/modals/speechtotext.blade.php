@extends('layouts.modal')

@push('header')
Speech To Text
@endpush


@push('aside')

@endpush



@push('artical')
<!-- speech to text container -->
<div class="orcontainer">
  <div class="imagediv">
    <p class="title">Transcription Output</p>
    <div name="" id="textfromaudio">
      Click <strong>Start Transcribing</strong> below to begin a real-time transcription of what you speak into your microphone
    </div>
    <div class="divrecord">
      <p>Current language: <span>English, US</span> </p>

      <button id="btnRecord" for="actual-btn" class="btn" onclick="uploadpicture()">
        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20">
          <path fill="#0091ff" d="M10.021 12.208q-1.25 0-2.146-.896-.896-.895-.896-2.145V4.146q0-1.25.896-2.136.896-.885 2.146-.885t2.135.885q.886.886.886 2.136v5.021q0 1.25-.875 2.145-.875.896-2.146.896Zm-1.167 6v-2.437q-2.437-.333-4-2.219-1.562-1.885-1.562-4.385h2.291q0 1.854 1.302 3.125 1.303 1.27 3.136 1.27 1.833 0 3.125-1.27 1.292-1.271 1.292-3.125h2.291q0 2.5-1.562 4.385-1.563 1.886-4.021 2.219v2.437Z" />
        </svg>START TRANSCRIBING
      </button>
    </div>

  </div>

  <hr class="hrSeperator">

  <div class="informationDiv">
    <p class="title">Settings</p>
    <div class="divcollapses">
      <div class="divcollapse">
        <div class="collabseheader">
          <span>Language Settings</span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20">
              <path d="M10 12.333 5.292 7.667h9.416Z" />
            </svg>
          </span>
        </div>

        <div class="collabsebody">
          <div>
            <label class="form-control">
              <input type="radio" id="engine" name="engine" value="neural" />
              <span class="radiotitle">Specific language</span>
              <p> If you know the language spoken in your source audio, choose this option to get the most accurate results.
              </p>
            </label>
          </div>
          <div>
            <label class="form-control">
              <input type="radio" id="engine" name="engine" value="neural" />
              <span class="radiotitle">Automatic language identification</span>
              <p>Produces natural-sounding speech</p>
            </label>
          </div>
          <fieldset class="optionsFieldSet">
            <label for="languageSelected" class="lbloption">Choose Language</label>
            <select class="optselect" name="" id="languageSelected">
              <option value="xyz" class="sltOption">Chinese, CN (zh-CN)</option>
              <option value="abc">English, US</option>
            </select>
          </fieldset>
        </div>
      </div>
    </div>

  </div>
</div>

@endpush

@push('footer')
<div class="footerDiv">
  <button class="btn download">
    <svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
      <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
    </svg>Download
  </button>
  <button class="btn reset">
    RESET DEMO</button>
</div>
@endpush


<style>
  .orcontainer {
    margin: 10px 0 0 5px;
    display: flex;
    width: 100%;
  }

  .title {
    color: #0091FF;
    font-size: 13px !important;
    font-weight: bold !important;
    /* margin: 0 0 10px 0 !important; */
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
    grid-template-rows: 7% auto 16%;
    column-gap: 15px;
    /* border: 1px dotted black; */
    /* padding: 0 15px 0px 15px; */
  }

  .imagediv p,
  .informationDiv p {
    grid-column: 1/4;
    margin: 5px 0 10px 15px;
    /* height: 5px; */
  }

  #textfromaudio {
    width: 380px;
    height: 380px;
    grid-column: 1/4;
    border-radius: 8px;
    resize: none;
    margin: 5px 15px 0 10px;
    padding: 18px;
    box-sizing: border-box;
    border: 1px solid #DDDDDD;
    color: #888888;

  }

  .imagediv strong {
    color: #888888;
  }

  #textfromaudio::placeholder {
    color: #888888;
  }


  .informationDiv {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 5% auto;
    row-gap: 10px;
    width: 100%;
  }

  .divrecord p {
    margin: 0;
    font-size: 13px;
  }

  .divrecord p span {
    font-weight: bold;
  }

  .divrecord {
    grid-column: 1/4;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 12px 0 10px;
  }

  #btnRecord {
    width: 180px;
    text-align: center;
    padding: 2px 5px 2px 8px;
    display: flex;
    align-items: center;
    font-weight: 500;
  }

  .divcollapse {
    border-bottom: 1px solid #DDDDDD;
    margin: 5px 15px;
  }

  .collabsebody {
    margin-bottom: 15px;
  }

  .collabseheader {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-weight: bold;
  }

  .lbloption {
    /* margin: 20px !important; */
    font-weight: bold;
    margin-bottom: 5px;
  }

  .radiotitle {
    color: #000000;
    margin-left: 5px;
  }

  .form-control p {
    margin-left: 20px;
    color: #888888;
  }

  .optionsFieldSet {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: none;
    margin: 10px 0;
  }

  .optselect {
    border-radius: 21px;
    /* padding: 5px 10px 5px 10px; */
    padding: 10px;
    color: #888888;
    border: 1px solid #DDDDDD;
  }

  .sltOption {
    font-size: 13px;
    color: #888888;
    font-family: "Open Sans", sans-serif;
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