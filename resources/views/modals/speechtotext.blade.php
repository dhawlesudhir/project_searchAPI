@extends('layouts.modal')

@push('scripts')
    <script>
        let fileobjURL = '';
        let fileName = '';
        let fileidfromserver = '';
        let postresponseData = '';
        let getresponseData = '';
        let transcript = '';
        let APP_URL = '';
        let date = new Date();
        disableSubmit();
        let transcriptgetAttempt = 0;
        // // Create an instance.
        // const controller = new AbortController()
        // const signal = controller.signal


        function uploadAudio(files) {

            const file = files.target.files[0];
            console.log(file.type);
            if (file.type == 'audio/mpeg' || file.type == 'audio/wav') {
                // fileobjURL = URL.createObjectURL(file);
                fileName = fileName.substring(0, fileName.indexOf('.'));
                fileobjURL = file;
                console.log("file saved " + fileobjURL);
                // document.getElementsByClassName('DivlabelbtnUpld')[0].style.justifyContent = "space-evenly";
                document.getElementById('LabelUpld').innerHTML = "Change";
                // document.getElementById('LabelUpld').style.width = "70px";
                document.getElementById('SpanfileName').innerHTML = file.name;
                document.getElementById('SpanfileName').style.display = "block";
                disableSubmit();
            } else {
                alert('Unsupported file uploaded,Only MP3 allowed');
            }
        }

        function apicallsubmit() {
            date = new Date();
            console.log("apicallsubmitS " + date);
            var formdata = new FormData();
            formdata.append("File", fileobjURL);
            formdata.append("Settings", "{\"setting1\": \"settings\", \"settings2\": \"settings\"}");

            var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            };

            document.getElementById("btnSubmit").style.display = "none";
            document.getElementById("btnanalyzing").style.display = "block";
            document.getElementById("btnanalyzing").innerHTML = `Uploading <i id = "converting"
                class = "fa fa-spinner fa-spin" > </i>`;

            fetch("https://7khsyf0wyi.execute-api.ap-south-1.amazonaws.com/dev/upload", requestOptions)
                .then(response => {
                    document.getElementById("btnanalyzing").innerHTML = `Uploaded <i id = "converting"
                class = "fa fa-spinner fa-spin" > </i>`;
                    if (response.ok) {
                        return response.json();
                    }
                    if (response.status == 415) {
                        alert('Unsupported file/image uploaded');
                        throw new Error(415);
                    }
                })
                .then(result => {
                    date = new Date();
                    console.log("apicallsubmitE  " + date);
                    if (result.TranscriptionJobName) {
                        console.log("fetch response - " + result);
                        responseData = result;
                        apicallget();
                    }
                })
                .catch(error => {
                    document.getElementById("btnSubmit").style.display = "block";
                    document.getElementById("btnanalyzing").style.display = "none";
                    alert('Failed');
                    console.log('error', error)
                });
        }

        function apicallget() {
            date = new Date();
            console.log("apicallgetS  " + date);

            var requestOptions = {
                method: 'GET',
                redirect: 'follow',
                // signal: signal,
            };

            if (transcriptgetAttempt == 0) {
                document.getElementById("btnanalyzing").innerHTML = `Waiting for response <i id = "converting"
                class = "fa fa-spinner fa-spin" > </i>`;
            }

            fetch("https://7khsyf0wyi.execute-api.ap-south-1.amazonaws.com/dev/get-transcribe?name=" +
                    responseData.TranscriptionJobName, requestOptions)
                .then(response => {
                    console.log('in res');
                    if (response.ok) {
                        console.log("code " + response.status);
                        return response.json()
                    } else if (response.status == 504) {
                        date = new Date();
                        // console.log('Now aborting');
                        // // Abort.
                        // controller.abort()
                        console.log('resubmitting for 504' + date);
                        if (transcriptgetAttempt < 4) {
                            transcriptgetAttempt++;
                            document.getElementById("btnanalyzing").innerHTML = `Taking longer than usual <i id = "converting"
                class = "fa fa-spinner fa-spin"> </i>`;
                            apicallget();
                        } else {
                            // alert("Taking longer than usual, please wait few minutes and click on 'Get Transcript'");
                            alert("Taking longer than usual, please try again later");

                            document.getElementById("btnSubmit").style.display = "block";
                            document.getElementById("btnanalyzing").style.display = "none";
                        }
                    } else {
                        console.log("after throw");
                        document.getElementById("btnSubmit").style.display = "block";
                        document.getElementById("btnanalyzing").style.display = "none";
                        throw new Error('something went wrong...');
                    }
                })
                .then(result => {
                    date = new Date();
                    console.log("success  " + date);
                    console.log("result " + JSON.stringify(result));
                    if (result.status == "COMPLETED") {
                        document.getElementById("btnSubmit").style.display = "block";
                        document.getElementById("btnanalyzing").style.display = "none";
                        getresponseData = result;
                        console.log("getting transcript " + result);
                        processResponse(getresponseData);
                    } else {
                        alert(result.status);
                        document.getElementById("btnSubmit").style.display = "block";
                        document.getElementById("btnanalyzing").style.display = "none";
                    }
                })
                .catch(error => console.log('error', error));
            // 504
            // processResponse(JSON.parse(testData));
        } //funcEnd

        function processResponse(response) {
            console.log(response.status);
            console.log(response.response.data.status);
            transcript = response.response.data.results.transcripts[0].transcript;
            document.getElementById('textfromaudio').innerHTML = transcript;
            disableSubmit();

            if (transcript) {
                document.getElementById("btndownloadTranscript").style.display = "flex";
            }
        }

        // prevent submit action if nofile data
        function disableSubmit() {
            const button = document.getElementById('btnSubmit')
            // filenot uploaded and no response alredy, Disable Submit button
            if (!fileobjURL) {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
        }

        function reset() {
            getresponseData = '';
            fileobjURL = '';
            document.getElementById('btnUpldimage').value = '';
            disableSubmit();
            document.getElementById("btnSubmit").style.display = "block";
            document.getElementById("btnanalyzing").style.display = "none";
            document.getElementById("btndownloadTranscript").style.display = "none";
            // document.getElementsByClassName('DivlabelbtnUpld')[0].style.justifyContent = "space-between";
            // document.getElementById('LabelUpld').style.width = "370px";

            document.getElementById('LabelUpld').innerHTML = "Upload Audio";
            document.getElementById('SpanfileName').innerHTML = '';
            document.getElementById('SpanfileName').style.display = "none";

            document.getElementById('textfromaudio').innerHTML = `Click <strong>Start Transcribing</strong> below to begin a real-time transcription of what you speak into
            your microphone`;
        }

        function download() {
            if (!transcript) return false;
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(transcript));
            element.setAttribute('download', fileName != '' ? fileName : "transcript.text");
            console.log(element.href);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }
    </script>
@endpush

@push('header')
    Speech To Text
@endpush


@push('aside')
    <a href="{{ url('/texttospeech') }}">Text To Speech</a>
    <a href="{{ url('/speechtotext') }}" class="selected">Speech To Text</a>
    <a href="{{ url('/textextract') }}">Text Extract</a>
    <a href="{{ url('/objectrecognisation') }}">Object Recognition</a>
    <a href="{{ url('/comprehend') }}">Comprehend</a>
@endpush

@push('artical')
    <!--speech to text container-->
    <div class="articalcontainer">
        <div class="transdiv">
            <p class="title"> Transcription Output </p>
            <div name="" id="textfromaudio">
                Click <strong>Upload Audio</strong> File and select audio file and click on submit for transcription.</div>

            <p class="transcriptlanguage"> Current language: <span> English, US </span>
            </p>
            <div class="DivlabelbtnUpld">
                <span id="SpanfileName"> FileName </span>
                <input type="file" accept=".mp3" id="btnUpldimage" onchange="uploadAudio(event)" hidden />
                <!--our custom file upload button-->
                <label id="LabelUpld" for="btnUpldimage" class="labelbtnUpld"> Upload Audio </label>
            </div>

            <button id="btnanalyzing" type="button" class=" btn">
                Uploading <i id="converting" class="fa fa-spinner fa-spin">
                </i>
            </button>
            <button id="btnSubmit" class="btn" onclick="apicallsubmit()"> Submit </button>

        </div>


        <hr class="hrSeperator">

        <div class="informationDiv">
            <p class="title">Settings</p>
            <div class="divcollapses">

                <div class="divcollapse languagesettings">
                    <div class="collabseheader" onclick="show('bodylanguagesettingsdiv','220px','arrowicon1')">
                        <span id="languagesettingbtn">Language Settings</span>
                        <span>
                            <svg id="arrowicon1" class="arrowdown" xmlns="http://www.w3.org/2000/svg" height="20"
                                width="20">
                                <path d="M10 12.333 5.292 7.667h9.416Z" />
                            </svg>
                        </span>
                    </div>

                    <div id="bodylanguagesettingsdiv" class="collabsebody">
                        <div>
                            <label class="form-control">
                                <input type="radio" id="engine" name="engine" value="neural" checked />
                                <span class="radiotitle">Specific language</span>
                                <p> If you know the language spoken in your source audio, choose this option to get the most
                                    accurate results. </p>
                            </label>
                        </div>
                        <div>
                            <label class="form-control">
                                <input type="radio" id="engine" name="engine" value="neural" />
                                <span class="radiotitle"> Automatic language identification </span>
                                <p> Produces natural - sounding speech </p>
                            </label>
                        </div>
                        <fieldset class="optionsFieldSet">
                            <label for="languageSelected" class="lbloption"> Choose Language </label>
                            <select class="optselect" name="" id="languageSelected">
                                <option value="xyz" class="sltOption"> Chinese, CN(zh - CN) </option>
                                <option value="abc"> English, US </option>
                            </select>
                        </fieldset>
                    </div>

                </div>

                <div class="divcollapse audiosettings">
                    <div class="collabseheader" onclick="show('audiosettingsdiv','75px','arrowicon2')">
                        <span id="audiosettingsbtn"> Audio Settings </span>
                        <span>
                            <svg id="arrowicon2" xmlns="http://www.w3.org/2000/svg" height="20" width="20">
                                <path d="M10 12.333 5.292 7.667h9.416Z" />
                            </svg>
                        </span>
                    </div>

                    <div class="collabsebody" id="audiosettingsdiv">
                        <div>
                            <label class="form-control">
                                <div class="formcntlelement">
                                    <div class="formcntlelementheader">
                                        <span class="radiotitle"> Speaker identification </span>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round">
                                            </span>
                                        </label>
                                    </div>
                                    <p class="formcntlelementdesc">
                                        Identify the different speakers in the stream.Speaker identification might vary in
                                        availability between languages. </p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="divcollapse contentremovalsettings">
                    <div class="collabseheader" onclick="show('contentremovalsettingsdiv','auto','arrowicon3')">
                        <span id="contentremovalsettingsbtn"> Content Removal Settings </span>
                        <span>
                            <svg id="arrowicon3" xmlns=" http://www.w3.org/2000/svg" height="20" width="20">
                                <path d="M10 12.333 5.292 7.667h9.416Z" />
                            </svg>
                        </span>
                    </div>

                    <div class="collabsebody" id="contentremovalsettingsdiv">
                        <div>
                            <label class="form-control">
                                <div class="formcntlelement">
                                    <div class="formcntlelementheader">
                                        <span class="radiotitle"> Vocabulary filtering </span>
                                        <label class="switch">
                                            <input id="vocabularyswitch" type="checkbox" value="vocabularyfilter"
                                                onclick="togglediv('vocabularyswitch','vocabularyextradiv','115px')">
                                            <span class="slider round">
                                            </span>
                                        </label>
                                    </div>
                                    <p class="formcntlelementdesc">
                                        Vocabulary filtering removes, masks, or tags words that you specify in your
                                        vocabulary filter.Choose a vocabulary filter to see an example. </p>
                                    <div class="formcntlelementbody" id="vocabularyextradiv">
                                        <div class="formcntlelementheader">
                                            <span class="radiotitle"> Filter selection </span>
                                        </div>
                                        <p class="formcntlelementdesc">
                                            The vocabulary filters shown here are based on your language settings.You can
                                            choose up to one vocabulary filter per language. </p>
                                        <select class="optselect" name="" id="vocabularyfilterSelected">
                                            <option value="xyz" class="sltOption"> Choose a Vocabulary filter...
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </label>
                            <label class="form-control">
                                <div class="formcntlelement">
                                    <div class="formcntlelementheader">
                                        <span class="radiotitle"> PII Identification & redaction </span>
                                        <label class="switch">
                                            <input type="checkbox" id="identificationandredactionswitch"
                                                onclick="togglediv('identificationandredactionswitch','identificationandredactionextradiv','auto')">
                                            <span class="slider round">
                                            </span>
                                        </label>
                                    </div>
                                    <p class="formcntlelementdesc">
                                        Identify or redact one or more types of personally identifiable information(PII) in
                                        your transcript </p>
                                    <div class="formcntlelementbody" id="identificationandredactionextradiv">
                                        <div>
                                            <label class="form-control">
                                                <input type="radio" id="engine" name="engine" value="neural" />
                                                <span class="radiotitle"> Identification only </span>
                                                <p>
                                                    Label the type of PII identified but not redact it in the transcription
                                                    output
                                                </p>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="form-control">
                                                <input type="radio" id="engine" name="engine" value="neural" />
                                                <span class="radiotitle"> Identification & redaction </span>
                                                <p>
                                                    Label the type of PII and also mask the content with the PII entity type
                                                    in the transcription output.For example, (123) 456 - 7890 will be masked
                                                    as[PHONE] </p>
                                            </label>
                                        </div>
                                        <div class="identificationandredactionSelecttorDiv">
                                            <p class="selectorsheadings"> Select PII entity types(11 of 11 selected) </p>
                                            <input type="checkbox" id="chkall" name="chkall" value="chkall">
                                            <label for="chkall"> Select All </label>

                                            <div class="checkgrp1">
                                                <input type="checkbox" id="chkallfina" name="chkallfina"
                                                    value="chkallfina">
                                                <label for="chkallfina"> Finacial(0 of 6 selected) </label> <br>
                                                <div class="checksubgrp">
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> BANK_ACCOUNT_NUMBER </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> BANK_ROUTING </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> CREDIT_DEBIT_NUMBER </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> CREDIT_DEBIT_CVV </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> CREDIT_DEBIT_EXPIRY </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> PIN </label>
                                                </div>
                                            </div>

                                            <div class="checkgrp2">
                                                <input type="checkbox" id="chkallpersonal" name="chkallpersonal"
                                                    value="chkallpersonal">
                                                <label for="chkallpersonal"> Finacial(0 of 5 selected) </label><br>
                                                <div class="checksubgrp">
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> NAME </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> ADDRESS </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> PHONE </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> EMAIL </label><br>
                                                    <input type="checkbox" class="chkallfina" name="chkallfina"
                                                        value="chkallfina">
                                                    <label for="chkallfina"> SSN </label><br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="divcollapse customizationssettings">
                    <div class="collabseheader" onclick="show('customizationssettingsdiv','auto','arrowicon4')">
                        <span id="customizationssettingsid"> Customizations </span>
                        <span>
                            <svg id="arrowicon4" xmlns="http://www.w3.org/2000/svg" height="20" width="20">
                                <path d="M10 12.333 5.292 7.667h9.416Z" />
                            </svg>
                        </span>
                    </div>

                    <div class="collabsebody" id="customizationssettingsdiv">

                        <label class="form-control">
                            <div class="formcntlelement">
                                <div class="formcntlelementheader">
                                    <span class="radiotitle"> Custom vocabulary </span>
                                    <label class="switch">
                                        <input type="checkbox" id="customvocabularyswitch"
                                            onclick="togglediv('customvocabularyswitch','customvocabularyextradiv','115px')">
                                        <span class="slider round">
                                        </span>
                                    </label>
                                </div>
                                <p class="formcntlelementdesc">
                                    A custom vocabulary improves the accuracy of recognizing words and phrases specific to
                                    your use
                                    case. </p>
                                <div class="formcntlelementbody" id="customvocabularyextradiv">
                                    <div class="formcntlelementheader">
                                        <span class="radiotitle"> Vocabulary selection </span>
                                    </div>
                                    <p class="formcntlelementdesc">
                                        The vocabularies shown here are based on your language settings.You can choose up
                                        to one vocabulary per language. </p>
                                    <select class="optselect" name="" id="vocabularyfilterSelected">
                                        <option value="xyz" class="sltOption"> Choose a Vocabulary filter... </option>
                                    </select>
                                </div>
                            </div>
                        </label>
                        <label class="form-control">
                            <div class="formcntlelement">
                                <div class="formcntlelementheader">
                                    <span class="radiotitle"> Partial results stabilization </span>
                                    <label class="switch">
                                        <input type="checkbox" id="partialresultswitch"
                                            onclick="togglediv('partialresultswitch','partialresultsextradiv','auto')">
                                        <span class="slider round">
                                        </span>
                                    </label>
                                </div>
                                <p class="formcntlelementdesc">
                                    Configure Amazon Transcribe to present results that don 't change as it processes the
                                    transcription output from your stream. </p>
                                <div class="formcntlelementbody" id="partialresultsextradiv">
                                    <div>
                                        <label class="form-control">
                                            <input type="radio" id="engine" name="engine" value="neural" />
                                            <span class="radiotitle"> High </span>
                                            <p>
                                                Provides the most stable partial transcript results with lower accuracy
                                                compared to the Medium and Low settings. </p>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="form-control">
                                            <input type="radio" id="engine" name="engine" value="neural" />
                                            <span class="radiotitle"> Medium </span>
                                            <p>
                                                Provides partial transcription results that have a balance between stability
                                                and accuracy. </p>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="form-control">
                                            <input type="radio" id="engine" name="engine" value="neural" />
                                            <span class="radiotitle"> Low </span>
                                            <p>
                                                Provides the relatively less stable partial transcription result with higher
                                                accuracy compared to the High and Medium settings. </p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label class="form-control">
                            <div class="formcntlelement">
                                <div class="formcntlelementheader">
                                    <span class="radiotitle"> Custom language model </span>
                                    <label class="switch">
                                        <input id="customlanguageswitch" type="checkbox"
                                            onclick="togglediv('customlanguageswitch','customlanguageextradiv','115px')">
                                        <span class="slider round">
                                        </span>
                                    </label>
                                </div>
                                <p class="formcntlelementdesc">
                                    Select the model you want to use with this streaming session. </p>
                                <div class="formcntlelementbody" id="customlanguageextradiv">
                                    <div class="formcntlelementheader">
                                        <span class="radiotitle"> Custom model selection </span>
                                    </div>
                                    <p class="formcntlelementdesc">
                                        The models shown here are based on your language settings.You can choose up to one
                                        model per language </p>
                                    <select class="optselect" name="" id="vocabularyfilterSelected">
                                        <option value="xyz" class="sltOption"> Choose a Vocabulary filter... </option>
                                    </select>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endpush

@push('footer')
    <div class="footerDiv">
        <button id="btndownloadTranscript" class="btn downloadtranscription" onclick="download()">
            <svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
                <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
            </svg>DOWNLOAD TRANSCRIPTION </button>

        <button class="btn reset" onclick="reset()">
            RESET DEMO </button>
    </div>
@endpush


<style>
    .articalcontainer {
        /* margin: 10px 0 0 5px; */
        display: flex;
        width: 100%;
    }

    .title {
        color: #0091FF;
        font-size: 13px !important;
        font-weight: bold !important;
        /* margin: 0 0 10px 0 !important; */
        height: 25px;
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



    .transdiv {
        display: grid;
        grid-template-columns: 1fr;
        /* grid-template-rows: 7% auto 16%; */
        grid-template-rows: 40px 335px 35px 50px 50px;
        ;
        /* border: 1px dotted black; */
        /* padding: 0 15px 0px 15px; */
        /* width: 50%; */
        margin: 10px;
        align-items: center;
    }

    .transcriptlanguage {
        grid-column: 1/4;
    }

    .transdiv p,
    .informationDiv p {
        grid-column: 1/4;
        margin: 10px 0 10px 15px;
        /* height: 5px; */
    }

    #textfromaudio {
        width: 380px;
        height: 300px;
        grid-column: 1/4;
        border-radius: 8px;
        resize: none;
        margin: 5px 15px 0 10px;
        padding: 18px;
        box-sizing: border-box;
        border: 1px solid #DDDDDD;
        color: #888888;
        font-weight: 400;
        overflow-y: auto;
    }

    #textfromaudio::-webkit-scrollbar {
        display: none;
        /*SafariandChrome*/
    }

    .imagediv strong {
        color: #888888;
    }

    .DivlabelbtnUpld {
        grid-column: 1/4;
        margin-left: 15px;
        display: flex;
        /*justify-content:space-evenly;*/
    }

    #SpanfileName {
        align-self: center;
        display: none;
        margin-right: 10px;
    }

    .labelbtnUpld {
        width: 370px;
        display: flex;
        justify-content: center;
        align-items: center;
        /*margin-left:250px;*/
        cursor: pointer;
        /*transition:width0.5scubic-bezier(0.68,-0.55,0.27,1.55);*/
        /*transition:all1sease;*/
        transition: all .5s ease;
        background-color: transparent;
        color: #0091ff;
        box-shadow: 0px 3px 6px #00000029;
        border: 1px solid #0091FF;
        border-radius: 24px;
        opacity: 1;
        height: 36px;
        padding: 5px 10px 5px 10px;
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        font-weight: 100 !important;
        cursor: pointer;
        box-sizing: border-box;
    }



    #btnanalyzing {
        background-color: #0091FF;
        color: white;
        display: none;
        width: 370px;
        margin-left: 15px;
        font-weight: 400 !important;
    }

    #btnSubmit {
        grid-column: 1/4;
        width: 370px;
        margin-left: 15px;
        background-color: #0091FF;
        color: #FFFFFF;
        display: block;
        cursor: pointer;
        font-weight: 400 !important;
    }

    .hrSeperator {
        border: 1px solid #EEEEEE;
        margin: 20px 0;
    }

    .informationDiv {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 5% 95%;
        row-gap: 10px;
        width: 100%;
        /* overflow-y: scroll; */
    }

    .transdiv p {
        /* margin: 0; */
        font-size: 13px;
    }

    .transdiv p span {
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

    .divcollapse:first-child {
        margin-top: 10px;
    }

    .divcollapse {
        border-bottom: 1px solid #DDDDDD;
        margin: 20px 15px;
    }

    .collabsebody {
        -moz-transition: height 0.5s;
        -ms-transition: height 0.5s;
        -o-transition: height 0.5s;
        -webkit-transition: height 0.5s;
        transition: height 0.5s ease;
        transition: height 0.5s ease;
        overflow: hidden;
        /* height: fit-content; */
    }

    .collabseheader {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-weight: bold;
        cursor: pointer;
    }

    .lbloption {
        /* margin: 20px !important; */
        font-weight: bold;
        margin-bottom: 5px;
    }

    .radiotitle {
        color: #000000;
        margin-left: 5px;
        font-weight: 600;
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


    .downloadtranscription {
        /* color: #FFFFFF !important; */
        /* background-color: #0091FF !important; */
        background-color: transparent !important;
        color: #0091FF !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 9px;
        width: 240px !important;
        display: none;
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

    .divcollapses {
        height: 95%;
        overflow-y: auto;
    }

    .divcollapses::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }


    .formcntlelementheader {
        display: flex;
        justify-content: space-between;
    }

    .formcntlelementdesc {
        margin: 10px 5px !important;
        font-size: 11px;
    }

    .formcntlelementbody {
        margin-top: 20px;
        margin-bottom: 10px;
    }

    #vocabularyfilterSelected {
        width: 100%;
        color: #888888;
    }

    /* //slider or toggle button */
    .switch {
        position: relative;
        display: inline-block;
        width: 32px;
        height: 16px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(13px);
        -ms-transform: translateX(13px);
        transform: translateX(13px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 18px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .arrowdown {
        /* animation: rotationdown 2s linear; */
        transform: rotateX(0deg);
        transition: all 0.2s linear;
    }

    .arrowup {
        transform: rotateX(180deg);
        transition: all 0.2s linear;
        /* animation: rotationup 2s linear; */
    }

    /* @keyframes rotationup {
    from {
      transform: rotateX(0deg);
    }

    to {
      transform: rotateX(180deg);
    }
  } */

    /* @keyframes rotationdown {
    from {
      transform: rotateX(0deg);
    }

    to {
      transform: rotateX(180deg);
    }
  } */
    #bodylanguagesettingsdiv,
    #audiosettingsdiv,
    #contentremovalsettingsdiv,
    #customizationssettingsdiv {
        height: 0px;
    }



    /* code for Vocabulary filtering extra div */
    #vocabularyextradiv {
        overflow: hidden;
        transition: height 0.5s ease;
        height: 0px;
    }

    #identificationandredactionextradiv {
        overflow: hidden;
        transition: height 0.5s ease;
        height: 0px;
    }

    #customvocabularyextradiv {
        overflow: hidden;
        transition: height 0.5s ease;
        height: 0px;
    }

    #partialresultsextradiv,
    #customlanguageextradiv {
        overflow: hidden;
        transition: height 0.5s ease;
        height: 0px;
    }

    /* tempoary code
#contentremovalsettingsdiv,
#identificationandredactionextradiv{
    height: auto;
} */

    .selectorsheadings {
        margin: 15px 0 5px 0 !important;
        font-weight: 500;
        color: #000000 !important;
    }

    .identificationandredactionSelecttorDiv input[type='checkbox'] {
        margin: 5px 5px 10px 0;

        width: 20px;
        height: 20px;
    }

    #chkallfina {
        border-radius: 5px !important;
        border: 1px solid #2196F3 !important;
    }

    .identificationandredactionSelecttorDiv label {
        font-family: "Open Sans", sans-serif;
        font-size: 13px;
        font-weight: 400;
    }

    #chkall {
        margin-left: 0px;
    }

    .checkgrp1 {
        margin: 5px;
        margin-left: 10px;

    }

    .checkgrp2 {
        margin-left: 10px;
    }

    .checksubgrp {
        margin-left: 20px;
    }

    @keyframes quiet {
        25% {
            transform: scaleY(.6);
        }

        50% {
            transform: scaleY(.4);
        }

        75% {
            transform: scaleY(.8);
        }
    }

    @keyframes normal {
        25% {
            transform: scaleY(1);
        }

        50% {
            transform: scaleY(.4);
        }

        75% {
            transform: scaleY(.6);
        }
    }

    @keyframes loud {
        25% {
            transform: scaleY(1);
        }

        50% {
            transform: scaleY(.4);
        }

        75% {
            transform: scaleY(1.2);
        }
    }

    /* body {
        display: flex;
        justify-content: center;
        background: black;
        margin: 0;
        padding: 0;
        align-items: center;
        height: 100vh;
    } */

    .waveboxContainer {
        display: flex;
        justify-content: space-evenly;
        height: 36px;
        width: 180px !important;
        align-items: center;
        padding: 0 5px;
    }

    .waves {
        display: flex;
        justify-content: space-evenly;
        --boxSize: 0.1px;
        --gutter: 4px;
        width: calc((var(--boxSize) + var(--gutter)) * 7);
        height: 20px;
    }

    .box {
        transform: scaleY(.4);
        height: 100%;
        width: var(--boxSize);
        background: #0091FF;
        /* background: #12E2DC; */
        animation-duration: 1.2s;
        animation-timing-function: ease-in-out;
        animation-iteration-count: infinite;
        border-radius: 8px;
    }

    .box1 {
        animation-name: quiet;
    }

    .box2 {
        animation-name: normal;
    }

    .box3 {
        animation-name: quiet;
    }

    .box4 {
        animation-name: loud;
    }

    .box5 {
        animation-name: quiet;
    }

    .form-control input[type="radio"] {
        scale: 1.4;
        margin: 5px;
    }
</style>

<script>
    // var chk = document.getElementById('vocabularyswitch');


    function show(div, divheight, icon) {
        var x = document.getElementById(div);
        var icon = document.getElementById(icon);
        // alert(x.clientHeight);
        if (x.clientHeight === 0) {
            x.style.height = divheight;
            // x.style.height = 'auto';
            icon.classList.remove("arrowdown");
            icon.classList.add("arrowup");
        } else {
            x.style.height = '0px';
            icon.classList.remove("arrowup");
            icon.classList.add("arrowdown");
        }
    }

    function togglediv(chkbox, div, divheight) {
        var x = document.getElementById(div);
        var chkbox = document.getElementById(chkbox);
        if (chkbox.checked == true) {
            x.style.height = divheight;
        } else {
            x.style.height = '0px';
        }
    }

    function startRecording() {
        var x = document.getElementById('btnRecord');
        var y = document.getElementById('rdnganimateddiv');
        x.style.display = 'none';
        y.style.display = 'flex';
    }

    function stopRecording() {
        var x = document.getElementById('btnRecord');
        var y = document.getElementById('rdnganimateddiv');
        x.style.display = 'flex';
        y.style.display = 'none';
    }
</script>
