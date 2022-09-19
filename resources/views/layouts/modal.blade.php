<script>
    var localhost = "{{ env('APP_URL') }}";
</script>

@push('style')
    <!-- <script>
        -- >
        @stack('style')
            <
            !--
    </script> -->
@endpush


@push('scripts')
    <!-- <script>
        -- >
        @stack('script')
            <
            !--
    </script> -->
@endpush


<div class="modal" id="model">
    <header>
        <h1>
            @stack('header')
        </h1>
    </header>
    <aside>
        @stack('aside')
        <!-- <a href="{{ url('/speechtotext') }}">Speech To Text</a>
    <a href="{{ url('/texttospeech') }}">Text To Speech</a>
    <a href="{{ url('/textextract') }}">Text Extract</a>
    <a href="{{ url('/comprehend') }}">Comprehend Demonstration</a>
    <a href="{{ url('/objectrecognisation') }}">Object Recognition</a> -->
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
    .overlay {
        display: block !important;
    }

    .modal-close {
        cursor: pointer;
    }


    .modal {
        position: absolute;
        /* top: 1%;
    left: 8%; */
        /* left: 50%; */
        /* top: 50%; */
        /* transform: translate(-50%, -50%); */
        float: left;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        opacity: 1 !important;
        /* background: o; */
        font-size: 13px;
        /* background: #FFFFFF 0% 0% no-repeat padding-box; */
        background-color: #FFFFFF;
        border-radius: 24px;
        box-shadow: 0px 4px 20px #00000029;
        /* height: 40%;
    width: 60%; */
        /* width: 800px; */
        /* height: 640px; */
        /* //provided */

        width: 1080px;
        height: 640px;
        display: grid;
        grid-template-columns: 20% 80%;
        grid-template-rows: 8% 82% 10%;
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
        border-right: #EEEEEE solid 1px;
        padding: 10px;
        box-sizing: border-box;
        font-weight: 700;
        display: flex;
        overflow: auto;
        font-size: 13px;
        padding: 25px;
        align-content: stretch;
        flex-direction: column;
        gap: 30px;
        height: auto;
    }

    .modal article {
        /* padding: 10px; */
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
        right: 3%;
        top: 3%;
        color: gray;
        font-size: 16px;
        text-decoration: none;
    }

    .modal header h1 {
        font-size: 18px;
        color: #0091FF;
        height: auto;
        font-weight: 700;
        margin: 10px;
    }

    .modal .btn {
        background-color: transparent;
        color: #0091FF;
        box-shadow: 0px 3px 6px #00000029;
        border: 1px solid #0091FF;
        border-radius: 24px;
        opacity: 1;
        width: 208px;
        height: 36px;
        padding: 5px 10px 5px px 10px;
        font-size: 13px;
        font-family: "Open Sans", sans-serif;
        font-weight: bold;
        cursor: pointer;
    }

    .modal aside a {
        font-size: 13px;
        font-weight: 700;
        color: #888888;
        text-decoration: none;
    }

    .modal aside .selected {
        color: #0091FF;
        text-transform: capitalize;
        font-size: 13px;
        font-weight: 700;
    }

    SELECT {
        background: url("data:image/svg+xml,<svg height='10px' width='10px' viewBox='0 0 16 16' fill='%23000000' xmlns='http://www.w3.org/2000/svg'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>") no-repeat;
        background-position: calc(100% - 0.75rem) center !important;
        -moz-appearance: none !important;
        -webkit-appearance: none !important;
        appearance: none !important;
        padding-right: 2rem !important;
        color: #888888;
    }
</style>
