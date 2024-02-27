<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN'))
        {
            return redirect('admin/dashboard');

        }else{
        return view('admin.login');

        }
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result = admin::where(['email'=>$email,'password'=>$password])->get();
        $result = admin::where(['email'=>$email])->first();
        if($result)
        {
            if(Hash::check($request->post('password'),$result->password))
           {
             $request->session()->put('ADMIN_LOGIN', true);
            $request->session()->put('ADMIN_ID', $result->id);
            return redirect('admin/dashboard');
        }else{
            return back()->with('fail','Incorrect password');
            return redirect('admin');
        }

        }else{
            return back()->with('fail','Incorrect email or password');
            return redirect('admin');
        }



    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    // public function updatePassword()
    // {
    //     $r= admin::find(1);
    //     $r->password=Hash::make('Hello@1985');
    //     $r->save();
    // }

}
