<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskCreatedMail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        \info(auth()->user()->name.'User click tasks index');
        //query using ORM Eloquent Task Model
        //$tasks=Task::all();

        //get tasks from authenticated users
        //$user=auth()->user();
        //$tasks=$user->tasks;


        $tasks = Task::all();

        \info('User has ' . $tasks->count() . 'task');

        //return to view with $tasks
        //resources/views/tasks/index.blade.php + $tasks
        //compact tu bermaksud hantar data ke index
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //show form tasks/create.blade.php
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        //store in database using Model Task
        //Teknik menggunakan POPO-Plain Old Php object
        //dollar request yg memgang semua input dalam form
        //class Task() menghasilkan object $task utk disimpan ke dalam row baru utk di simpan ke dalam table

        $task=new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id=auth()->user()->id;

        $task->save();


         //send email to user
         Mail::to($task->user->email)->send(new TaskCreatedMail($task));

        //return to index tasks
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //compact tu maksudnya hantar data
        $this->authorize('view', $task);
        \info(auth()->user()->name.'click tasks show'. $task->id);


        return view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //resources/views/tasks/edit.blade.pho + $task
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
        $this->authorize('update', $task);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $this->authorize('delete',$task);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
