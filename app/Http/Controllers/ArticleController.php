<?php
/**
 * Created by PhpStorm.
 * User: py
 * Date: 2019/3/11
 * Time: 17:57
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Session\Middleware\StartSession;
class ArticleController extends Controller
{

    /**
     * 文章数据
     */
    public function show(Request $request)
    {
        $value = $request->session()->get('userid');
        $iscookie=isset($_COOKIE['user']);
        if($value || $iscookie)
        {
            $users = DB::table('article')->paginate(6);
            return view('article.show',['student'=>$users]);
        }
        return redirect('/');

    }

    /**
    * 文章添加
    */
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $title=$request->post('user');
            $author=$request->post('password');
            $time=time();
            $bool=DB::table("article")->insert(['title'=>$title,'author'=>$author,'time'=>$time]);
            if($bool==1)
            {
                return response()->json(['url' => '/article','code'=>'200'], Response::HTTP_CREATED);
            }
        }
        return view('article.add');
    }

    /**
     * 文章删除
     */
    public function del(Request $request)
    {
        $id=$request->input('id');
        $num=DB::table("article")->where('id',$id)->delete();//删除1条
        if($num)
        {
            return redirect('/article');
        }
    }

    /**
     * 文章修改
     */
    public function update(Request $request)
    {
        $id=$request->input('id');
        $user=DB::table("article")->where('id','=',$id)->first();
        if ($request->isMethod('POST')) {
            $title=$request->post('user');
            $author=$request->post('password');
            $ids=$request->post('id');
//            $bool=DB::table("article")->where('id',$ids)->update(['title'=>$title]);
            $bool=DB::update("update article set title='$title',author='$author'  where id = ?", ["$ids"]);
//            echo $bool;die;
            if($bool==1){
                return response()->json(['url' => '/article','code'=>'200'], Response::HTTP_CREATED);
            }
        }
        return view('article.update',['user'=>$user]);
    }

}