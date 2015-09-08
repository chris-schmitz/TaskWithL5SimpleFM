@extends('foundation.base')

@section('content')
        <form action="{{ route('tasks.store') }}" method="POST">
    <div class='panel panel-primary' id='content-panel'>
        <div class='panel-heading'>
            <h1>New Task</h1>
        </div>
        <div class='panel-body'>
            @include('tasks.partials.fields')
        </div>
        <div class='panel-footer'>
            <button type='submit' value='save' class='btn btn-success action-button pull-right'>Save</button>
            <div class='clearfix'</div>
        </div>
    </div>
        </form>
@stop
