<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::get();
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function create_process(Request $request)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'is_admin' => 0,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('backend.manage.user')->with('success', "The Category <strong>{$request->name}</strong> created successfully");
    }

    public function edit($id = null){
        if ($id == null){
            return redirect()->route('backend.manage.user')->with('error', "the ID is empty");
        } else{
            $item = User::find($id);
            return view('backend.user.edit', compact('item'));
        }
    }

    public function edit_process(Request $request)
    {
        request()->validate([
            'name'  => 'required',
            'email'  => 'required',
            'password' => 'required'
        ]);

        User::where('id', $request->id)->update(([
            'name'  => $request->name,
            'email'  => $request->email,
            'password' => Hash::make($request->password)
        ]));

        return redirect()->route('backend.manage.user')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){
        $item = User::find($id);

        $item->delete();

        return redirect()->route('backend.manage.user')->with('success', 'Item deleted successfully');
    }
}
