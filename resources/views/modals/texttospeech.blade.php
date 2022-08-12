@extends('layouts.modal')


@push('scripts')

<script>
  var voiceurlaws = '';
  var speaker = '';
  textempty();
  document.getElementById("converting").style.display = "none";

  function convert() {


    //selector value
    var voiceselect = document.getElementById("voice");
    speaker = voiceselect.options[voiceselect.selectedIndex].value;

    // text area value
    var text = document.getElementById("texttocovert").value;

    if (text == '') {
      alert('Please enter text!');
      return;
    }


    var requestOptions = {
      method: 'GET',
      redirect: 'follow'
    };

    document.getElementById("converting").style.display = "block";

    fetch("http://127.0.0.1:8000/api/textspeechaws?str=" + text + "&speaker=" + speaker, requestOptions)
      .then(response => response.json())
      // .then((response) => {
      //   return response.json();
      // })
      .then((result) => {
        // use response
        voiceurlaws = result.url;
        // console.log(result.url);
        // console.log(result.str);
        textempty();
        document.getElementById("converting").style.display = "none";

      })
      .catch(error => console.log('error', error));
  }



  function textempty() {
    if (voiceurlaws == '') {
      document.getElementById("btndownload").style.display = "none";
      document.getElementById("btnlisten").style.display = "none";
      document.getElementById("btnconvert").style.display = "block";
    } else {
      document.getElementById("btndownload").style.display = "flex";
      document.getElementById("btnlisten").style.display = "flex";
      document.getElementById("btnconvert").style.display = "none";

    }
  }

  function play() {
    var audio = new Audio(voiceurlaws);
    audio.play();
  }

  // bulding download file
  const downloadURI = (uri) => {
    const link = document.createElement("a");
    link.download = uri;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  function downloadaudiofile() {
    if (voiceurlaws = '') {
      alert("Audio file not found, please try converting again!");
    } else {
      downloadURI(voiceurlaws)
    }
  }

  // char counting and updating 
  function textchange() {
    var textremaining = 60 - document.getElementById("texttocovert").value.length;
    document.getElementById("textremaining-p").innerHTML = textremaining + ' Characters remaining';
  }

  // clearing text
  function cleartext() {
    document.getElementById("texttocovert").value = '';
    document.getElementById("btndownload").style.display = "none";
    document.getElementById("btnlisten").style.display = "none";
    document.getElementById("btnconvert").style.display = "block";
  }

  function parameterchange() {
    document.getElementById("btnconvert").style.display = "block";
  }
</script>
@endpush


@push('header')
Text To Speech
@endpush


@push('aside')

@endpush



@push('artical')
<div id="texttospeechmodal" class="model-artical">
  <div class="engine">
    <span class="headings">Engine</span>
    <div>
      <label class="form-control">
        <input type="radio" id="engine" name="Neural" value="neural" />
        <span class="title">Neural</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </label>
    </div>

    <div>
      <label class="form-control">
        <input type="radio" class="title" id="engine" name="Standard" value="standard" />
        <span class="title">Standard</span>
      </label>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    </div>
  </div>

  <div class="language">
    <fieldset class="optionsFieldSet">
      <label for="languageSelected" class="headings">Language</label>
      <select id="languageSelected" class="optselect" name="">
        <option value="engus" class="sltOption">English, US</option>
        <option value="abc">ABC</option>
        <option value="mnp">MNP</option>
      </select>
    </fieldset>

    <fieldset class="optionsFieldSet">
      <label for="voice" class="headings">Voice</label>
      <select id="voice" class="optselect" name="" onchange="parameterchange()">
        <option value="Amy" class="sltOption">Amy, Female</option>
        <option value="Matthew">Matthew, Male</option>
        <option value="Joanna">Joanna, Female</option>
      </select>
    </fieldset>
  </div>

  <div class="textinputdiv">
    <label for="texttocovert" class="headings texttoLabel">Input Text</label>
    <textarea id="texttocovert" class="textinput" name="" cols="90%" rows="6" maxlength="60" placeholder="English,US" onkeyup="textchange()"></textarea>
    <div class="texttocovertbtns">
      <p id="textremaining-p" class="pChars">60 Characters remaining</p>
      <button class="btnClear btn" onclick="cleartext()">CLEAR TEXT</button>
    </div>
  </div>

</div>
@endpush

@push('footer')
<div class="footerDiv">
  <button id="btndownload" class="btn download" onclick="downloadaudiofile()">
    <svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
      <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
    </svg>Download
  </button>
  <!-- <a href="https://recitepro.s3.amazonaws.com/0924b6f4801b4b2caaff66d9808e5001.mp3" download="https://recitepro.s3.amazonaws.com/0924b6f4801b4b2caaff66d9808e5001.mp3">Download PDF</a> -->

  <button id="btnlisten" type="button" class="btn listen" onclick="play()">
    <span class="material-symbols-sharp">
      play_arrow
    </span> Listen
  </button>
  <button id="btnconvert" type="button" class="btn" onclick="convert()">
    <i id="converting" class="fa fa-spinner fa-spin"></i> Convert
  </button>
</div>
@endpush

<style>
  .model-artical {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 15% 12% 63%;
    row-gap: 25px;
    width: 100%;
    font-size: 13px;
    font-weight: 500;
    margin: 10px;
  }

  .headings {
    color: #111111;
    font-size: 13px;
    font-weight: 700;
  }

  .title {
    color: #000000;
    font-weight: 500;
    font-size: 13px;
    line-height: 1.1;
  }

  fieldset {
    border: none;
  }

  .engine {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: auto 1fr;
    row-gap: 10px;
  }

  .engine span {
    grid-column: 1/-1;
  }

  .engine p {
    margin: 2px 0 0 23px;
    color: #888888;
    font-size: 11px;
  }


  input#engine {
    margin-right: 5px;
  }

  .language {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 40px;
  }

  .textinputdiv {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: auto 1fr auto;
    height: 100%;
    row-gap: 10px;
  }

  .texttoLabel {
    grid-column: 1/-1;
  }

  .textinput {
    grid-column: 1/-1;
    width: 100%;
    border-radius: 5px;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #DDDDDD;
    resize: none;
    font-family: "Open Sans", sans-serif;

  }

  .textinput::placeholder {
    font-size: 13px;
    font-family: "Open Sans", sans-serif;
    color: #888888;
  }

  .textinput:focus {
    /* border: 1px solid #0091FF; */
    box-shadow: 0 0 3px #0091FF;
  }


  .footerDiv {
    height: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 20px;
  }

  .modal .btn {
    background-color: transparent;
    color: #0091FF;
    box-shadow: 0px 3px 6px #00000029;
    border: 1px solid #0091FF;
    border-radius: 24px;
    opacity: 1;
    width: 208px;
    height: 36px;
    text-align: center;
    font-size: 13px;
    font-family: "Open Sans", sans-serif;
    font-weight: bold;

  }

  .listen,
  .download {
    color: #FFFFFF !important;
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

  .texttocovertbtns {
    display: flex;
    justify-content: space-between;
  }

  .texttocovertbtns p {
    font-size: 13px;
    color: #888888;
  }

  .optselect {
    border-radius: 21px;
    /* padding: 5px 10px 5px 10px; */
    padding: 10px;
    color: #888888;
    border: 1px solid #DDDDDD;
  }

  .textinputdiv .btnClear {
    width: 98px;
    font-size: 13px;
    font-weight: 300;

  }

  .optionsFieldSet {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .sltOption {
    font-size: 13px;
    color: #888888;
    font-family: "Open Sans", sans-serif;
  }

  #texttocovert::placeholder {
    font-size: 13px;
    font-family: "Open Sans", sans-serif;
    color: #888888;
  }
</style>

@push('style')
<style>
  /* //texttospeech styling */
</style>
@endpush