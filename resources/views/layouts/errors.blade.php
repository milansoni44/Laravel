@if (isset($failure)&&count($failure) > 0)
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach ($failure->all() as $failures)
            <li><strong>{!! $failures !!}</strong></li>
        @endforeach
    </div>
@endif