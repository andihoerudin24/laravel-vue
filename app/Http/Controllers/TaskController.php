<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model=Task::all();
        return response()->json([
            'data'=>$model
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
             'title'=>'required|string|max:191',
             'prior'=>'required'
        ]);
        $model=Task::create([
            'title'=>$request->title,
            'prior'=>$request->prior,
            'user_id'=>$request->user_id,
        ]);
        return response()->json([
            'data'=>$model,
            'message'=>'Success'
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request,[
            'title'=>'required|string|max:191',
            'prior'=>'required'
       ]);
       $task->title   = $request->title;
       $task->prior   = $request->prior;
       $task->user_id = $request->user_id;

       $task->save();
       return response()->json([
           'data'=>$task,
           'message'=>'success'
       ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            'message'=>'success'
        ],200);
    }
}
