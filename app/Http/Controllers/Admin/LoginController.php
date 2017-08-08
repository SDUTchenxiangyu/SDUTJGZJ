<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Crypt;
use App\Http\Model\User;
use Code;
// require_once '../resources/org/Code.class.php';

class LoginController extends CommonController
{
    public function login(Request $request)
    {
        if($input = $request->input())
        {
            $code = new Code();
            $_code = $code->get();
            if(strtoupper($input['code'])!=$_code)
            {
                return back()->with('msg','验证码错误');
            }
            $user = User::first();
            if($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass'])
            {
                return back()->with('msg','用户名或密码错误');
            }
            session(['user'=>$user]);
            return redirect('admin/index');
        }
        else
        {
            return view('admin.login');
        }  
    }
    public function code()
    {
        $code = new Code();
        $code->make();
    }
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
