<?php ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">

  <title>API Collections</title>

  <!-- Fonts -->

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Styles -->
  <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->
  <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

  @stack('style')

  <!-- <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style> -->
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
            <!-- <p>{{count($categories_resources)}}</p> -->
            <p>200</p>
            <p>Resources</p>
          </div>
        </div>
        <div class="search-input">
          <p>Search for an API</p>
          <form method="get" action="/" auto-focus>
            <input id="searchresourcesipt" type="text" name="search" placeholder="Enter an API" autofocus />
          </form>
        </div>
      </header>
      <div class="content">
        @if(count($categories_resources))
        <p>Configurations helps change a group of system settings across your computers in one-click. Click on one of the settings below to get started.</p>
        <div class="groups">
          <?php
          foreach ($categories_resources as $categorie) {
          ?>
            @if(count($categorie->resources))
            <div class="group" style="border-left: solid 5px {{$categorie->color}}">
              <h5 class="group-heading">{{$categorie->name}}</h5>
              <div class="group-items">
                <?php
                foreach ($categorie->resources as $resource) {
                ?>
                  <a href="{{$resource->route?$resource->route:''}}">{{$resource->name}}

                  </a>
                <?php
                }
                ?>
              </div>
            </div>
            @endif
          <?php
          }
          ?>
        </div>
        @else
        <p id="notFound">No API's Found</p>
        @endif
      </div>

      <div class="content2" style="display: none">
        <p class="content2Divtitle">Configurations helps change a group of system settings across your computers in one-click. Click on one of the settings below to get started.</p>
        <div class="groups">
          <div class="group">
            <h5 class="group-heading">SYSTEM AND SECURITY</h5>
            <div class="group-items">
              <a href="">Firewall</a>
              <a href="">Registry</a>
              <a href="">Services</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">Artificial Intelligence</h5>
            <div class="group-items">
              <a href="/textextract">Image to text</a>
              <a href="/speechtotext">Speech to text</a>
              <a href="/texttospeech">Text to speech</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">NETWORK AND INTERNET</h5>
            <div class="group-items">
              <a href="">WiFi and Bluetooth Radio</a>
              <a href="">WiFi Profiles</a>
              <a href="">IP Printer</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">APPEARANCE AND PERSONALIZATION</h5>
            <div class="group-items">
              <a href="">Display</a>
              <a href="">Fonts</a>
              <a href="">Theme</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">USER ACCOUNTS</h5>
            <div class="group-items">
              <a href="">User Management</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">HARDWARE</h5>
            <div class="group-items">
              <a href="">Power Managemnt</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">OTHERS</h5>
            <div class="group-items">
              <a href="">Scheduler</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">CLOCK AND REGION</h5>
            <div class="group-items">
              <a href="">Date/Time</a>
              <a href="">Region</a>
            </div>
          </div>
          <div class="group">
            <h5 class="group-heading">EASE OF ACCESS</h5>
            <div class="group-items">
              <a href="">Activate Windows Kiosk Mode</a>
              <a href="">Shortcut</a>
            </div>
          </div>


        </div>
    </article>
    @if(isset($modal))
    @include('modals/'.$modal)
    @endif
  </div>

  @stack('scripts')
  <script>
    var select = document.getElementById('searchresourcesipt');
    select.onkeyup = function() {
      this.form.submit();
    };
  </script>
</body>


</html>