@extends('layouts.modal')

@push('scripts')
<script>
    let fileobjURL = '';
    let fileidfromserver = '';
    let postresponseData = '';
    let getresponseData = '';
    let APP_URL = '';

    disableSubmit();


    let testData = `{
    "status": "COMPLETED",
    "response": {
        "jobResponse": {
            "TranscriptionJobName": "c746a713-b000-4f74-9aab-19224087e93c-371fba6b9f6649518ac9eb16c58949c6.mp3",
            "TranscriptionJobStatus": "COMPLETED",
            "LanguageCode": "en-US",
            "MediaSampleRateHertz": 24000,
            "MediaFormat": "mp3",
            "Media": {
                "MediaFileUri": "s3://transcribe-file-upload-storage/c746a713-b000-4f74-9aab-19224087e93c-371fba6b9f6649518ac9eb16c58949c6.mp3"
            },
            "Transcript": {
                "TranscriptFileUri": "https://s3.ap-south-1.amazonaws.com/transcribe-job-output/c746a713-b000-4f74-9aab-19224087e93c-371fba6b9f6649518ac9eb16c58949c6.mp3.json"
            },
            "StartTime": "2022-09-17 16:20:10.318000+00:00",
            "CreationTime": "2022-09-17 16:20:10.300000+00:00",
            "CompletionTime": "2022-09-17 16:20:29.718000+00:00",
            "Settings": {
                "ChannelIdentification": false,
                "ShowAlternatives": false
            }
        },
        "data": {
            "jobName": "c746a713-b000-4f74-9aab-19224087e93c-371fba6b9f6649518ac9eb16c58949c6.mp3",
            "accountId": "968134349448",
            "results": {
                "transcripts": [
                    {
                        "transcript": "For Prime Minister Narendra modi's birthday today superstar."
                    }
                ],
                "items": [
                    {
                        "start_time": "0.11",
                        "end_time": "0.3",
                        "alternatives": [
                            {
                                "confidence": "0.9983",
                                "content": "For"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "0.3",
                        "end_time": "0.61",
                        "alternatives": [
                            {
                                "confidence": "1.0",
                                "content": "Prime"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "0.61",
                        "end_time": "1.01",
                        "alternatives": [
                            {
                                "confidence": "1.0",
                                "content": "Minister"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "1.01",
                        "end_time": "1.53",
                        "alternatives": [
                            {
                                "confidence": "1.0",
                                "content": "Narendra"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "1.53",
                        "end_time": "1.98",
                        "alternatives": [
                            {
                                "confidence": "0.975",
                                "content": "modi's"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "1.98",
                        "end_time": "2.48",
                        "alternatives": [
                            {
                                "confidence": "1.0",
                                "content": "birthday"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "2.48",
                        "end_time": "3.02",
                        "alternatives": [
                            {
                                "confidence": "1.0",
                                "content": "today"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "start_time": "3.18",
                        "end_time": "4.01",
                        "alternatives": [
                            {
                                "confidence": "0.9986",
                                "content": "superstar"
                            }
                        ],
                        "type": "pronunciation"
                    },
                    {
                        "alternatives": [
                            {
                                "confidence": "0.0",
                                "content": "."
                            }
                        ],
                        "type": "punctuation"
                    }
                ]
            },
            "status": "COMPLETED"
        }
    }
}`;



    function uploadAudio(files) {
        const file = files.target.files[0];
        // fileobjURL = URL.createObjectURL(file);
        fileobjURL = file;
        console.log("file saved " + fileobjURL);
        disableSubmit();
    }

    function apicallsubmit() {

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

        fetch("https://7khsyf0wyi.execute-api.ap-south-1.amazonaws.com/dev/upload", requestOptions)
            .then(response => {
                document.getElementById("btnSubmit").style.display = "block";
                document.getElementById("btnanalyzing").style.display = "none";
                if (response.ok) {
                    return response.json();
                }
                if (response.status == 415) {
                    alert('Unsupported file/image uploaded');
                    throw new Error(415);
                }
            })
            .then(result => {
                console.log("fetch response - " + result.TranscriptionJobName);
                responseData = result;
                apicallget();
            })
            .catch(error => console.log('error', error));
    }

    function apicallget() {
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("https://7khsyf0wyi.execute-api.ap-south-1.amazonaws.com/dev/get-transcribe?name=" +
                responseData.TranscriptionJobName, requestOptions)
            .then(response => response.json())
            .then(result => {
                getresponseData = result;
                console.log(result);
                processResponse(getresponseData);
            })
            .catch(error => console.log('error', error));
    }
    processResponse(JSON.parse(testData));

    function processResponse(response) {
        console.log(response.status);
        console.log(response.response.jobResponse.TranscriptionJobStatus);
        transcript = response.response.data.results.transcripts[0].transcript;
        document.getElementById('textfromaudio').innerHTML = transcript;
    }

    // prevent submit action if nofile data
    function disableSubmit() {
        const button = document.getElementById('btnSubmit')
        if (!fileobjURL) {
            button.disabled = true;
        } else {
            button.disabled = false;
        }
    }
</script>
@endpush

@push('header')
Speech To Text
@endpush


@push('aside')
<h4 class="selected">Speech To Text</h4>
@endpush



@push('artical')
<!-- speech to text container -->
<div class="articalcontainer">
    <div class="transdiv">
        <p class="title">Transcription Output</p>
        <div name="" id="textfromaudio">
            Click <strong>Start Transcribing</strong> below to begin a real-time transcription of what you speak into
            your microphone
        </div>

        {{-- <div class="divrecord"> --}}
        <p class="transcriptlanguage">Current language: <span>English, US</span> </p>

        <input type="file" id="btnUpldimage" onchange="uploadAudio(event)" hidden />
        <!--our custom file upload button-->
        <label id="btnanalyze" for="btnUpldimage" class="btn labelbtnUpld">Upload Audio</label>

        <button id="btnanalyzing" type="button" class="labelbtnUpld btn">
            <i id="converting" class="fa fa-spinner fa-spin"></i> Uploading
        </button>
        <button id="btnSubmit" class="btn" onclick="apicallsubmit()">Submit</button>

        {{-- <button id="btnRecord" for="actual-btn" class="btn" onclick="startRecording()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20">
                        <path fill="#0091ff"
                            d="M10.021 12.208q-1.25 0-2.146-.896-.896-.895-.896-2.145V4.146q0-1.25.896-2.136.896-.885 2.146-.885t2.135.885q.886.886.886 2.136v5.021q0 1.25-.875 2.145-.875.896-2.146.896Zm-1.167 6v-2.437q-2.437-.333-4-2.219-1.562-1.885-1.562-4.385h2.291q0 1.854 1.302 3.125 1.303 1.27 3.136 1.27 1.833 0 3.125-1.27 1.292-1.271 1.292-3.125h2.291q0 2.5-1.562 4.385-1.563 1.886-4.021 2.219v2.437Z" />
                    </svg>START TRANSCRIBING
                </button>
                <div id="rdnganimateddiv" style="display: none;" class="btn waveboxContainer" onclick="stopRecording()">
                    Recording
                    <div class="waves">
                        <div class="box box1"></div>
                        <div class="box box2"></div>
                        <div class="box box3"></div>
                        <div class="box box4"></div>
                        <div class="box box5"></div>
                    </div>
                    <p>click to stop</p>
                </div> --}}

        {{-- </div> --}}

    </div>

    <hr class="hrSeperator">

    <div class="informationDiv">
        <p class="title">Settings</p>
        <div class="divcollapses">

            <div class="divcollapse languagesettings">
                <div class="collabseheader" onclick="show('bodylanguagesettingsdiv','187px','arrowicon1')">
                    <span id="languagesettingbtn">Language Settings</span>
                    <span>
                        <svg id="arrowicon1" class="arrowdown" xmlns="http://www.w3.org/2000/svg" height="20" width="20">
                            <path d="M10 12.333 5.292 7.667h9.416Z" />
                        </svg>
                    </span>
                </div>

                <div id="bodylanguagesettingsdiv" class="collabsebody">
                    <div>
                        <label class="form-control">
                            <input type="radio" id="engine" name="engine" value="neural" />
                            <span class="radiotitle">Specific language</span>
                            <p> If you know the language spoken in your source audio, choose this option to get the most
                                accurate results.
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

            <div class="divcollapse audiosettings">
                <div class="collabseheader" onclick="show('audiosettingsdiv','75px','arrowicon2')">
                    <span id="audiosettingsbtn">Audio Settings</span>
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
                                    <span class="radiotitle">Speaker identification</span>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <p class="formcntlelementdesc">
                                    Identify the different speakers in the stream. Speaker identification might vary in
                                    availability between languages.
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="divcollapse contentremovalsettings">
                <div class="collabseheader" onclick="show('contentremovalsettingsdiv','auto','arrowicon3')">
                    <span id="contentremovalsettingsbtn">Content Removal Settings</span>
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
                                    <span class="radiotitle">Vocabulary filtering</span>
                                    <label class="switch">
                                        <input id="vocabularyswitch" type="checkbox" value="vocabularyfilter" onclick="togglediv('vocabularyswitch','vocabularyextradiv','115px')">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <p class="formcntlelementdesc">
                                    Vocabulary filtering removes, masks, or tags words that you specify in your
                                    vocabulary filter. Choose a vocabulary filter to see an example.
                                </p>
                                <div class="formcntlelementbody" id="vocabularyextradiv">
                                    <div class="formcntlelementheader">
                                        <span class="radiotitle">Filter selection</span>
                                    </div>
                                    <p class="formcntlelementdesc">
                                        The vocabulary filters shown here are based on your language settings. You can
                                        choose up to one vocabulary filter per language.
                                    </p>
                                    <select class="optselect" name="" id="vocabularyfilterSelected">
                                        <option value="xyz" class="sltOption">Choose a Vocabulary filter...
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </label>
                        <label class="form-control">
                            <div class="formcntlelement">
                                <div class="formcntlelementheader">
                                    <span class="radiotitle">PII Identification & redaction</span>
                                    <label class="switch">
                                        <input type="checkbox" id="identificationandredactionswitch" onclick="togglediv('identificationandredactionswitch','identificationandredactionextradiv','auto')">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <p class="formcntlelementdesc">
                                    Identify or redact one or more types of personally identifiable information (PII) in
                                    your transcript
                                </p>
                                <div class="formcntlelementbody" id="identificationandredactionextradiv">
                                    <div>
                                        <label class="form-control">
                                            <input type="radio" id="engine" name="engine" value="neural" />
                                            <span class="radiotitle">Identification only</span>
                                            <p>
                                                Label the type of PII identified but not redact it in the transcription
                                                output
                                            </p>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="form-control">
                                            <input type="radio" id="engine" name="engine" value="neural" />
                                            <span class="radiotitle">Identification & redaction</span>
                                            <p>
                                                Label the type of PII and also mask the content with the PII entity type
                                                in the transcription output. For example, (123)456-7890 will be masked
                                                as [PHONE]
                                            </p>
                                        </label>
                                    </div>
                                    <div class="identificationandredactionSelecttorDiv">
                                        <p class="selectorsheadings">Select PII entity types (11 of 11 selected)</p>
                                        <input type="checkbox" id="chkall" name="chkall" value="chkall">
                                        <label for="chkall">Select All</label>

                                        <div class="checkgrp1">
                                            <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                            <label for="chkallfina">Finacial (0 of 6 selected)</label> <br>
                                            <div class="checksubgrp">
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">BANK_ACCOUNT_NUMBER</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">BANK_ROUTING</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">CREDIT_DEBIT_NUMBER</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">CREDIT_DEBIT_CVV</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">CREDIT_DEBIT_EXPIRY</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">PIN</label>
                                            </div>
                                        </div>

                                        <div class="checkgrp2">
                                            <input type="checkbox" id="chkallpersonal" name="chkallpersonal" value="chkallpersonal">
                                            <label for="chkallpersonal">Finacial (0 of 5 selected)</label><br>
                                            <div class="checksubgrp">
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">NAME</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">ADDRESS</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">PHONE</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">EMAIL</label><br>
                                                <input type="checkbox" id="chkallfina" name="chkallfina" value="chkallfina">
                                                <label for="chkallfina">SSN</label><br>
                                                {{-- <input type="checkbox" id="chkallfina"  name="chkallfina" value="chkallfina">
                            <label for="chkallfina">Finacial (6 of 6 selected)</label> --}}
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
                    <span id="customizationssettingsid">Customizations</span>
                    <span>
                        <svg id="arrowicon4" xmlns="http://www.w3.org/2000/svg" height="20" width="20">
                            <path d="M10 12.333 5.292 7.667h9.416Z" />
                        </svg>
                    </span>
                </div>

                <div class="collabsebody" id="customizationssettingsdiv">
                    <!-- <div> -->
                    <label class="form-control">
                        <div class="formcntlelement">
                            <div class="formcntlelementheader">
                                <span class="radiotitle">Custom vocabulary</span>
                                <label class="switch">
                                    <input type="checkbox" id="customvocabularyswitch" onclick="togglediv('customvocabularyswitch','customvocabularyextradiv','115px')">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="formcntlelementdesc">
                                A custom vocabulary improves the accuracy of recognizing words and phrases specific to
                                your use case.
                            </p>
                            <div class="formcntlelementbody" id="customvocabularyextradiv">
                                <div class="formcntlelementheader">
                                    <span class="radiotitle">Vocabulary selection</span>
                                </div>
                                <p class="formcntlelementdesc">
                                    The vocabularies shown here are based on your language settings. You can choose up
                                    to one vocabulary per language.
                                </p>
                                <select class="optselect" name="" id="vocabularyfilterSelected">
                                    <option value="xyz" class="sltOption">Choose a Vocabulary filter...</option>
                                </select>
                            </div>
                        </div>
                    </label>
                    <label class="form-control">
                        <div class="formcntlelement">
                            <div class="formcntlelementheader">
                                <span class="radiotitle">Partial results stabilization</span>
                                <label class="switch">
                                    <input type="checkbox" id="partialresultswitch" onclick="togglediv('partialresultswitch','partialresultsextradiv','auto')">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="formcntlelementdesc">
                                Configure Amazon Transcribe to present results that don't change as it processes the
                                transcription output from your stream.
                            </p>
                            <div class="formcntlelementbody" id="partialresultsextradiv">
                                <div>
                                    <label class="form-control">
                                        <input type="radio" id="engine" name="engine" value="neural" />
                                        <span class="radiotitle">High</span>
                                        <p>
                                            Provides the most stable partial transcript results with lower accuracy
                                            compared to the Medium and Low settings.
                                        </p>
                                    </label>
                                </div>
                                <div>
                                    <label class="form-control">
                                        <input type="radio" id="engine" name="engine" value="neural" />
                                        <span class="radiotitle">Medium</span>
                                        <p>
                                            Provides partial transcription results that have a balance between stability
                                            and accuracy. </p>
                                    </label>
                                </div>
                                <div>
                                    <label class="form-control">
                                        <input type="radio" id="engine" name="engine" value="neural" />
                                        <span class="radiotitle">Low</span>
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
                                <span class="radiotitle">Custom language model</span>
                                <label class="switch">
                                    <input id="customlanguageswitch" type="checkbox" onclick="togglediv('customlanguageswitch','customlanguageextradiv','115px')">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="formcntlelementdesc">
                                Select the model you want to use with this streaming session.
                            </p>
                            <div class="formcntlelementbody" id="customlanguageextradiv">
                                <div class="formcntlelementheader">
                                    <span class="radiotitle">Custom model selection</span>
                                </div>
                                <p class="formcntlelementdesc">
                                    The models shown here are based on your language settings. You can choose up to one
                                    model per language </p>
                                <select class="optselect" name="" id="vocabularyfilterSelected">
                                    <option value="xyz" class="sltOption">Choose a Vocabulary filter...</option>
                                </select>
                            </div>
                        </div>
                    </label>
                    <!-- </div> -->
                </div>
            </div>

        </div>

    </div>
</div>
@endpush

@push('footer')
<div class="footerDiv">
    <button class="btn downloadtranscription">
        <svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
            <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
        </svg>DOWNLOAD TRANSCRIPTION
    </button>
    <button class="btn reset">
        RESET DEMO</button>
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
        width: 50%;
        margin: 10px;
        align-items: center;
    }

    .transcriptlanguage {
        grid-column: 1/4;
    }

    .transdiv p,
    .informationDiv p {
        grid-column: 1/4;
        margin: 5px 0 10px 15px;
        /* height: 5px; */
    }

    #textfromaudio {
        width: 380px;
        height: 325px;
        grid-column: 1/4;
        border-radius: 8px;
        resize: none;
        margin: 5px 15px 0 10px;
        padding: 18px;
        box-sizing: border-box;
        border: 1px solid #DDDDDD;
        color: #888888;
        font-weight: 400;
    }

    .imagediv strong {
        color: #888888;
    }

    .labelbtnUpld {
        width: 370px !important;
        display: flex;
        justify-content: center;
        align-items: center;
        /* margin-left: 250px; */
        grid-column: 1/4;
        margin-left: 15px;
        cursor: pointer;
    }

    #btnSubmit {
        display: block;
        cursor: pointer;
    }

    #btnanalyzing {
        background-color: #0091FF;
        color: white;
        display: none;
    }

    #btnSubmit {
        grid-column: 1/4;
        width: 370px;
        margin-left: 15px;
        background-color: #0091FF;
        color: white;
    }

    .hrSeperator {
        border: 1px solid #EEEEEE;
        margin: 5px 0 20px 0;
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
    }


    .reset {
        text-align: center;
        margin-right: 20px;
        width: 120px !important;
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
        border-radius: 5px;
        border: 1px solid #2196F3;
        width: 15px;
        height: 15px;
    }

    .identificationandredactionSelecttorDiv label {
        font-family: "Open Sans", sans-serif;
        font-size: 13px;
        font-weight: 500;
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