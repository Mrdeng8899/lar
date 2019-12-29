<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    // 登录页面的路由
    public function login(){
        return view('admin/login');
    }
        // 登入页面的业务逻辑处理
    public function list(Request $request){

//        dump($request->all());die;
            //参数检测
            $data=$this->validate($request,[
                'username'=>'required',
                'password'=>'required',
//                'code'=>'required|captcha',
            ]);
//            dump($data);die;
            unset($data['code']);
            $res=User::where($data)->first();
            if(cache()->has($data['username'])){
                cache()->increment($data['username']);
            }else{
                cache([$data['username']=>1],30);
            }
            if(cache($data['username']) >3){
                return redirect()->back()->with("error","登录失败,账号或者密码错误3次,请30分钟后重试");
            }
//            dump($res);die;
//            if ($res==null) {
//                $count = cache()->has($data['username']);
////                dump($count);
//                if($count){
//                    $idd=$data['username'];
//                }
//            }else{
//                cache([$data['username']=>'1'],30);
//            }
//                        return redirect()->back()->with('error', '密码错误已过了三次30分钟后重试');

            if(!$res){
               return redirect()->back()->with('error', '登录异常');
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
//                    dump($da);
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
            $data=User::first()->paginate(5);
//            dump($data);die;
            return view('admin.index',compact('data'));

//        dump($request->all());
        }




    //添加页的页面展示
    public function create(){
        return view('admin.create');
    }
    // 跳转到首页的路由去
    public function index(){
        $data=User::first()->paginate(5);
        return view('admin.index',compact('data'));
    }
    // 添加页面的展示
    public function save(Request $request){
//        dump($request->all());die;
        $data=$this->validate($request,[
            'username'=>'required',
            'truename'=>'required',
            'password'=>'required',
            'sex'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'resume'=>'required',
        ]);

        // 文件上传 配置
        $data['header']='';
        if($request->hasFile('header')){
            $file=$request->file('header');
        }
        $filename=$file->store('','user');
        $data['header']='/uploads'.$filename;
        User::create($data);
        return redirect(route('user.index'));
        // 返回页面
//        return view('Admin/index',compact('data'));
    }
    // 时间和根据用户名进行查找
    public function search(Request $request){
//        dump($request->all());
        $res=$request->all();
//        dump($res);die;
        //根据传过的的东西进行查询用户表
//        $data=User::when($res['username'],function ($request) use ($res){
//            $request->where('created_at','like',"%{$res['created_at']}%")->where('username','like',"%{$res['username']}%");
//        })->get();
        $data=User::where('username','like',"%{$res['username']}%")->paginate(2);
//        dump($dd);die;
        return view('admin.index',compact('data'));
    }


    public function del(Request $request,$id){
        $res=User::where('id',$id)->delete();
        dump($res);
    }
    // 回收战页面
    public function show(Request $request){
        // 查询在回收站的数据
        $res=User::onlyTrashed()->paginate(2);
        return view('admin.show',compact('res'));
    }
    // 点击恢复的的方法
    public function os(Request $request,$id){
//        dump($id);  根据id 查询这个软删除的信息
        $data=User::where('id',$id)->onlyTrashed()->first();
        if($data){
            $res=$data->restore();
            if($res){
                // 还原成功
                return redirect(route('admin.show'))->with('success','还原成功,请手动回首页查看');
            }
            return redirect()->back()->with('error','还原失败');
        }
        return redirect()->back()->with('error','非合法的还原');
    }

    // 永久删除的方法
    public function de(Request $request,$id){
        // 用户删除
        $data=User::where('id',$id)->forceDelete();
        return redirect(route('admin.show'))->with('success',"用户删除数据成功");
    }
    // 修改页面展示
    public function edit(Request $request,$id){
        $data=User::find($id);
//        dump($data);die;
        if(is_null($data)){
            return redirect()->back();
        }
        // 展示到页面上面qu
        return view('admin.edit',compact('data'));
    }
    public function update(Request $request,$id){
//        dump($request->all());
        $data=$this->validate($request,[
            "username" => "required",
            "email" => "required|email",
            "sex" => "required",
            'happy'=>'required',
            "phone" => "required",
            "resume" => "required",
        ]);
        $res=User::where('id',$id)->update([
            'username'=>$data['username'],
            'email'=>$data['email'],
            'sex'=>$data['sex'],
            'happy'=>$data['happy'],
            'phone'=>$data['phone'],
            'resume'=>$data['resume'],
        ]);
        if($res){
            return redirect(route('user.index'))->with('success',"数据修改成功");
        }else{
            // 添加添加失败
            return redirect()->back();
        }
    }
}
