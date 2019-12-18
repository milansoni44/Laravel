@if (session()->has('custom_flash'))
    @if (isset(session()->get('custom_flash')['success']))
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>
            {!! session()->get('custom_flash')['success'] !!}
        </strong>
    </div>
    @endif

    @if (isset(session()->get('custom_flash')['errors'])&&count(session()->get('custom_flash')['errors']) > 0)
        <div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @foreach (session()->get('custom_flash')['errors'] as $failures)
                <li><strong>{!! $failures !!}</strong></li>
            @endforeach
        </div>
    @endif
@endif