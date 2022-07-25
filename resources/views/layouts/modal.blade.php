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
    top: 5%;
    left: 20%;
    /* font-size: 18px; */
    background: #FFFFFF 0% 0% no-repeat padding-box;
    /* background-color: rgb(255, 255, 255); */
    border-radius: 24px;
    box-shadow: 0px 4px 20px #00000029;
    height: 40%;
    width: 60%;
    display: grid;
    grid-template-columns: auto auto;
    grid-template-rows: 10% 75% 15%;
    font-family: "Open Sans", sans-serif;
  }

  .modal header {
    grid-column: 2 / 3;
    height: 100%;
    border-bottom: #EEEEEE solid 1px;
    padding: 10px;
    box-sizing: border-box;
    justify-content: space-around;

  }

  .modal aside {
    border: none;
    grid-row: 1/ 4;
    height: 100%;
    width: 100%;
    border-right: #EEEEEE solid 1px;
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
    display: flex;
  }

  .modal footer {
    grid-column: -2/ -1;
    height: 100%;
    border-top: #EEEEEE solid 1px;
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

  .modal header h1 {
    font-size: 18px;
    color: #0091FF;
    height: auto;
    font-weight: 700;

  }

  .modal aside h4 {
    font-size: 13px;
    font-weight: 600;
  }

  .modal aside .selected {
    color: #0091FF;
    text-transform: capitalize;
    font-size: 13px;
    font-weight: 700;
  }
</style>