@push('scripts')
<script>

</script>
@endpush


<div class="modal" id="model">
  <header>
    @stack('header')
  </header>
  <aside>
    @stack('aside')
  </aside>
  <article>
    @stack('artical')
  </article>
  <footer>
    @stack('footer')
  </footer>
  <!-- <div class="modal-close" onclick="{{ URL::previous() }}">✖</div> -->
  <a class="modal-close" href="/">✖</a>
</div>

<style>
  .modal-close {
    cursor: pointer;
  }

  .modal {
    position: absolute;
    top: 10%;
    left: 15%;
    font-size: 18px;
    background-color: rgb(255, 255, 255);
    border-radius: 24px;
    box-shadow: 0px 4px 20px #00000029;
    height: 40%;
    width: 70%;
    display: grid;
    grid-template-columns: 20% 80%;
    grid-template-rows: 10% 80% 10%;
    font-family: "Open Sans", sans-serif;
  }

  .modal header {
    grid-column: 2 / 3;
    height: 100%;
    border-bottom: gray solid 1px;
    padding: 10px;
    box-sizing: border-box;
    font-weight: 700;
    font-size: large;
  }

  .modal aside {
    border: none;
    grid-row: 1/ 4;
    height: 100%;
    width: 100%;
    border-right: gray solid 1px;
    padding: 10px;
    box-sizing: border-box;
    font-weight: 700;
    display: grid;
    overflow: auto;
    font-size: small;
    padding: 25px;
    justify-items: center;
  }

  .modal article {
    padding: 10px;
    box-sizing: border-box;
    font-weight: 300;
  }

  .modal footer {
    grid-column: -2/ -1;
    height: 100%;
    border-top: gray solid 1px;
    padding: 10px;
    box-sizing: border-box;
  }

  .modal-close {
    position: absolute;
    right: 2%;
    top: 2%;
    color: gray;
    font-size: 14px;
    text-decoration: none;
  }
</style>