@extends('layouts.modal')
@push('style')
    <style>


    </style>
@endpush

@push('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/codemirror.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/htmlmixed/htmlmixed.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/javascript/javascript.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/mode/xml/xml.js'></script>
    <script>
        //

        var HTMLContainer_response = document.querySelector(".HTMLContainercallresponse");
        var HTMLContainer_request = document.querySelector(".HTMLContainercall");



        // function updateEditor_request() {
        //     if (!tinymce.activeEditor.hasFocus()) {
        //         tinymce.activeEditor.setContent(editor_request.getDoc().getValue());
        //     }
        // }


        // function updateEditor_response() {
        //     if (!tinymce.activeEditor.hasFocus()) {
        //         tinymce.activeEditor.setContent(editor_response.getDoc().getValue());
        //     }
        // }


        var editor_request = CodeMirror(HTMLContainer_request, {
            lineNumbers: true,
            mode: "htmlmixed"
        });

        // editor_request.on("change", (editor) => {
        //     updateHTML_request();
        // });

        var editor_response = CodeMirror(HTMLContainer_response, {
            lineNumbers: true,
            mode: "htmlmixed"
        });

        // editor_response.on("change", (editor) => {
        //     updateHTML_response();
        // });

        function updateHTML_response(content) {
            // loading into Var to copytext function use
            responseload = content;
            editor_response.getDoc().setValue(content);
        }

        function updateHTML_request(content) {
            editor_request.getDoc().setValue(content);
        }


        // updateHTML_response(payload);
    </script>
    <script>
        tabData('a_tab_entity', 1);


        function tabData(tabId, tabNumber) {
            addClass(tabId, 'active');
        }


        function addClass(tabId, className) {
            const tabList = document.getElementsByClassName('tab');
            for (const iterator of tabList) {
                if (iterator.classList.contains(className)) {
                    iterator.classList.remove(className);
                }
            }
            document.getElementById(tabId).classList.add(className);
        }
    </script>
@endpush

@push('header')
    <h1>Comprehend Medical</h1>
@endpush

@push('aside')
    <a href="{{ url('/texttospeech') }}">Text To Speech</a>
    <a href="{{ url('/speechtotext') }}">Speech To Text</a>
    <a href="{{ url('/textextract') }}">Text Extract</a>
    <a href="{{ url('/objectrecognisation') }}">Object Recognition</a>
    <a href="{{ url('/comprehend') }}" class="">Comprehend</a>
    <a href="{{ url('/comprehendmedico') }}" class="selected">Comprehend Medical</a>
@endpush

@push('artical')
    <div class="comprehendbodydiv">

        {{-- text area div --}}
        <div class="textareadiv">
            <label for="comprehendtextara" class="headings">Input Text</label>
            <textarea id="comprehendtextara" class="textinput" name="" maxlength="100000" onkeyup="inputChange()">Throughout the interwar period, elements of the fleet conducted visits to ports throughout the Mediterranean, but few fleet exercises occurred due to budget pressures. In 1930, the Maritime Air Force was divorced from Royal Yugoslav Army control, and the naval air arm began to develop significantly, including the establishment of bases along the Adriatic coast. The following year, a British-made flotilla leader was commissioned with the idea that the KM might be able to operate in the Mediterranean alongside the British and French navies.</textarea>
            <p id="textremaining-p" class="pChars">100000 Characters remaining</p>

            <div class="textareadivbtns">
                <button class="btnClear btn" onclick="cleartext()">CLEAR TEXT</button>
                <button id="btnAnalyze" class="btnAnalyze btn" onclick="callcomprehend()">ANALYZE</button>

                <button id="btnanalyzing" type="button" class="btnAnalyze btn" onclick="convert()" hidden>
                    Analyzing <i id="converting" class="fa fa-spinner fa-spin"></i>
                </button>
            </div>
        </div>

        <div class="comprehendresultdiv">
            <p class="headings tabtitlep">Insights</p>
            <div id="tabs" class="responsive sticky-top bg-white">
                <a id="a_tab_entity" class="tab active" onclick="tabData('a_tab_entity',1)">
                    Entities
                </a>
                <a id="a_tab_rxnorm" class="tab" onclick="tabData('a_tab_rxnorm',2)">
                    RxNorm concepts
                </a>
                <a id="a_tab_icd" class="tab" onclick="tabData('a_tab_icd',3)">
                    ICD-10-CM concepts
                </a>
                <a id="a_tab_ct" class="tab" onclick="tabData('a_tab_ct',4)">
                    SNOMED CT concepts
                </a>
            </div>

            <div class="divResultTable">
                <p class="headings">Results</p>

                <div class="divResultTableTools">
                    <div class="iconinputbox">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                        <input id="searchentity" class="nooutline searchtext" type="text" placeholder="Search.."
                            onkeyup="entitidata_filter()">
                    </div>

                    <div id="paginationentity" class="pagination">
                        {{-- <span id="previouspageentity">
                            < </span>
                                <a class="selected" onclick="paginationwork(entities,1)">1</a>
                                <a href="">2</a>
                                <a href="">3</a>
                                <span id="nextpageentity"> > </span> --}}
                        {{-- code will be generated dynamically --}}

                    </div>

                </div>

                <div class="divTable">
                    <table id="tblEntities">
                        <thead>
                            <tr class="tblColumnsName">
                                <th>Entity</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Traits</th>
                            </tr>
                        </thead>
                        <tbody id="tblbodyEntities">
                            <tr class="additionalRecord">
                                <td>
                                    <table>
                                        <tr class="tblbodyEntitiesRecords">
                                            <td>
                                                <i class="fa-solid fa-chevron-up"></i>
                                                <i class="fa-solid fa-chevron-down"></i>
                                                <span onclick="alert('a')">1</span>

                                            </td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                        </tr>
                                        <tr class=" collapsedRecord">
                                            <td style="margin-left:40px">test text skfjfkj</td>
                                            <td>test text sksffsfgsdffsffjfkj</td>
                                            <td>test text skfjfkj</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="tblbodyEntitiesRecords">
                                <td>January</td>
                                <td>$100</td>
                                <td>$100</td>
                                <td>$100</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>


            <div class="appintegration">
                <p class="headings">Application Integration</p>
                <p class="subtextappintegration">API call and API response of DetectEntities API.</p>
                <div class="callresponsedivs">
                    <div class="divapicall">
                        <div id="HTMLContainercall" class="HTMLContainer HTMLContainercall"></div>
                        <button class="btn  btncpy" onclick="copytext(1)">COPY TEXT</button>
                    </div>
                    <div class="divapiresponse">
                        <div id="HTMLContainerresponse" class="HTMLContainer HTMLContainercallresponse"></div>
                        <button class="btn btncpy" onclick="copytext(2)">COPY TEXT</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endpush

@push('footer')
    <div class="footerDiv">
        <button class="btn reset" onclick="reset()">
            RESET DEMO </button>
    </div>
@endpush

<style>
    .comprehendbodydiv {
        width: 100%;
        height: 100%;
        overflow: auto;
    }

    .comprehendbodydiv::-webkit-scrollbar {
        display: none;
        /*SafariandChrome*/
    }


    .textareadiv {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 10px 160px 20px;
        height: 140px;
        /* width: 840px; */
        row-gap: 15px;
        margin: 10px 15px 100px 15px;
    }

    .headings {
        color: #0091FF;
        font-size: 13px !important;
        font-weight: bold !important;
        margin-bottom: 5px;
    }

    #comprehendtextara {
        grid-column: 1/4;
        width: 100%;
        border-radius: 8px;
        padding: 12px 15px 12px 15px !important;
        box-sizing: border-box;
        border: 1px solid #DDDDDD;
        resize: none;
        font-family: "Open Sans", sans-serif;
    }

    #comprehendtextara::placeholder {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #888888;
    }

    #textremaining-p {
        font-size: 13px;
        color: #888888;
    }

    .btnClear {
        font-weight: 100 !important;
        width: 98px !important;

    }

    .btnAnalyze {
        font-weight: 100 !important;
        color: #FFFFFF !important;
        background-color: #0091FF !important;
        text-transform: uppercase;
        width: 98px !important;
    }

    .textareadivbtns {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .tabtitlep {
        margin: 15px;
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

    .divtogglekeypii {
        transition: opacity 4s ease-out;
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
        transition: all 0.35s linear;
    }

    .active {
        border-bottom: 3px solid #0091FF;
    }

    /* end Style the tab */

    /* pagination */
    .pagination {
        display: flex;
        justify-content: space-between;
        width: auto;
        text-align: center;
        align-content: center;
        font-size: 16px;
        font-weight: 900;
        column-gap: 10px;
    }

    .pagination a {
        text-decoration: none;
        width: 20px;
        height: 20px;
        color: #111111;
        font-size: 14px;
    }

    .pagination span {
        margin: 0px !important;
    }

    /* selected page */
    .pagination .selected {
        background-color: #DDDDDD;
        border-radius: 50px;
    }


    /* table stling below  */
    table {
        border-collapse: collapse;
    }


    .tblColumnsName {
        display: flex;
        width: 800px;
        justify-content: space-between;
    }

    .tblbodyEntitiesRecords {
        display: flex;
        width: 800px;
        justify-content: space-between;
        align-items: center;
        height: 48px;
        margin: 0;
        border-bottom: 1px solid #EEEEEE;
    }

    /* bold underline for collapse record */
    tbody .additionalRecord {
        border-bottom: 4px solid #EEEEEE;
        width: 100%;
        height: auto;
    }

    table .collapsedRecord {
        height: 48px;

        border-bottom: 0;
        display: flex;
        width: 800px;
        justify-content: space-between;
        align-items: center;

        /* margin: 10px 0 10px 0; */
        /* visibility: hidden; */
        margin: 0 0 0 50px;
        /* justify-content: space-around; */
    }

    .collapsedRecord {
        /* display: none !important; */
    }

    /* table css end */


    /* // api integration boxes */
    .appintegration {
        margin: 15px;
    }

    .subtextappintegration {
        font-weight: 400;
        margin: 12px 0;
    }

    .callresponsedivs {
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    /* 3rd part code below  */
    .HTMLContainer {
        width: 390px;
        min-height: 300px;
        border: solid 2px #d8e3fa;
        overflow: auto;
        outline: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        resize: none;
        margin-bottom: 10px;
    }

    /* 3rd part code over  */


    .divapicall,
    .divapiresponse {
        position: relative;
        height: 350px;
        margin-bottom: 10px;
    }

    .btncpy {
        position: absolute;
        right: 0;
        width: 98px !important;
        height: 30px !important;
        font-weight: 400 !important;
    }


    .bc-entiry-person {
        background-color: #CE6DBD;
    }

    .bc-entiry-organization {
        background-color: #756BB1;
    }

    .bc-entiry-date {
        background-color: #1E8900;
    }

    .bc-entiry-location {
        background-color: #0073BB;
    }

    .bc-entiry-other {
        background-color: #545B64;
    }

    .bc-entiry-quantity {
        background-color: #77002A;
    }

    .divtext {
        line-height: 28px;
        overflow: hidden;
    }

    .divtext span {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #888888;
    }


    .bb-entiry-person {
        border-bottom: 2px solid #CE6DBD;
    }

    .bb-entiry-organization {
        border-bottom: 2px solid #756BB1;
    }

    .bb-entiry-date {
        border-bottom: 2px solid #1E8900;
    }

    .bb-entiry-location {
        border-bottom: 2px solid #0073BB;
    }

    .bb-entiry-other {
        border-bottom: 2px solid #545B64;
    }

    .bb-entiry-quantity {
        border-bottom: 2px solid #77002A;
    }

    .hoveronspan:hover {
        border-bottom: 2px solid #545B64;

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

    .divResultTable {
        margin: 20px;
    }

    /* //tool box code */
    .divResultTableTools {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin: 20px 0 20px 0;
        gap: 10px;
    }

    .iconinputbox {
        border: 1px solid #DDDDDD;
        border-radius: 16px;
        padding: 7px 5px 7px 10px;
        display: flex;
        box-sizing: border-box;
        height: 30px;
        align-items: center;
    }

    .searchtext {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #000000 !important;
        width: auto;
        min-width: 350px;
        max-width: 400px;
        border: none;
        font-weight: 600;
    }

    .fa-solid,
    .fas {
        font-weight: 900;
        scale: 1.1;
        margin: 0 5px 0 5px;
    }
</style>
