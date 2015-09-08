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
        try {
            switch ($iscomplete) {
                case true:
                    $this->task->markComplete($recid)->executeCommand();
                    break;
                case false:
                    $this->task->markIncomplete($recid)->executeCommand();
                    break;
                default:
                    $message = "Unable to change task status.";
                    break;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $recid
     * @return Response
     */
    public function show($recid)
    {
        //
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
     * @param  Request  $request
     * @param  int  $recid
     * @return Response
     */
    public function update(Request $request, $recid)
    {
        $validators = [
            'title' => 'required',
            'description' => 'required',
        ];
        $this->validate($request, $validators);
        $data = $request->except('_method', '_token');

        try {
            $result = $this->task->updateRecord($recid, $data)->executeCommand();
            $alert = [
                'type' => 'success',
                'message' => sprintf("Task %s updated.", $data['title']),
            ];
            return redirect()->route('tasks.index')->with(compact('alert'));
        } catch (GeneralException $e) {
            $alert = [
                'type' => 'danger',
                'message' => $e->getMessage(),
            ];
            return back()->with(compact('alert'));
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
        //
    }
}
