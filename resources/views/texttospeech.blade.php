@extends('layouts.modal')

@push('header')
<h1>Text To Speech</h1>
@endpush


@push('aside')
@if($modal == 'texttospeech')
<h4 class="selected">Text To Speech</h4>
@endif
<h4>API service 1</h4>
<h4>API service 2</h4>
<h4>API service 3</h4>
<h4>API service 4</h4>
<h4>API service 5</h4>
@endpush



@push('artical')
<div class="model-artical">

  <div class="engine">
    <span class="headings">Engine</span>
    <div>
      <label class="form-control">
        <input type="radio" id="engine" name="engine" value="neural" />
        <span class="title">Neural</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </label>
    </div>

    <div>
      <label class="form-control">
        <input type="radio" class="title" id="engine" name="engine" value="standard" />
        <span class="title">Standard</span>
      </label>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    </div>
  </div>

  <div class="language">
    <fieldset class="optionsFieldSet">
      <label for="languageSelected" class="headings">Language</label>
      <select class="optselect" name="" id="languageSelected">
        <option value="xyz" class="sltOption">English, US</option>
        <option value="abc">ABC</option>
        <option value="mnp">MNP</option>
      </select>
    </fieldset>

    <fieldset class="optionsFieldSet">
      <label for="voice" class="headings">Voice</label>
      <select class="optselect" name="" id="voice">
        <option value="xyz" class="sltOption">Joanna, Female</option>
        <option value="abc">ABC</option>
        <option value="mnp">MNP</option>
      </select>
    </fieldset>
  </div>

  <div class="textinputdiv">
    <label for="texttocovert" class="headings texttoLabel">Input Text</label>
    <textarea class="textinput" name="" id="texttocovert" cols="90%" rows="6" placeholder="English,US"></textarea>
    <div class="texttocovertbtns">
      <p class="pChars">58 Characters remaining</p>
      <button class="btnClear btn">Clear</button>
    </div>
  </div>

</div>
@endpush

@push('footer')
<div class="footerDiv">
  <button class="btn">Download</button>
  <button class="btn">Listen</button>
</div>
@endpush
<style>
  .model-artical {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 18% 15% auto;
    row-gap: 15px;
    width: 100%;
    font-size: 13px;
    font-weight: 500;
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
    padding: 5px 10px 5px 10px;
    color: #888888;
    border: 1px solid #DDDDDD;
  }

  .textinputdiv .btnClear {
    width: 75px;
    height: 25px;
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
  }
</style>