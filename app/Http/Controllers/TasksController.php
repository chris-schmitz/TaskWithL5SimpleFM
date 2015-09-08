<?php

namespace L5Tasks\Http\Controllers;

use Illuminate\Http\Request;
use L5SimpleFM\Exceptions\GeneralException;
use L5Tasks\FileMakerModels\Task;
use L5Tasks\Http\Controllers\Controller;

class TasksController extends Controller
{
    protected $task;

    protected $request;

    protected $validators = [
        'title' => 'required',
    ];

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
        return view('tasks.home')->with(compact('rows', 'incompleteOnly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->validate($this->request, $this->validators);

        $data = $this->request->except('_method', '_token');

        try {
            $result = $this->task->createRecord($data)->executeCommand();

            $alert = [
                'type' => 'success',
                'message' => 'Task ' . $data['title'] . ' added.',
            ];
            $this->request->session()->flash('alert', $alert);
            return redirect()->route('tasks.index');
        } catch (GeneralException $e) {
            $alert = [
                'type' => 'danger',
                'message' => $e->getMessage(),
            ];
            $this->request->session()->flash('alert', $alert);
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $recid
     * @return Response
     */
    public function edit($recid)
    {
        try {
            $result = $this->task->findByRecId($recid)->executeCommand();
            $record = $result->getRows()[0];
        } catch (GeneralException $e) {
            abort(404);
        }
        return view('tasks/edit')->with(compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $recid
     * @return Response
     */
    public function update($recid)
    {
        if ($this->request->input('delete') == 'true') {
            return $this->destroy($recid);
        }

        $this->validate($this->request, $this->validators);
        $data = $this->request->except('_method', '_token');

        try {
            $result = $this->task->updateRecord($recid, $data)->executeCommand();
            $alert = [
                'type' => 'success',
                'message' => sprintf("Task %s updated.", $data['title']),
            ];
            $this->request->session()->flash('alert', $alert);
            return redirect()->route('tasks.index');
        } catch (GeneralException $e) {
            $alert = [
                'type' => 'danger',
                'message' => $e->getMessage(),
            ];
            $this->request->session()->flash('alert', $alert);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $recid
     * @return Response
     */
    public function destroy($recid)
    {
        try {
            $this->task->deleteRecord($recid)->executeCommand();
            $alert = [
                'type' => 'success',
                'message' => 'Task deleted.',
            ];
        } catch (GeneralException $e) {
            if ($e->getCode() == 101) {
                $message = "Record is missing.";
            } else {
                $message = $e->getMessage();
            }
            $alert = [
                'type' => 'danger',
                'message' => $message,
            ];
        }
        $this->request->session()->flash('alert', $alert);
        return redirect()->route('tasks.index');
    }
}
