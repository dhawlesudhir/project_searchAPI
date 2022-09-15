@extends('layouts.modal')

@push('scripts')
    <script>
        function uploadpicture(file) {
            // console.log(file.files[0].name);
            var imageobj = document.getElementById('imgUplded');
            imageobj.src = URL.createObjectURL(file.target.files[0]);
            // console.log();
        }
    </script>
@endpush



@push('header')
    <h1>Object Recognition</h1>
@endpush


@push('aside')
    <h4 class="selected">Object Recognition</h4>
@endpush



@push('artical')
    <!-- object recognixation container -->
    <div class="orcontainer">
        <div class="imagediv">
            <p class="title">Document Name</p>
            <picture>
                <img id="imgUplded" src="/assets/images/NoPath.png">
            </picture>
            <!-- <input type="file" class="btn" id="btnChoose" name="myfile"> -->
            <select class="btn" id="btnChoose">Choose Sample Document
                <option value="">Choose Sample Document</option>
            </select>

            <!-- <div> -->
            <!-- <input id="uploadimage" type="file" name="myfile" hidden />
                                                                                                                                                                                                                                                                                                                                                <button class="btn" id="btnUpld" for="#uploadimage">Upload Document</button> -->
            <input type="file" id="btnUpldimage" onchange="uploadpicture(event)" hidden />

            <!--our custom file upload button-->
            <label id="labelbtnUpld" for="btnUpldimage" class="btn">Upload Document</label>
            <!-- </div> -->

        </div>
        <hr class="hrSeperator">
        <div class="informationDiv">
            <div class="tools">
                <div class="iconinputbox">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input id="lblsearch" class="nooutline" type="text" placeholder="Search for a Label...">
                </div>
                <p id="notetext">Check whether we support your label</p>
            </div>
            <div class="objectinformation">
                <p class="title">Results</p>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
                <div class="Oinfolist">
                    <span>Person</span>
                    <span class="alias">99%</span>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('footer')
    <div class="footerDiv">
        <button class="btn download"><svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
                <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
            </svg>Download</button>
        <button class="btn reset">
            RESET DEMO</button>
    </div>
@endpush


<style>
    .title {
        color: #0091FF;
        font-size: 13px !important;
        font-weight: bold !important;
    }

    .orcontainer {
        /* margin: 15px 0 10px 0px; */
        display: flex;
        width: 100%;
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
        /* width: 500px;
        margin: 10px; */

    }

    .imagediv p {
        grid-column: 1/4;
        /* margin: 5px 0 10px 15px; */
        margin: 10px;
        /* height: 5px; */
    }


    img {
        height: 100%;
        width: 100%;
    }

    picture {
        text-align: center;
        grid-column: 1/4;
        border: 1px solid #DDDDDD;
        border-radius: 8px;
        margin: 10px;
        height: 410px;
        width: 450px;
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

    .iconinputbox {
        border: 1px solid #DDDDDD;
        border-radius: 16px;
        padding: 7px 5px 7px 10px;
        display: flex;
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

    .informationDiv {
        display: grid;
        /* display: none; */

        grid-template-columns: 1fr;
        grid-template-rows: 15% auto;
        row-gap: 20px;
        margin: 10px 0;
    }

    .informationDiv .tools {
        margin-left: 80px;
        width: 300px;
        display: grid;
        grid-template-columns: 1fr;
    }

    .informationDiv .tools p {
        /* color: #000000 !important; */
        margin-top: 10px;
        text-align: center;
        font-weight: 400;
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
        margin-left: 10px;
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
