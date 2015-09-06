<?php

Route::resource('tasks', 'TasksController');
Route::post('tasks/{recid}/togglestatus', 'TasksController@toggleStatus');
