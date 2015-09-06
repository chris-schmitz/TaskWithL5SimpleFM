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
                             <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="complete-checkbox" data-recid="{{ $row['recid'] }}">
                                </label>
                            </div>
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
        var checkbox = $(event.currentTarget);
        var complete = checkbox.is(':checked');
        var recid = checkbox.data('recid');
        var data = {recid: recid, iscomplete: complete };

        $.post(
            'tasks/' + recid + '/togglestatus',
            data,
            function (data){
            debugger;
            }
        )
        .fail(function (request, textStatus, errorThrown){
            if (complete == true){
                checkbox.prop('checked', false);
            } else {
                checkbox.prop('checked', true);
            }

            showFailureMessage('The task could not be marked complete due to the error: ' + errorThrown);
        });
    });

    function showFailureMessage(message){
        var string = '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + message + '</div>';
        var html = $.parseHTML(string);
        $('#content-panel').before(html);
    }
@stop
