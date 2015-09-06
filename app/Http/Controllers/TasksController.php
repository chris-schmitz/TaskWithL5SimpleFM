<?php

namespace L5Tasks\Http\Controllers;

use Illuminate\Http\Request;
use L5Tasks\FileMakerModels\Task;
use L5Tasks\Http\Controllers\Controller;

class TasksController extends Controller
{
    protected $task;

    protected $request;

    public function __construct(Task $task, Request $request)
    {
        $this->task = $task;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $incompleteOnly = !!$this->request->input('incompleteonly');
            if (!$incompleteOnly) {
                $result = $this->task->findAll()->executeCommand();
            } else {
                $result = $this->task->findAllIncomplete()->executeCommand();
            }
            $rows = $result->getRows();
        } catch (RecordsNotFoundException $e) {
            $rows = [];
        }
        // $alert = ['type' => 'success', 'message' => 'Success worked'];
        return view('tasks.home')->with(compact('rows', 'incompleteOnly'));
    }

    public function toggleStatus($recid)
    {
        $iscomplete = $this->request->input('iscomplete');
        dd($recid, $iscomplete, $status);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
