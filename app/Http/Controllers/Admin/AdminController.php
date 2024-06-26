<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $data = [

            'employees' => Employee::all()
        ];
        return view('admin.index')->with($data);
    }

    public function reset_password() {
        return view('auth.reset-password');
    }

    public function update_password(Request $request) {
        $user = Auth::user();
        dd($user->password);
        if($user->password == Hash::make($request->old_password)) {
            dd($request->all());
        } else {
            $request->session()->flash('error', 'Password Salah');
            return back();
        }
    }
}
