@extends('layouts.modal')

@push('header')
<h1>Text To Speech</h1>
@endpush


@push('aside')
@if($modal == 'texttospeech')
<h4 class="selected">Text To Speech</h4>
@endif
<h4>API service 1</h4>
<h4>API service 2</h4>
<h4>API service 3</h4>
<h4>API service 4</h4>
<h4>API service 5</h4>
@endpush



@push('artical')
<input type="text" name="Hello">
@endpush
@push('footer')
footer text
@endpush



<style>
  .modal header h1 {
    font-size: 18px;
    font-weight: 800;
    color: #0091FF;
  }

  .modal aside h4 {
    font-size: 16px;
    font-weight: 600;
  }

  .modal aside .selected {
    color: #0091FF;
    text-transform: capitalize;

  }
</style>