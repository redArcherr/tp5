<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    //判断是否登陆过
    public function initialize()
    {
        if(session('?admin.id')){
            $this->redirect('admin/home/index');
        }
    }

    //后台登陆试试git
    public function login()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            //找到模型有两种方式，命名空间和助手函数
            //命名空间
            //new \app\common\model\Admin();
            //助手函数(它的工作方式是先找自己模块下如果没有再去common里找)
            $result = model('Admin')->login($data);
            if ($result == 1) {
                $this->success('登陆成功', 'admin/home/index');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    //注册
    public function register(){
        if(request()->isAjax()){
            $data=[
                'username' => input('post.username'),
                'password' => input('post.password'),
                'email'=>input('post.email'),
                'nickname'=>input('post.nickname'),
                'conpass'=>input('post.conpass')
            ];
            $result=model('Admin')->register($data);
            if($result==1){
                $this->success('注册成功','admin/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //忘记密码,发送验证码
    public function forget(){
        if(request()->isAjax()){
            $code=mt_rand(1000,9999);
            session('code',$code);
            $content='您的重置密码验证码是:'.$code;
            $result=mailSend(input('post.email'),'修改密码所需要的验证码',$content);
            if($result){
                $this->success('验证码发送成功');
            }else{
                $this->error('验证码发送失败');
            }
        }
        return view();
    }

    //忘记密码,重置密码
    public function reset(){
        $data=[
            'code'=>input('post.code'),
            'email'=>input('post.email')
        ];
        $result=model('Admin')->reset($data);
        if($result==1){
            $this->success('密码重置成功，请去邮箱查看新密码','admin/index/login');
        }else{
            $this->error($result);
        }
    }
}
