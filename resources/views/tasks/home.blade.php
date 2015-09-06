@extends('foundation.base')

@section('content')
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <h1>Tasks</h1>
        </div>
        @if(!isset($rows))
            <div class='panel-body'>
                <p>No tasks</p>
            </div>
        @else
            <table class="table">
                <tr>
                    <th class='complete-column'>Complete</th>
                    <th>Title</th>
                    <th class='button-column'>Edit</th>
                    <th class='button-column'>Delete</th>
                </tr>
                @foreach($rows as $row)
                    <tr>
                        <td>
                            <form action="tasks/{{ $row['recid'] }}/togglestatus" method="POST">
                                 <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="complete-checkbox" name="complete">
                                    </label>
                                </div>
                            </form>
                        </td>
                        <td>{{ $row['title'] }}</td>
                        <td><button class='btn btn-primary action-button'>Edit</button></td>
                        <td><button class='btn btn-danger action-button'>Delete</button></td>
                    </tr>
                @endforeach
            </table>
        @endif
        <div class='panel-footer'>
            <form action='tasks' class='pull-left' method='GET'>
                <div class='btn-group'>
                    <button class='btn {{ $incompleteOnly == true ? 'btn-primary' : ''}}' name='incompleteonly' value='true'>Incomplete Only</button>
                    <button class='btn {{ $incompleteOnly == false ? 'btn-primary' : ''}}'>Show All</button>
                </div>
            </form>
            <div class='clearfix'</div>
            <button class='btn btn-success action-button pull-right'>New Task</button>
        </div>
    </div>
@stop

@section('pageSpecificJavascript')
    $('.table').on('click', '.complete-checkbox', function (event){
        debugger;
        var form = event.currentTarget.closest('form');
        $(form).submit();
    });
@stop
