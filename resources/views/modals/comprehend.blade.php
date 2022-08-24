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
        var HTMLContainercall = document.querySelector(".call");
        var HTMLContainerresponse = document.querySelector(".response");

        var cmeditorcall = CodeMirror(HTMLContainercall, {
            lineNumbers: true,
            mode: "htmlmixed"
        });

        cmeditorcall.on("change", (editor) => {
            updateEditor();
        });

        var cmeditorresponse = CodeMirror(HTMLContainerresponse, {
            lineNumbers: true,
            mode: "htmlmixed"
        });

        cmeditorresponse.on("change", (editor) => {
            updateEditor();
        });
    </script>
@endpush

@push('header')
    <h1>Comprehend Demonstration</h1>
@endpush

@push('aside')
    <h4 class="selected">Comprehend</h4>
@endpush

@push('artical')
    <div class="comprehendbodydiv">

        {{-- text area div --}}
        <div class="textareadiv">
            <label for="comprehendtextara" class="headings">Input Text</label>
            <textarea id="comprehendtextara" class="textinput" name="" maxlength="60"
                placeholder="But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and
"
                onkeyup="textchange()"></textarea>
            <p id="textremaining-p" class="pChars">60 Characters remaining</p>

            <div class="textareadivbtns">
                <button class="btnClear btn" onclick="cleartext()">CLEAR TEXT</button>
                <button class="btnAnalyze btn" onclick="cleartext()">analyze</button>
            </div>
        </div>

        <p class="headings tabtitlep">Insights</p>
        <div id="tabs" class="responsive sticky-top bg-white">
            <!-- <div class="tabs tabs-center"> -->
            <a id="btnrawtext" class="tab active" onclick="test('rawtext','btnrawtext')">
                Entities
            </a>
            <a id="btnrawtext" class="tab" onclick="test('rawtext','btnrawtext')">
                Key phrases
            </a>
            <a id="btnrawtext" class="tab" onclick="test('rawtext','btnrawtext')">
                Languages
            </a>
            <a id="btnform" class="tab" onclick="test('form','btnform')">
                PII
            </a>
            <a id="btntbl" class="tab" onclick="test('tbl','btntbl')">
                Sentiment
            </a>
            <a id="btnqry" class="tab" onclick="test('qry','btnqry')">
                Syntax
            </a>
            <!-- </div> -->
        </div>

        <div class="piielements">
            <p class="subtextappintegration">Personally Identifiable information (PII) analysis mode</p>
            <div class="radiospii">

                <label class="form-control">
                    <input type="radio" id="engine" name="engine" value="neural" checked />
                    <span class="radiotitle">Offsets</span>
                    <p> Identify the location of PII in your text documents.</p>
                </label>

                <label class="form-control">
                    <input type="radio" id="engine" name="engine" value="neural" />
                    <span class="radiotitle">Labels</span>
                    <p>Label text documents with PII.</p>
                </label>

            </div>
        </div>


        <div class="analyzedtextdiv">
            <p class="titleanalyzedtextp">Analyzed Text</p>
            <textarea id="comprehendtextaradisabled" class="textinput" name="" maxlength="60" placeholder="English,US"
                disabled>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and</textarea>
        </div>

        <div id="tbl" class="table results">
            <p class="headings">Results</p>

            <div class="tools">

                <div class="iconinputbox">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input id="searchtext" class="nooutline" type="text" placeholder="Search..">
                </div>

                <div id="pagination">
                    <span>
                        < </span>
                            <a href="" class="selected">1</a>
                            <a href="">2</a>
                            <a href="">3</a>
                            <span> > </span>
                </div>
            </div>

            <div class="tablebody">
                <table>
                    <thead>
                        <tr>
                            <th class="col1">Entity</th>
                            <th class="col2">Type</th>
                            <th class="col3">Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>explain how you</td>
                            <td>
                                <span class="line"></span>
                                Person
                            </td>
                            <td>99%</td>
                        </tr>
                        <tr>
                            <td>mistaken idea of denouncing </td>
                            <td>
                                <span class="line"></span>
                                Person
                            </td>
                            <td>99%</td>
                        </tr>
                        <tr>
                            <td>great explorer of the truth</td>
                            <td>
                                <span class="line"></span>
                                Person
                            </td>
                            <td>99%</td>
                        </tr>
                        <tr>
                            <td>explain how you</td>
                            <td>
                                <span class="line"></span>
                                Person
                            </td>
                            <td>99%</td>
                        </tr>
                        <tr>
                            <td>expounding the actual teachings </td>
                            <td>
                                <span class="line"></span>
                                Person
                            </td>
                            <td>99%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tbl" class="language results">
            <p class="headings">Results</p>

            <div class="languagetable">
                <table>
                    <thead>
                        <tr>
                            <th class="col1">Language</th>
                            <th class="col2">Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>English, en</td>
                            <td>99%</td>
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
                    <div class="HTMLContainer call"></div>
                    <button class="btn btncpycall">COPY TEXT</button>
                </div>
                <div class="divapiresponse">
                    <div class="HTMLContainer response"></div>
                    <button class="btn btncpyresponse">COPY TEXT</button>
                </div>
            </div>
        </div>

    </div>
@endpush

@push('footer')
@endpush

<style>
    .comprehendbodydiv {
        width: 100%;
        height: 100%;
        overflow: auto;
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
        border-radius: 5px;
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

    .btn {
        font-weight: 400 !important;
    }


    .btnAnalyze {
        color: #FFFFFF !important;
        background-color: #0091FF !important;
    }


    #comprehendtextaradisabled {
        grid-column: 1/4;
        width: 100%;
        height: 140px;
        border-radius: 5px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #DDDDDD;
        resize: none;
        font-family: "Open Sans", sans-serif;
    }

    .btn {
        height: 30px !important;
        width: 98px !important;
        text-transform: uppercase;
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

    /* end Style the tab */


    .analyzedtextdiv {
        margin: 15px;
    }

    .titleanalyzedtextp {
        color: #111111;
        font-weight: bold;
        margin-bottom: 7px;
    }

    /* styling result content  inside results */
    .results {
        margin: 15px 15px 20px 15px;
    }

    .results p {
        margin-bottom: 15px;
    }

    .results .tools {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        margin-bottom: 15px;
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
        color: #000000 !important;
        width: 400px;
        border: none;
        font-weight: 600;
    }


    /* pagination */
    #pagination {
        display: flex;
        justify-content: space-between;
        width: 150px;
        text-align: center;
        align-content: center;
        font-size: 16px;
        font-weight: 900;
    }

    #pagination a {
        text-decoration: none;
        width: 20px;
        height: 20px;
        color: #111111;
        font-size: 14px;
    }

    #pagination span {
        margin: 0px !important;
    }

    /* selected page */
    #pagination .selected {
        background-color: #DDDDDD;
        border-radius: 50px;
    }


    /* table stling below  */
    table {
        border-collapse: collapse;
    }

    table th {
        text-align: start;
    }

    tbody tr {
        height: 48px;
        margin: 0;
        border-bottom: 1px solid #EEEEEE;
        /* background: #EEEEEE 0% 0% no-repeat padding-box; */

        /* &:last-child {
            border:0;
        } */
    }

    table .col1 {
        width: 500px;
    }

    table .col2 {
        width: 250px;
    }

    table .col3 {
        width: 50px;
    }

    tbody tr .tdcol2 {}

    tbody tr td {
        /* text-align: center; */
        font-weight: 500;
    }

    /* coloured line in table row */
    tbody .line {
        content: "";
        display: inline-block;
        width: 35px;
        height: 3px;
        vertical-align: middle;
        margin-right: 5px;
        background-color: #0091FF;
    }



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
    }

    .btncpycall,
    .btncpyresponse {
        position: absolute;
        right: 0;
    }


    /* hide  */
    .table {
        display: block;
    }

    .language {
        display: block;
    }




    /* language table  */
    .languagetable .col1 {
        width: 750px;
    }

    .languagetable .col2 {
        width: 50px;
    }

    .languagetable tbody tr {
        border-bottom: 0px;
    }

    .piielements {
        margin: 25px 15px;

    }

    .radiospii {
        display: flex;
        gap: 120px;
    }

    .form-control p {
        margin-left: 20px;
        color: #888888;
    }

    .radiotitle {
        color: #000000;
        margin-left: 5px;
        font-weight: 600;
    }
</style>
