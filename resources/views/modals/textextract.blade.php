@extends('layouts.modal')

@push('header')
    Text Extract
@endpush

@push('aside')
    <a href="{{ url('/speechtotext') }}">Speech To Text</a>
    <a href="{{ url('/texttospeech') }}">Text To Speech</a>
    <a href="{{ url('/textextract') }}" class="selected">Text Extract</a>
    <a href="{{ url('/comprehend') }}">Comprehend Demonstration</a>
    <a href="{{ url('/objectrecognisation') }}">Object Recognition</a>
@endpush

@push('artical')
    <!-- text extract  container -->
    <div class="orcontainer">

        <div class="imagediv">
            <p class="title">Document Name</p>
            <picture>
                <img id="imagefortextExtract" src="{{ url('/assets/images/NoPath.png') }}">
            </picture>
            <!-- <input type="file" class="btn" id="btnChoose" name="myfile"> -->
            {{-- <select class="btn" id="btnChoose">Choose Sample Document
                <option value="">Choose Sample Document</option>
            </select> --}}

            <!-- <div> -->
            <!-- <input id="uploadimage" type="file" name="myfile" hidden />
                                                                                                                                                                                                                                                                                                                                       <button class="btn" id="btnUpld" for="#uploadimage">Upload Document</button> -->
            <input type="file" id="actual-btn" accept="image/gif, image/jpeg, image/png" onchange="uploadpicture(event)"
                hidden />

            <!--our custom file upload button-->
            <label id="btnUpld" for="actual-btn" class="btn labelbtnUpld">Upload
                Document</label>
            <!-- </div> -->
            <button id="btnanalyzing" type="button" class="labelbtnUpld btn">
                Analyzing <i id="converting" class="fa fa-spinner fa-spin"></i>
            </button>
        </div>

        <hr class="hrSeperator">

        <div class="informationDiv">
            <p class="title">Results</p>

            <div id="tabs" class="responsive sticky-top bg-white">
                <!-- <div class="tabs tabs-center"> -->
                <a id="btnrawtext" class="tab active" onclick="toggleTabs('rawtext','btnrawtext')">
                    Raw Text
                </a>
                <a id="btnform" class="tab" onclick="toggleTabs('form','btnform')">
                    Forms
                </a>
                <a id="btntbl" class="tab" onclick="toggleTabs('tbl','btntbl')">
                    Tables
                </a>
                <a id="btnqry" class="tab" onclick="toggleTabs('qry','btnqry')">
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
                        <input id="searchrawtext" class="nooutline" type="text" placeholder="Search.."
                            onkeyup="rawtext_filter()">
                    </div>
                    {{-- <select id="segmentline" name="" id="">
                        <option value="">Segment by line</option>
                    </select> --}}
                </div>

                <div id="rawtext-tags" class="tagstext scrolloverlay">
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
                        <input id="searchformtext" class="nooutline" type="text" placeholder="Search.."
                            onkeyup="formtext_filter()">
                    </div>
                </div>

                <div id="formItems" class="fromsitems scrolloverlay">
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
                        <input id="searchtbltext" class="nooutline" type="text" placeholder="Search.."
                            onkeyup="tabledata_filter()">
                    </div>
                </div>

                <div class="tablebody scrolloverlay">
                    <table id="table-textExtract">
                        <tr>
                            <th class="itemname">Item</th>
                            <th class="qty">Qty.</th>
                            <th class="price">Price</th>
                            <th class="total">Total</th>
                        </tr>
                        <tbody id='tbody-textExtract'>
                            {{-- <tr>
                                <td>Latte Macchiato</td>
                                <td>2</td>
                                <td>4.50</td>
                                <td>9</td>
                            </tr> --}}
                        </tbody>
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

                <div id="div-qrys" class="qryitems scrolloverlay">
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
        {{-- <button class="btn download">
            Download
            <svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)"
                xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 18">
                <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
                <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
            </svg>
        </button> --}}
        <button class="btn reset" onclick="reset(true)">
            RESET DEMO
        </button>
    </div>
@endpush

<style>
    .orcontainer {
        /* margin: 15px 0 10px 0px; */
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
        /* margin: 5px 0 20px 0; */
    }

    .imagediv {
        display: grid;
        grid-template-columns: 1fr;
        grid-auto-rows: 45px 420px 45px;
        /* background-color: #EEEEEE; */
        width: 350px;
        margin: 10px 20px;
        align-items: center;

    }

    .imagediv p {
        grid-column: 1/4;

    }

    .informationDiv p {
        grid-column: 1/4;
        margin-top: 10px;
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
        /* margin: 0px 0px 10px 20px; */
        height: 400px;
        width: 360px;
    }

    .labelbtnUpld {
        width: 140px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 160px;
    }

    #btnanalyzing {
        display: none;
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
        grid-template-rows: 35px 50px 420px;
        width: 350px;
        align-items: start;
        margin: 10px
    }

    /* Style the tab */
    #tabs {
        overflow: hidden;
        border-bottom: 1px solid #EEEEEE;
        /* margin: 0 25px 0 25px; */
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        grid-column: 1/4;
        width: 440px;
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
        width: 440px;
        /* margin: 0 20px 0 20px; */
        grid-column: 1/2;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 50px 350px;
        transition: all 0.5s ease-in;
        transition: opacity 4s ease-out;
        transition: all 0.35s linear;

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

    .nooutline {
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #000000;
        width: 350px;
        border: none;
    }

    .nooutline::placeholder {
        font-size: 13px;
        color: #000000;
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

    .tagstext {
        display: flex;
        flex-wrap: wrap;
        /* justify-content: space-between; */
        align-content: flex-start;
        align-items: center;
        overflow: auto;
        height: 350px;
        /* grid-template-rows: 1fr; */
    }

    .scrolloverlay {
        overflow: scroll;
    }

    .scrolloverlay::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
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
        /* background-color: #0091FF !important; */
        background-color: transparent !important;
        color: #0091FF !important;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 9px;
    }



    .reset {
        text-align: center;
        margin-right: 20px;
        padding: 5px;
        width: 120px !important;
    }

    /* tab toggle manual */
    .rawtext {
        display: grid;
        transition: all 4s linear;
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

    .forms .nooutline {
        width: 350px;
    }

    .tables .nooutline {
        width: 350px;
    }

    .fromsitems {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: repeat(5, 50px);
        row-gap: 30px;
        column-gap: 20px;
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
        height: auto;
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

    img {
        object-fit: contain;
    }
</style>
@push('scripts')
    <script>
        let responseData;
        let bodyobj;
        let kvsobj;
        let tableobj;
        defaultmsg = `<b> No records found!</b>`;
        var baseurl = "{{ env('APP_URL') }}";

        let Testdata = `{
    "statusCode": 200,
    "body": [
        "Berghotel",
        "Grosse Scheidegg",
        "3918 Grindelwald",
        "Faxilie R.Muller",
        "Rech.Nr. 4572",
        "30.07.2007/13:29:17",
        "Bar",
        "Tisch 7/01",
        "2xLatte Macchiato",
        "A",
        "4.50 CHF",
        "9.00",
        "1xGlcki",
        "& 5.00 CHF",
        "5.00",
        "1xSchweinschnitze 3 22.00 CHF",
        "22.00",
        "1xChässpatzli",
        ", 18.50 CHF 18.50",
        "Total",
        "OF",
        "54.50",
        "Incl. 7.6% MWSt 54.50 CHF: 3.85",
        "Entspricht in Euro 36.33 ELR",
        "Es bediente Sie: Ursula",
        "PvSt Nr.: 430 234",
        "Tel.: 033 853 87 16",
        "Fax.: 033 853 87 19",
        "E-mail:"
    ],
    "kvs": {
        "Rech. Nr. ": [
            "4572 "
        ],
        "Tisch ": [
            "7/01 "
        ],
        "PvSt ": [
            "433 234 "
        ],
        "E-wail: ": [
            ""
        ],
        "Total : ": [
            "CHF 54.50 "
        ],
        "54.50 CHF: ": [
            "3.85 "
        ],
        "Es bediente Sie: ": [
            "Ursula "
        ],
        "Tel.: ": [
            "033 653 97 16 "
        ],
        "Fax.: ": [
            "033 053 37 19 "
        ],
        "Incl. ": [
            "7.6% "
        ]
    },
    "table": [
        {
            "1": {
                "1": "2xlatte Macchiate ",
                "2": "& ",
                "3": "4.50 ",
                "4": "CHF 9.00 "
            },
            "2": {
                "1": "1xGloki ",
                "2": "à ",
                "3": "5.00 ",
                "4": "CHF 5.00 "
            },
            "3": {
                "1": "",
                "2": "à ",
                "3": "22.00 ",
                "4": "CHF 22.00 "
            },
            "4": {
                "1": "1xChässpätzli ",
                "2": "à ",
                "3": "18.50 ",
                "4": "CHF 18.50 "
            }
        }
    ]
}`;

        reset(true);
        // now
        function uploadpicture(files) {
            const file = files.target.files[0];
            console.log(file.type);
            if (file.type == 'image/jpeg' || file.type == 'image/png') {
                fileobjURL = URL.createObjectURL(file);
                reset(false);
                apicall(file);
            } else {
                alert('Unsupported file!');
            }
        }

        function reset(mode) {
            let imgElement = document.getElementById('imagefortextExtract');

            if (!mode) {
                imgElement.src = fileobjURL;
            } else {
                imgElement.src = baseurl + '/assets/images/NoPath.png';
                processResponseData(JSON.parse(Testdata));

            }
        }


        function apicall(file) {

            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "image/png");

            var file = file;

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: file,
                redirect: 'follow'
            };

            document.getElementById("btnUpld").style.display = "none";
            document.getElementById("btnanalyzing").style.display = "block";

            fetch("https://wmo8056gr6.execute-api.ap-south-1.amazonaws.com/dev/textractapiresource", requestOptions)
                .then(response => {
                    document.getElementById("btnUpld").style.display = "flex";
                    document.getElementById("btnanalyzing").style.display = "none";
                    if (response.ok) {
                        return response.json()
                    }
                    if (response.status == 415) {

                        throw new Error(415);
                    }
                })
                .then(result => {
                    console.log("response code - " + result.statusCode);
                    console.log("fetch response - " + result[0]);
                    if (result.statusCode == 200) {
                        responseData = result;
                    }
                    processResponseData(result);
                })
                .catch(error => console.log('error', error));
        }


        function processResponseData(response) {

            bodyobj = response.body;

            kvsobj = response.kvs;


            tableobj = response.table;

            processRawText(bodyobj);
            processFormData(kvsobj);
            processTableData(tableobj);
            processQueryData('');
        }

        function processRawText(obj) {
            divobj = document.getElementById('rawtext-tags');
            divobj.innerHTML = '';

            if (obj.length == 0) {
                divobj.innerHTML = defaultmsg;
            } else {
                for (let index = 0; index < obj.length; index++) {
                    divobj.innerHTML += `<span class="item">` + obj[index] + `</span>`;
                }
            }
        }

        function processFormData(obj) {
            formdataarray = Object.keys(obj);
            // console.log(obj[formdataarray[0]]);

            divobj = document.getElementById('formItems');
            divobj.innerHTML = '';

            if (formdataarray.length == 0) {
                divobj.innerHTML = defaultmsg;
            } else {
                for (let index = 0; index < formdataarray.length; index++) {
                    name = formdataarray[index];
                    value = obj[formdataarray[index]];
                    divobj.innerHTML += `<div class="fromsitem"> <p>` + name + `</p> <p>` + value + `</p> </div>`;
                }
            }
        }

        function processTableData(obj) {
            console.log('table');
            rows = Object.keys(obj);
            console.log(rows);

            // console.log("rows " + rows);
            divobj = document.getElementById('tbody-textExtract');
            divobj.innerHTML = ' ';

            if (rows.length == 0) {
                divobj.innerHTML = defaultmsg;
            } else {
                teststring = '';
                let tableCount = 0;
                obj.forEach(element => {
                    rows = Object.keys(element);
                    // console.log("rows " + rows.length);
                    for (let rowindex = 0; rowindex < rows.length; rowindex++) {
                        columns = Object.keys(obj[tableCount][rows[rowindex]]);
                        // console.log("columns " + columns.length);
                        // divobj.innerHTML += '<tr>';
                        teststring += '<tr>';

                        for (let index = 0; index < columns.length; index++) {
                            value = obj[tableCount][rows[rowindex]][columns[index]];
                            // console.log(value);
                            // divobj.innerHTML += '<td>' + value + '</td>';
                            teststring += '<td>' + value + '</td>';
                        }
                        // divobj.innerHTML += '</tr>';
                        teststring += '</tr>';
                    }
                    // console.log(teststring);
                    divobj.innerHTML = teststring;
                    tableCount++;
                });
                console.log('table' + tableCount);
            }
        }

        function processQueryData(obj) {
            formdataarray = Object.keys(obj);
            // console.log(obj[formdataarray[0]]);

            divobj = document.getElementById('div-qrys');
            if (obj.length == 0) {
                divobj.innerHTML = defaultmsg;
            } else {
                //action to be implemented
            }
        }



        function rawtext_filter() {
            var searchvalue = document.getElementById('searchrawtext').value;
            searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);

            datavalues = Object.values(bodyobj);
            console.log(datavalues);

            var text_filter = datavalues.filter(element => ((element).toUpperCase()).search(searchvalue) != -1);

            tempentities = text_filter;

            processRawText(tempentities);
        }

        // not working, should work on it for KG
        function formtext_filter1() {
            var searchvalue = document.getElementById('searchformtext').value;
            // searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);

            datavalues = Object.values(kvsobj);

            console.log(datavalues);

            var text_filter = datavalues.filter(element => {
                console.log(Object.keys(element));
                if (element == searchvalue) return element;
            });
            console.log(text_filter.length + " / " + searchvalue);
            if (text_filter.length == 0 && searchvalue == '') {
                tempentities = kvsobj;
            } else {
                tempentities = text_filter;
            }

            processFormData(tempentities);
        }

        function formtext_filter() {
            var searchvalue = document.getElementById('searchformtext').value;
            searchvalue = searchvalue.toUpperCase();
            // console.log(searchvalue);
            if (searchvalue) {
                formdataarray = Object.keys(kvsobj);
                // console.log(obj[formdataarray[0]]);
                divobj = document.getElementById('formItems');
                divobj.innerHTML = ' ';

                if (formdataarray.length == 0) {
                    divobj.innerHTML = defaultmsg;
                } else {
                    let flag = false;
                    for (let index = 0; index < formdataarray.length; index++) {
                        name = formdataarray[index].toString().trim();
                        // console.log(kvsobj[formdataarray[index]]);
                        value = kvsobj[formdataarray[index]].toString().trim();
                        name1 = name.toUpperCase();
                        value1 = value.toUpperCase();

                        if (name1.includes(searchvalue) || value1.includes(searchvalue)) {
                            divobj.innerHTML += `<div class="fromsitem"> <p>` + name + `</p> <p>` + value +
                                `</p> </div>`;
                            flag = true;
                        }
                    }
                    if (flag == false) {
                        divobj.innerHTML = defaultmsg;
                    }
                }
            } else {
                processFormData(kvsobj);
            }
        }

        function tabledata_filter() {
            var searchvalue = document.getElementById('searchtbltext').value;
            searchvalue = searchvalue.toUpperCase();
            console.log(searchvalue);
            if (searchvalue == '') {
                processTableData(tableobj);
                return;
            }
            divobj = document.getElementById('tbody-textExtract');
            divobj.innerHTML = '';
            // checking if response has rows
            rows = Object.keys(tableobj);

            let flag = false;
            if (rows.length == 0) {
                divobj.innerHTML = defaultmsg;
            } else {
                let Tablecount = 0;
                tableobj.forEach(element => {
                    rows = Object.keys(element);
                    // console.log("rows " + rows.length);
                    for (let rowindex = 0; rowindex < rows.length; rowindex++) {
                        columns = Object.keys(tableobj[Tablecount][rows[rowindex]]);
                        // console.log("columns " + columns.length);
                        // console.log("search " + searchvalue);


                        for (let index = 0; index < columns.length; index++) {

                            // value toString as it can have numbers and triming
                            value = tableobj[Tablecount][rows[rowindex]][columns[index]].toString().trim();

                            // toUpperCase to match with searchvalue
                            value1 = value.toUpperCase();


                            if (value1.includes(searchvalue)) {

                                // if data matched make flag true,
                                flag = true;

                                // if columns has matching value add all columns
                                filltable_supportfunction(tableobj[Tablecount][rows[rowindex]]);
                                // if any of columns match from row break loop and goto next row
                                break;
                            }
                        }
                    }
                    Tablecount++;
                });
                // flag == false - no matching result found
                if (flag == false) {
                    divobj.innerHTML = defaultmsg;
                }
            }
        }

        function filltable_supportfunction(data) {

            columns = Object.keys(data);
            console.log(data);
            teststring = '<tr>';

            for (let index = 0; index < columns.length; index++) {
                value = data[columns[index]].toString().trim();
                // console.log(value);
                teststring += '<td>' + value + '</td>';
            }
            teststring += '</tr>';
            divobj.innerHTML += teststring;
        }

        function toggleTabs(id, btnid) {
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
    </script>
@endpush
