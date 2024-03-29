@extends('layouts.modal')

@push('scripts')
    <script>
        // varible declaration here
        let fileobjURL = '';
        let responseData = '';
        let Labels = '';
        let dataforDownload = [];
        let imageWidth = '450';
        let imageHeight = '400';
        var localhost = "{{ env('APP_URL') }}";

        // alert(localhost);

        // data for tesing
        let TESTresponseData = `{
    "statusCode": 200,
    "body": {
        "Labels": [
            {
                "Name": "Person",
                "Confidence": 99.87789916992188,
                "Instances": [
                    {
                        "BoundingBox": {
                            "Width": 0.1863013207912445,
                            "Height": 0.5633977651596069,
                            "Left": 0.09845088422298431,
                            "Top": 0.0
                        },
                        "Confidence": 99.87789916992188
                    },
                    {
                        "BoundingBox": {
                            "Width": 0.5331820845603943,
                            "Height": 0.9106460809707642,
                            "Left": 0.24601738154888153,
                            "Top": 0.048374518752098083
                        },
                        "Confidence": 99.6207046508789
                    },
                    {
                        "BoundingBox": {
                            "Width": 0.27723821997642517,
                            "Height": 0.7562229633331299,
                            "Left": 0.6523498892784119,
                            "Top": 0.09960231930017471
                        },
                        "Confidence": 98.69171142578125
                    }
                ],
                "Parents": []
            },
            {
                "Name": "Human",
                "Confidence": 99.87789916992188,
                "Instances": [],
                "Parents": []
            },
            {
                "Name": "Cricket",
                "Confidence": 99.80428314208984,
                "Instances": [],
                "Parents": [
                    {
                        "Name": "Sport"
                    },
                    {
                        "Name": "Person"
                    }
                ]
            },
            {
                "Name": "Sport",
                "Confidence": 99.80428314208984,
                "Instances": [],
                "Parents": [
                    {
                        "Name": "Person"
                    }
                ]
            },
            {
                "Name": "Sports",
                "Confidence": 99.80428314208984,
                "Instances": [],
                "Parents": [
                    {
                        "Name": "Person"
                    }
                ]
            },
            {
                "Name": "Helmet",
                "Confidence": 99.68204498291016,
                "Instances": [
                    {
                        "BoundingBox": {
                            "Width": 0.1154862493276596,
                            "Height": 0.2004518061876297,
                            "Left": 0.6875608563423157,
                            "Top": 0.09655309468507767
                        },
                        "Confidence": 99.68204498291016
                    },
                    {
                        "BoundingBox": {
                            "Width": 0.14193132519721985,
                            "Height": 0.14236889779567719,
                            "Left": 0.3577413260936737,
                            "Top": 0.04760546609759331
                        },
                        "Confidence": 94.60188293457031
                    }
                ],
                "Parents": [
                    {
                        "Name": "Clothing"
                    }
                ]
            },
            {
                "Name": "Clothing",
                "Confidence": 99.68204498291016,
                "Instances": [],
                "Parents": []
            },
            {
                "Name": "Apparel",
                "Confidence": 99.68204498291016,
                "Instances": [],
                "Parents": []
            },
            {
                "Name": "Field",
                "Confidence": 85.41275787353516,
                "Instances": [],
                "Parents": []
            }
        ],
        "LabelModelVersion": "2.0",
        "ResponseMetadata": {
            "RequestId": "3737d983-4586-4d29-8651-2653301af958",
            "HTTPStatusCode": 200,
            "HTTPHeaders": {
                "x-amzn-requestid": "3737d983-4586-4d29-8651-2653301af958",
                "content-type": "application/x-amz-json-1.1",
                "content-length": "1586",
                "date": "Wed, 14 Sep 2022 10:58:43 GMT"
            },
            "RetryAttempts": 0
        }
    }
}`;
        TESTresponseData = JSON.parse(TESTresponseData);

        function reset(mode) {
            document.getElementById('searchLabel').value = ' ';

            let divobj_Labelsinformation = document.getElementById('Labelsinformation');
            divobj_Labelsinformation.innerHTML = '';
            let divobj_div_imgcontainer = document.getElementById('div_imgcontainer');

            if (!mode) {
                //if not true
                divobj_div_imgcontainer.innerHTML =
                    `<img id="imgUplded" src="` + fileobjURL + `">`;
            } else {
                document.getElementById('btnUpldimage').value = '';
                divobj_div_imgcontainer.innerHTML =
                    `<img id="imgUplded" src="{{ asset('/images/batting.jpg') }}">`;
                processResponseData(TESTresponseData);

            }
            let imgobj = document.getElementById('imgUplded');

            imageWidth = imgobj.width;
            imageHeight = imgobj.height;
            imageHeight = imgobj.height;
            console.log(" img width " + imageWidth);
            console.log("img height" + imageHeight);
        }


        function uploadpicture(files) {

            const file = files.target.files[0];
            if (file.type == 'image/jpeg' || file.type == 'image/png') {
                fileobjURL = URL.createObjectURL(file);
                reset(false);
                apicall(file);
            } else {
                alert('Unsupported file!');
            }
        }

        function apicall(file) {

            var formdata = new FormData();
            formdata.append("image", file);

            var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            };

            document.getElementById("btnanalyze").style.display = "none";
            document.getElementById("btnanalyzing").style.display = "block";

            fetch(localhost + "/api/imagerecognization", requestOptions)
                .then(response => {
                    document.getElementById("btnanalyze").style.display = "flex";
                    document.getElementById("btnanalyzing").style.display = "none";
                    if (response.ok) {
                        return response.json()
                    }
                    if (response.status == 415) {
                        document.getElementById("btnanalyze").style.display = "flex";
                        document.getElementById("btnanalyzing").style.display = "none";
                        let divobj = document.getElementById('Labelsinformation');
                        divobj.innerHTML = '';
                        divobj.innerHTML =
                            `<p class="title">Results</p> <p class="errortext"> Unsupported file/image uploaded </p>`;
                        throw new Error(415);
                    }
                })
                .then(result => {
                    console.log("fetch response - " + result);
                    responseData = result;
                    processResponseData(result);
                })
                .catch(error => {
                    alert('something went wrong,try again later');

                    document.getElementById("btnanalyze").style.display = "flex";
                    document.getElementById("btnanalyzing").style.display = "none";
                    console.log('error', error)
                });
        }

        processResponseData(TESTresponseData);


        function processResponseData(response) {
            // console.log(TESTresponseData);
            Labels = response.body.Labels;
            processLabels(Labels, 1);
            // processInstances(Labels);
        }

        // data - reponse received from server
        // mode - 1=actual response   2=filter data
        function processLabels(data, mode) {
            console.log(data);
            // console.log("labels " + data.length);
            let divobj = document.getElementById('Labelsinformation');
            divobj.innerHTML = '';
            divobj.innerHTML = `<p class="title">Results</p>`;
            let temp = [];

            for (let index = 0; index < data.length; index++) {
                let instances = data[index].Instances;
                let name = data[index].Name;
                let confidence = scoreRound(data[index].Confidence) + " %";

                temp = [name, confidence];
                dataforDownload[index] = temp;

                divobj.innerHTML += `<div class="Oinfolist">
            <span>` + name + `</span> <span class="alias"> ` + confidence + ` </span > </div>`;

                // if instances found draw it
                if (instances.length > 0 && mode == 1) {
                    drawInstances(instances, name);
                }
            }
        }

        function drawInstances(instances, instanceName) {
            // return false;
            let divobj = document.getElementById('div_imgcontainer');

            // getting actula image height after customazation by HTML
            imgobj = document.getElementById('imgUplded');

            imageHeight = getImgSizeInfo(imgobj).height;;
            imageWidth = getImgSizeInfo(imgobj).width;;
            // console.log("labels " + instances.length);
            console.log("W & H " + imageWidth + " " + imageHeight);

            for (let index = 0; index < instances.length; index++) {

                // // formul found in AWS docs
                // width = imageWidth * BoundingBox.Width and height = imageHeight * BoundingBox.Height
                let height = instances[index].BoundingBox.Height * imageHeight;
                let width = instances[index].BoundingBox.Width * imageWidth;

                // // formul found in AWS docs
                // left = imageWidth * BoundingBox.Left and top = imageHeight * BoundingBox.Top
                let toplocation = Math.round(instances[index].BoundingBox.Top * imageHeight);
                let left = Math.round(instances[index].BoundingBox.Left * imageWidth);

                let instanceHTML = `<div class="imghighlight" style="top:` + toplocation + `px;left:` + left + `px;width:` +
                    width + `px;height:` +
                    height + `px">
                                <div class="innerDiv-imghighlight" text="` + instanceName + `">
                                </div>
                            </div>`;
                divobj.innerHTML += instanceHTML;
            }
        }

        function scoreRound(score) {
            return score.toString().substr(0, 4)
        } //funends

        function downloadData() {
            alert('...under development');
            return false;
            //sample data array
            // var csvFileData = [
            //     ['Alan Walker', 'Singer'],
            //     ['Cristiano Ronaldo', 'Footballer'],
            //     ['Saina Nehwal', 'Badminton Player'],
            //     ['Arijit Singh', 'Singer'],
            //     ['Terence Lewis', 'Dancer']
            // ];

            //define the heading for each row of the data
            var csv = 'Label , Confidence\n';

            //merge the data with CSV
            dataforDownload.forEach(function(row) {
                csv += row.join(' , ');
                csv += "\n";
            });

            //display the created CSV data on the web browser
            document.write(csv);

            uri = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
            const link = document.createElement("a");
            link.download = 'LabelsConfidence.csv';
            link.href = uri;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }



        function labels_filter() {
            var searchvalue = document.getElementById('searchLabel').value;
            searchvalue = searchvalue.toUpperCase();
            datavalues = Object.values(Labels);

            var name_filter = datavalues.filter(element => ((element.Name).toUpperCase()).search(searchvalue) != -1);

            if (name_filter.length == 0) {
                // temp_labels = datavalues;
                let divobj = document.getElementById('Labelsinformation');
                divobj.innerHTML =
                    `<p class="title">Results</p> <p class="errortext"> No results found</p>`;
            } else {
                temp_labels = name_filter;
                processLabels(temp_labels, 2);

            }

        }

        function getRenderedSize(contains, cWidth, cHeight, width, height, pos) {
            var oRatio = width / height,
                cRatio = cWidth / cHeight;
            return function() {
                if (contains ? (oRatio > cRatio) : (oRatio < cRatio)) {
                    this.width = cWidth;
                    this.height = cWidth / oRatio;
                } else {
                    this.width = cHeight * oRatio;
                    this.height = cHeight;
                }
                this.left = (cWidth - this.width) * (pos / 100);
                this.right = this.width + this.left;
                return this;
            }.call({});
        }

        function getImgSizeInfo(img) {
            var pos = window.getComputedStyle(img).getPropertyValue('object-position').split(' ');
            return getRenderedSize(true,
                img.width,
                img.height,
                img.naturalWidth,
                img.naturalHeight,
                parseInt(pos[0]));
        }
    </script>
@endpush



@push('header')
    <h1>Object Recognition</h1>
@endpush


@push('aside')
    <a href="{{ url('/texttospeech') }}">Text To Speech</a>
    <a href="{{ url('/speechtotext') }}">Speech To Text</a>
    <a href="{{ url('/textextract') }}">Text Extract</a>
    <a href="{{ url('/objectrecognisation') }}" class="selected">Object Recognition</a>
    <a href="{{ url('/comprehend') }}">Comprehend</a>
@endpush



@push('artical')
    <!-- object recognixation container -->
    <div class="orcontainer">
        <div class="imagediv">
            <div class="titlediv">
                <p class="title">Document Name</p>

            </div>
            <div class="divimgcontainer">
                {{-- <picture> --}}
                <div id="div_imgcontainer" class="imgcontainer">
                    <img id="imgUplded" src="{{ asset('/images/batting.jpg') }}">
                    {{-- <div class="imghighlight" style="top:100px;right:100px;width:100px;height:100px">
                        <div class="innerDiv-imghighlight" text="popups">
                        </div>
                    </div> --}}
                </div>
                {{-- </picture> --}}
            </div>

            <div class="btnupldDiv">

                <input type="file" id="btnUpldimage" onchange="uploadpicture(event)" hidden />
                <!--our custom file upload button-->
                <label id="btnanalyze" for="btnUpldimage" class="btn labelbtnUpld">Upload Document</label>
                <!-- </div> -->
                <button id="btnanalyzing" type="button" class="labelbtnUpld btn">
                    Analyzing <i id="converting" class="fa fa-spinner fa-spin"></i>
                </button>

            </div>
        </div>

        <hr class="hrSeperator">

        <div class="informationDiv">
            <div class="tools">
                <div class="iconinputbox">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                    <input id="searchLabel" class="nooutline lblsearch" type="text" placeholder="Search for a Label..."
                        onkeyup="labels_filter()">
                </div>
                <p id="notetext">Check whether we support your label</p>
            </div>
            <div id="Labelsinformation" class="objectinformation">
                <p class="title">Results</p>
                <p>No results found</p>
            </div>
        </div>
    </div>
@endpush

@push('footer')
    <div class="footerDiv">
        <button id="btnDownloadobjets" class="btn download" onclick="downloadData()">
            Download
            <svg id="file_download_black_24dp_2_" data-name="file_download_black_24dp (2)"
                xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 24">
                <path id="Path_34" data-name="Path 34" d="M0,0H24V24H0Z" fill="none" />
                <path id="Path_35" data-name="Path 35" d="M19,9H15V3H9V9H5l7,7ZM5,18v2H19V18Z" fill="#0091ff" />
            </svg>
        </button>
        <button class="btn reset" onclick="reset(true)">
            RESET DEMO
        </button>
    </div>
@endpush


<style>
    .title {
        color: #0091FF;
        font-size: 13px !important;
        font-weight: bold !important;
    }

    .titlediv {
        grid: 1/4;
        height: 100%;
        width: 100%;
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
        margin: 10px 0;
    }

    .imagediv {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 1fr;
        grid-template-rows: 30px 420px 50px;
        row-gap: 5px;
        margin: 10px;
        align-items: center;
        width: 430px;
        justify-items: center;
    }

    .imagediv p {
        grid-column: 1/4;
        /* margin: 5px 0 10px 15px; */
        margin: 10px 0 0 10px;
        /* height: 5px; */
    }

    .divimgcontainer {
        display: flex;
        align-items: center;
        grid-column: 1/4;
        border: 1px solid #DDDDDD;
        border-radius: 8px;
        height: 400px;
        /* width: 400px; */
    }


    .imgcontainer {
        /* width: 450px; */
        position: relative;
    }

    img {
        height: 100%;
        width: 390px;
        max-height: 400px;
        object-fit: contain;
        object-position: 25% 0%;
    }

    .imghighlight {
        position: absolute;
        /* bottom: attr(data-bottom);
        right: attr(data-right);
        width: attr(data-width);
        height: attr(data-height);*/
        color: white;
        border: 2px solid #0091FF;
        border-radius: 12px;
    }

    .innerDiv-imghighlight {
        position: relative;
        width: inherit;
        height: inherit;
    }

    .innerDiv-imghighlight:hover:after {
        content: attr(text);
        position: absolute;
        left: 20%;
        top: -35px;
        /* min-width: 100px; */
        background-color: #000000;
        color: white;
        border-radius: 10px;
        padding: 5px;
        z-index: 1;
        font-size: 10px !important;
    }




    .labelbtnUpld {
        width: 150px !important;
        height: 32px !important;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 100 !important;
        text-transform: capitalize !important;
        font-weight: 400 !important;
        padding: 5px;
        box-sizing: border-box;
        text-transform: capitalize !important;
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

    .btnupldDiv {
        grid: 1/4;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-right: 15px;
        box-sizing: border-box;
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
        grid-template-rows: 50px 435px;
        row-gap: 30px;
        margin: 10px;
        width: 430px;
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
        font-size: 10px;
        text-align: center;
        font-weight: 400;
    }

    .lblsearch {
        grid-column: 1/2;
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        color: #000000;
        width: 320px;
        border: none;
    }


    lblsearch::placeholder {
        font-weight: bold;
    }

    .objectinformation {
        margin-left: 10px;
        overflow-y: scroll;
    }

    .objectinformation .Oinfolist {
        margin: 20px 0 10px 0;
        font-weight: 600;
        border-bottom: 1px solid #EEEEEE;
        display: flex;
        justify-content: space-between;
        padding: 5px 0 5px 0;
        /* transition: opacity 10s ease-in-out; */
    }

    .Oinfolist:last-child {
        border: 0 !important;
    }


    /* to hide scrollbar */
    .objectinformation::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }

    .errortext {
        text-align: center
    }

    .download {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #btnDownloadobjets {
        display: none;
    }
</style>
