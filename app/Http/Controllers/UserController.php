<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        //
        $users=User::all();


        return view('users.index', compact('users'));
    }


 /**
     */
    public function create()
    {

        return view('users.create');
    }



    public function store(Request $request)
    {
        //store in database using Model Task
        //Teknik menggunakan POPO-Plain Old Php object
        //dollar request yg memgang semua input dalam form
        //class Task() menghasilkan object $task utk disimpan ke dalam row baru utk di simpan ke dalam table

        $user=new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        //return to index tasks
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        //compact tu maksudnya hantar data

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        //resources/views/tasks/edit.blade.pho + $task
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {

        $user->delete();
        return redirect()->route('users.index');
    }

}
