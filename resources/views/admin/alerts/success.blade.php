@if(Session::has('success'))
    <div class="row mr-2 ml-2" id="succes_msg">
            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                    id="type-error">{{Session::get('success')}}
            </button>
    </div>
@endif
