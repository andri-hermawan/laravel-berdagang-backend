<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index (Request $request)
    {
        // $users = \App\Models\User::paginate(10);
        $users = DB::table('users')
        ->when($request->input('name'), function ($query, $name){
            return $query->where('name', 'like', '%'.$name.'%');
        })
        ->orderBy('id','desc')
        ->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    public function create ()
    {
        return view('pages.users.create');
    }

    public function store (Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));
        User::create($data);
        return redirect()->route('user.index');
    }

    public function show ()
    {
        return view('pages.users.index');
    }

    public function edit ($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    public function update (Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        if ($request->input('passord')) {
            $data['password'] = Hash::make($request->input('password'));
        }else{
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index');
    }

    public function destroy ($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
