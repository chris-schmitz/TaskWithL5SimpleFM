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
                    <th>
                        Title
                        <button  class='fa fa-sort'></button>
                    </th>
                    <th class='short-column'>
                        Created On
                        <button  class='fa fa-sort'></button>
                    </th>
                    <th class='short-column'>
                        Complete
                        <button class='fa fa-sort'></button>
                    </th>
                </tr>
                @foreach($rows as $row)
                    <tr onclick="onRowClick({{ $row['recid'] }})">
                        <td>
                            {{ $row['title'] }}
                        </td>
                        <td>
                            10/21/2015
                        </td>
                        <td>
                            true
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
        <div class='panel-footer'>
            <form action='{{ route("tasks.index")}}' class='pull-left' method='GET'>
                <div class='btn-group'>
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
    debugger;
    var url = '/tasks/' + recid + '/edit';
    window.document.location=url;
}
@stop
