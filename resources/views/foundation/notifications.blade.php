@if(isset($alert) && $alert['type'] == 'success')
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $alert['message'] }}
    </div>
@endif

@if(isset($alert) && $alert['type'] == 'info')
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $alert['message'] }}
    </div>
@endif

@if(isset($alert) && $alert['type'] == 'warning')
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $alert['message'] }}
    </div>
@endif

@if(isset($alert) && $alert['type'] == 'danger')
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $alert['message'] }}
    </div>
@endif
