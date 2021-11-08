<?php

namespace App\Http\Controllers;

use App\Models\TodoTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
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
        if (request()->ajax())
        {
            $task=TodoTask::where('user_id',Auth::user()->id);
            return datatables()->of($task)
                ->make(true);
        }
        return view('todoTasks.index');
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
        return view('todoTasks.create');
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
            'task' => ['required', 'string', 'max:255'],
        ]);
        TodoTask::create([
            'user_id' => Auth::user()->id,
            'task' => $request->task,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect('/todo-tasks')->with('success',"Task is successfully Created!!! " );
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
