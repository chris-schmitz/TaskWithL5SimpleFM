@extends('foundation.base')

@section('content')
    <div class='panel panel-primary' id='content-panel'>
        <div class='panel-heading'>
            <h1>Tasks</h1>
        </div>
        @if(!isset($rows))
            <div class='panel-body'>
                <p>No tasks</p>
            </div>
        @else
            <table class="table table-striped table-hover">
                <tr>
                    <form action="{{ route('tasks.index') }}" method="GET">
                        <input type='hidden' name='incompleteonly' value="{{ $incompleteOnly == true ? 'true' : ''}}">
                        <input type='hidden' name='sortdirection' value='{{ ($currentSort["direction"] == "ascend") ? "descend" : "ascend" }}'>
                        <th>
                            Title
                            <button  type='submit' name='sortfield' value='title' class='fa fa-sort'></button>
                        </th>
                        <th class='short-column'>
                            Created On
                            <button type='submit' name='sortfield' value='created_on' class='fa fa-sort'></button>
                        </th>
                        <th class='short-column'>
                            Complete
                            <button type='submit' name='sortfield' value='complete' class='fa fa-sort'></button>
                        </th>
                    </form>
                </tr>
                @foreach($rows as $row)
                    <tr onclick="onRowClick({{ $row['recid'] }})">
                        <td>
                            {{ $row['title'] }}
                        </td>
                        <td>
                            {{ $row['created_on'] }}
                        </td>
                        <td>
                            {{ $row['complete'] }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
        <div class='panel-footer'>
            <form action='{{ route("tasks.index")}}' class='pull-left' method='GET'>
                <div class='btn-group'>
                    <input type='hidden' name='sortfield' value='{{ $currentSort["field"] or "created_on"}}'>
                    <input type='hidden' name='sortdirection' value='{{ ($currentSort["direction"] == "ascend") ? "descend" : "ascend" }}'>
                    <button class='btn {{ $incompleteOnly == true ? 'btn-primary' : ''}}' name='incompleteonly' value='true'>Incomplete Only</button>
                    <button class='btn {{ $incompleteOnly == false ? 'btn-primary' : ''}}'>Show All</button>
                </div>
            </form>
            <div class='clearfix'</div>
            <form action="{{ route('tasks.create') }}" method="GET">
                <button class='btn btn-success action-button pull-right'>New Task</button>
            </form>
        </div>
    </div>
@stop

@section('pageSpecificJavascript')
function onRowClick(recid){
    var url = '/tasks/' + recid + '/edit';
    window.document.location=url;
}
@stop
