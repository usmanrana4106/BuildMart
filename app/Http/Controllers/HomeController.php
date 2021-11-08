<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\TodoTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (request()->ajax())
        {
            $task=TodoList::where('user_id',Auth::user()->id);
            return datatables()->of($task)
                ->make(true);
        }
        return view('home');
    }

    public function create()
    {
        return view('todoTasks.create');
    }

    public function store(Request  $request)
    {
        $this->validate($request, [
            'todo_description' => ['required', 'string', 'max:255'],
        ]);
        TodoList::create([
            'user_id' => Auth::user()->id,
            'todo_description' => $request->todo_description,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect('/home')->with('success',"Todo List is successfully Created!!! " );
    }

    public function edit($id)
    {
       $todoList= TodoList::where([
            'user_id' => Auth::user()->id,
            'id'=>$id
        ])->first();
        return view('todoTasks.edit',compact('todoList'));
    }

    public function update(Request $request, $id)
    {
        $todoList= TodoList::where([
            'user_id' => Auth::user()->id,
            'id'=>$id
        ])->update(['todo_description' => $request->todo_description]);
        return redirect('/home')->with('success',"Todo List successfully Updated!!! " );

    }

    public function delete($id)
    {

        $todoList= TodoList::where([
            'user_id' => Auth::user()->id,
            'id'=>$id
        ])->first();
        return view('todoTasks.delete',compact('todoList'));
    }

    public function destroy($id)
    {
        TodoTask::where('list_id',$id)->delete();
        $todoList = TodoList::find($id);
        $todoList->delete();
        return redirect('/home')->with('success', 'Todo List successfully Delete!!!');
    }

}
