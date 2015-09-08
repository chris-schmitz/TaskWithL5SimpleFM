@if(session('alert') && session('alert')['type'] == 'success')
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('alert')['message'] }}
    </div>
@endif

@if(session('alert') && session('alert')['type'] == 'info')
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('alert')['message'] }}
    </div>
@endif

@if(session('alert') && session('alert')['type'] == 'warning')
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('alert')['message'] }}
    </div>
@endif

@if(
    (session('alert') && session('alert')['type'] == 'danger') ||
    count ($errors) > 0
)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        {{ session('alert') ? session('alert')['message'] : '' }}

        @if(count($errors) > 0)
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
