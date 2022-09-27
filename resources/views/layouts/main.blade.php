<?php ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">

    <title>API Collections</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('\images\icon-laravel.png') }}">

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.16.0/codemirror.css' rel='stylesheet'>
    @stack('style')

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

</head>

<body>
    <div class="overlay"> </div>
    <div class="container">
        <header class="main-header">
            <h1><b>Aloha</b>Technology</h1>
        </header>

        <div class="tools">
            <span class="material-symbols-outlined">
                search
            </span>
            <span class="material-symbols-outlined"> sort </span>

            <span class="material-symbols-outlined">filter_list </span>
        </div>

        <aside>
            <nav>
                <span class="material-symbols-outlined">
                    menu
                </span>
                <h3>API SEARCH</h3>
            </nav>
        </aside>

        <article>
            <header>
                <div class="headings">
                    <p class="exlore-main"> EXPLORE </p>
                    <div>
                        <p>160</p>
                        <p>API</p>
                    </div>
                    <div>
                        <p>24</p>
                        <p>Platforms</p>
                    </div>
                    <div>
                        <p>200</p>
                        <p>Resources</p>
                    </div>
                </div>
                <div class="search-input">
                    <p>Search for an API</p>
                    {{-- <form method="get" action="/" auto-focus> --}}
                    <input id="searchresourcesipt" type="text" name="search" placeholder="Enter an API" autofocus
                        onkeyup="category_filter()" />
                    {{-- </form> --}}
                </div>
            </header>


            <div class="content2">
                <p class="content2Divtitle">Configurations helps change a group of system settings across your computers
                    in one-click. Click on one of the settings below to get started.</p>
                <div id="div-categories" class="groups">

                </div>
            </div>
        </article>
        @if (isset($modal))
            @include('modals/' . $modal)
        @endif
    </div>

    @stack('scripts')
    <script>
        var select = document.getElementById('searchresourcesipt');
        select.submit = function() {
            this.form.submit();
        };


        categoryData = `[
 {
  "id": "1",
  "name": "Text Extract",
  "color": "#B7D2E7",
  "status": "1",
  "resources": [{
    "id": "2",
    "name": "text extraction from image",
    "status": "1",
    "route": "textextract"
  }]
},
 {
  "id": "2",
  "name": "SPEECH TO TEXT",
  "color": "#12d595",
  "status": "1",
  "resources": [{
    "id": "2",
    "name": "Speech to text",
    "status": "1",
    "route": "speechtotext"
  }]
},
{
  "id": "2",
  "name": "IMAGE RECOGNITION",
  "color": "#1150FF",
  "status": "1",
  "resources": [{
    "id": "2",
    "name": "Object Recognition from Image",
    "status": "1",
    "route": "objectrecognisation"
  }]
},
{
  "id": "2",
  "name": "TEXT TO SPEECH",
  "color": "#EE675C",
  "status": "1",
  "resources": [{
    "id": "2",
    "name": "Text To speech",
    "status": "1",
    "route": "texttospeech"
  }]
},
{
  "id": "2",
  "name": "COMPREHEND",
  "color": "#c6c6c6",
  "status": "1",
  "resources":[{
    "id": "2",
    "name": "Comprehend",
    "status": "1",
    "route": "comprehend"
  }]
}
]`;

        StoredCategoryData = JSON.parse(categoryData);
        loadCategories(StoredCategoryData);

        function loadCategories(categoryData) {
            let groupsElement = document.getElementById('div-categories');
            groupsElement.innerHTML = '';
            let HTMLcode = '';
            for (let index = 0; index < categoryData.length; index++) {
                name = categoryData[index].name;
                color = categoryData[index].color;
                resources = categoryData[index].resources;
                // console.log("re " + resources.length);
                if (resources.length > 0) {

                    HTMLcode += `<div class="group" style="border-left: solid 5px ` + color + `">
                        <h5 class="group-heading" >` + name + `</h5>`;

                    for (let index = 0; index < resources.length; index++) {
                        name = resources[index].name;
                        path = resources[index].route;
                        HTMLcode += `<div class="group-items" >
                            <a href="{{ url('`+path+`') }}">` + name + `</a>
                        </div>`;
                    }

                    HTMLcode += `</div>`;
                }
            }
            // console.log(HTMLcode);
            groupsElement.innerHTML = HTMLcode;
        }

        // checking JSON data if searchvalue in there
        function category_filter() {

            var searchvalue = document.getElementById('searchresourcesipt').value;
            searchvalue = searchvalue.toUpperCase();
            categoryData = StoredCategoryData;
            document.getElementById('div-categories').innerHTML = '';

            let flag = false;
            for (let categoryindex = 0; categoryindex < categoryData.length; categoryindex++) {
                categoryname = categoryData[categoryindex].name.toUpperCase();
                resources = categoryData[categoryindex].resources;
                if (resources.length > 0) {


                    for (let index = 0; index < resources.length; index++) {
                        resourcename = resources[index].name.toUpperCase();
                        if (resourcename.includes(searchvalue) || categoryname.includes(searchvalue)) {
                            // console.log(searchvalue);
                            // console.log(categoryData[categoryindex]);
                            // loadCategories(categoryData[categoryindex]);
                            addCategory(categoryData[categoryindex]);
                            flag = true;

                        }
                    }
                }
            }
            if (flag == false) {
                //no record msg
                document.getElementById('div-categories').innerHTML = `<p id="notFound">No results found</p>`;
            }
        }

        // if category or resource text matching , add them to UI
        function addCategory(category) {
            name = category.name;
            color = category.color;
            resources = category.resources;

            HTMLcode = `<div class="group" style="border-left: solid 5px ` + color + `">
                        <h5 class="group-heading" >` + name + `</h5>`;

            for (let index = 0; index < resources.length; index++) {
                name = resources[index].name;
                path = resources[index].route;
                HTMLcode += `<div class="group-items" >
                            <a href="{{ url('`+path+`') }}">` + name + `</a>
                        </div>`;
            }

            HTMLcode += `</div>`;
            document.getElementById('div-categories').innerHTML += HTMLcode;
        }
    </script>
</body>


</html>
