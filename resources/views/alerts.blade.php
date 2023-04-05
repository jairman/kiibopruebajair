@if (Session::get('mensaje'))
    <div class="alert alert-{{ Session::get('class') }} alert-fill alert-close alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! Session::get('mensaje') !!}
    </div>
@endif
