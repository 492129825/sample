<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users|max:255',//
            'password' => 'required|confirmed|min:6'
        ]);

        $user =User::create([
            'name'=>$request->name,
            'eamil'=>$request->eamil,
            'password'=>bcrypt($request->password),
        ]);



        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');

        return redirect()->route('users.show',[$user]);
    }
    //required 来验证用户名是否为空
    //min max 来限制所填写的最大最小长度。
    //email 格式驗證
    //unique:users 唯一性驗證
    //confirmed 密碼匹配驗證
}
