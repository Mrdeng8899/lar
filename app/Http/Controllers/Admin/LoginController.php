<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class LoginController extends Controller
{
    // 登入的页面展示
    public function index(){
        return view('admin/login');
    }
    // 登入页面的业务逻辑处理
    public function login(Request $request){

//        dump($request->all());die;
        //参数检测
        $data=$this->validate($request,[

            'username'=>'required',
            'password'=>'required',
            'code'=>'required|captcha',
        ]);
        unset($data['code']);
        $res=User::where($data)->first();
        if($data['username']!==$res['username']){
            return redirect()->back()->with('error','登录异常');
        }
        if($data['password'] !==$res['password']){
            return redirect()->back()->with('error','登录异常');
        }
        // 登入成功 记录session
        session(['login.user'=>$data]);
        //查询用户表

        // 判断登录的次数
        $count=cache()->has('id'.$res['id']).cache(['id'=>$res['id']],1440);
//        dump($count);die;
        if($res['id']==cache('id')){
            if($count){
                $ids='id'.$res['id'];
//            dump($ids);
                $da=cache()->get("$ids");
                dump($da);
                if($da <=5){
                    cache([$ids=>$da+1],1440);
                }else{
//                return "每天的登录次数受限";
                return redirect()->back()->with('error','每天的登录次数受限');
                }
            }
        }else{
            if($count){
                $ids='id'.$res['id'];
//            dump($ids);
                $da=cache()->get("$ids");
//                dump($da);
                if($da <=5){
                    cache([$ids=>$da+1],1440);
                }else{
//                return "每天的登录次数受限";
                    return redirect()->back()->with('error','每天的登录次数受限');
                }
            }
        // 今天没有登录记录缓存
            cache(['id'.$res['id']=>1],1440);
        }





//        for($i=1;$i<=10;$i++){
//            $res['sub']=$i;
//        }
////        User::where('id',$res['id'])->update(['count'=>('count']+1]);
//        if($res==true){
//            // 那么就是登入成功了 设置缓存
////            $res=['id'=>$res['id']];
//            $time=cache(['login'=>$res],24);
//        }
////        if(cache()->has('login')==true){
//            dump(cache('login'));
////            echo 666;
////            cache(['count'=>''],24);
//        };

        // 存储数据的key
//        $ss=$res['id'];


//        $data=cache()->remember($ss,24,function (){
//
//        });


        // 渲染首页页面
        $data=User::first()->paginate(2);
        return view('admin.index',compact('data'));

//        dump($request->all());
    }
}
