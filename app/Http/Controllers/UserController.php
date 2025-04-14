<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $model = User::class;
    protected $view = 'user';
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'password' => 'required|min:4'
        ]);

        User::create($validate);
        return redirect()->route('user.index')->with('success','User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        if($user->email == 'admin@gmail.com' && $user->role == 'admin'){
            return redirect()->route('user.index')->with('error','Admin tidak dapat diedit');
        }

        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'password' => 'nullable|min:4'
        ]);

        $user->name = $validate['name'];
        $user->email = $validate['email'];
        $user->role = $validate['role'];

        if(!empty($request->password)){
            $user->password = bcrypt($validate['password']);
        }

        $user->save();
        return redirect()->route('user.index')->with('success','User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->email == 'admin@gmail.com' && $user->role == 'admin'){
            return redirect()->route('user.index')->with('error','Admin tidak dapat dihapus');
        }
        $user->delete();
        return redirect()->route('user.index')->with('success','User berhasil dihapus');
    }
}
