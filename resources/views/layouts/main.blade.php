<?php ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>API Collections</title>

  <!-- Fonts -->

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700&family=Open+Sans:wght@300;800&family=Oswald:wght@600&display=swap" rel="stylesheet" />
  <!-- Styles -->
  <link rel="stylesheet" href="/assets/css/style.css">



  <!-- <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style> -->
</head>

<body>
  <div class="container">
    <header class="main-header">
      <h1><b>Aloha</b>Technology</h1>
    </header>

    <div class="tools">
      <div>
        <span class="material-symbols-outlined"> filter_list </span>

        <span class="material-symbols-outlined"> sort </span>
      </div>
    </div>

    <aside>
      <nav>
        <h3>API SEARCH</h3>
      </nav>
    </aside>

    <article>
      <header>
        <div class="headings">
          <span class="exlore-main"> EXPLORE </span>
          <h4>
            <p>1000</p>
            <p>API</p>
          </h4>
          <h4>
            <p>24</p>
            <p>Platforms</p>
          </h4>
          <h4>
            <p>200</p>
            <p>Resources</p>
          </h4>
        </div>
        <div class="search-input">
          <p>Search for an API</p>
          <form method="get" action="/search" auto-focus>
            <input type="text" name="search" placeholder="Search an API" autofocus />
          </form>
        </div>
      </header>
      <div class="content">
        @yield('content')
      </div>
    </article>
  </div>
</body>

</html>