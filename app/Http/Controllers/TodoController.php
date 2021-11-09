<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\TodoTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index()
    {

    }


    public function taskLists($list_id)
    {
        $list=TodoList::where('id',$list_id)->first();
        if (request()->ajax())
        {
            $task=TodoTask::where('list_id',request('id'));
            return datatables()->of($task)
                ->make(true);
        }
        return view('todoTasks.tasks.index',compact('list_id','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|
     * \Illuminate\Http\Response
     */

    public function create()
    {

    }


    public function createTasks($list_id)
    {
        $list=TodoList::where('id',$list_id)->first();
        return view('todoTasks.tasks.create',compact('list_id','list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param
     * \Illuminate\Http\Request  $request
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Http\RedirectResponse|
     * \Illuminate\Http\Response|
     * \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'task' => ['required', 'string', 'max:255', 'unique:todo_tasks'],
        ]);

        TodoTask::create([
            'list_id' => $request->list_id,
            'task' => $request->task,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect('/taskLists/'. $request->list_id)->with('success',"Task is successfully Created!!! " );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todotask= TodoTask::where([
            'id'=>$id
        ])->first();
        $todoList=TodoList::where('id',$todotask->list_id)->first();
        return view('todoTasks.tasks.edit',compact('todoList','todotask'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Http\RedirectResponse|
     * \Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $todotask= TodoTask::where([
            'id'=>$id
        ])->first();
        $todotask->update(['task' => $request->task]);
        return redirect('/taskLists/'. $todotask->list_id)->with('success',"Todo List successfully Updated!!! " );
    }

    public function updateStatus($task_id)
    {
        $task=TodoTask::where([
            'id'=>$task_id
        ])->first();
        if ($task->status == 0)
        {
            $task=TodoTask::where([
                'id'=>$task_id
            ])->update(['status'=>1]);
        }
        else
        {
            $task=TodoTask::where([
                'id'=>$task_id
            ])->update(['status'=>0]);
        }

        return response()->json('success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return
     * \Illuminate\Contracts\Foundation\Application|
     * \Illuminate\Contracts\View\Factory|
     * \Illuminate\Contracts\View\View|
     * \Illuminate\Http\Response
     */


    public function delete($id)
    {
        $todotask= TodoTask::where([
            'id'=>$id
        ])->first();
        $todoList= TodoList::where([
            'id'=>$todotask->list_id
        ])->first();
        return view('todoTasks.tasks.delete',compact('todoList','todotask'));
    }


    public function destroy($id)
    {
        $todoTask = TodoTask::find($id);
        $todoTask->delete();
        return redirect('/taskLists/'. $todoTask->list_id)->with('success', 'Task is successfully Delete!!!');
    }
}
