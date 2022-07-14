@extends('layouts.main')
@section('content')
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
<div class="groups">
  <?php
  foreach ($categories_resources as $categorie) {
    if (count($categorie->resources)) {
  ?>
      <div class="group" style="border-left: solid 5px #{{$categorie->color}}">
        <h5 class="group-heading">{{$categorie->name}}</h5>
        <div class="group-items">
          <?php
          foreach ($categorie->resources as $resource) {
          ?>
            <a href="">{{$resource->name}}
              <p>{{$resource->desc}}</p>
            </a>

          <?php } ?>
        </div>
      </div>
  <?php }
  } ?>
</div>
</div>
@endsection