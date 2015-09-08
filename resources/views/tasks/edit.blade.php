@extends('foundation.base')

@section('content')
    <form action="{{ route('tasks.update', ['recid' => $record['recid']]) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class='panel panel-primary' id='content-panel'>
            <div class='panel-heading'>
                <h1>Edit Task</h1>
            </div>
            <div class='panel-body'>
                @include('tasks.partials.fields')
            </div>
            <div class='panel-footer'>
                <button type='submit' value='delete' class='btn btn-danger action-button pull-left'>Delete</button>
                <button type='submit' value='save' class='btn btn-success action-button pull-right'>Save</button>
                <div class='clearfix'</div>
            </div>
        </div>
    </form>
@stop
