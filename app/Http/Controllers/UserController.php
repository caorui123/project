<?php
/**
 * Created by PhpStorm.
 * User: py
 * Date: 2019/3/11
 * Time: 14:00
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Session\Middleware\StartSession;
class UserController extends Controller
{


    /**
     * 用户登录页面
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        $usrid=$request->session()->get('userid');
        $iscookie=isset($_COOKIE['user']);
        if($iscookie || $usrid)
        {
            return redirect('/article');
        }
        if ($request->isMethod('POST')) {
            $user=$request->post('user');
            $password=$request->post('password');
            $checkbox=$request->post('checkbox');
//            $users=DB::table("user")->whereRaw('name= ? and password = ?',[$user,$password])->first();
            $users=DB::table("user")->where('name','=',$user)->first(); //一个条件
            if($users)
            {
                if($password===$users->password)
                {
                    if($checkbox==1)
                    {
                        setcookie("user", $users->id,time()+3600*24*7);
                    }
                    $request->session()->put('userid', $users->id);
                    return response()->json(['url' => '/article','code'=>'200'], Response::HTTP_CREATED);
                }else{
                    return response()->json(['url' => '/article','code'=>'201','message'=>'密码错误'], Response::HTTP_CREATED);
                }
            }else{
                return response()->json(['url' => '/article','code'=>'201','message'=>'账号不存在'], Response::HTTP_CREATED);
            }
        }
        return view('user.login');
    }

    /**
     * 用户注册页面
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
           $user=$request->post('user');
           $password=$request->post('password');
           $isuser=DB::table("user")->where('name','=',$user)->first();
           if(empty($isuser)){
               $bool=DB::table("user")->insert(['name'=>$user,'password'=>$password]);
               if($bool==1)
               {
                   return response()->json(['url' => '/login','code'=>'200'], Response::HTTP_CREATED);
               }
           }
            return response()->json(['url' => '/login','code'=>'201'], Response::HTTP_CREATED);
        }
        return view('user.register');
    }

    public function logout(Request $request)
    {
        setcookie("user", "");
        $request->session()->forget('userid');
        return redirect('/');
    }

}