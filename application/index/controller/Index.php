<?php
namespace app\index\controller;


class Index extends Base
{
    //首页的内容
    public function index(){
        $where=[];
        $catename=null;
        if(input('?id')){
            $where=[
                'cate_id'=>input('id')
            ];
            $catename=model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewData=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewData);
        return view();
    }

    //注册
    public function register(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
                'verify'=>input('post.verify')
            ];
            $result=model('Member')->register($data);
            if($result==1){
                $this->success('注册成功','index/index/login');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //登陆
    public function login(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'verify'=>input('post.verify')
            ];
            $result=model('Member')->login($data);
            if($result==1){
                $this->success('登陆成功','index/index/index');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //退出
    public function loginout(){
        if(request()->isAjax()){
            session(null);
            if(session('?index.id')){
                $this->error('退出失败');
            }else{
                $this->success('退出成功','index/index/index');
            }
        }
        return view();
    }

    //搜索
    public function search(){
        $where[]=['title','like','%'.input('keyword').'%'];
        $catename=input('keyword');
        $articles=model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewDate=[
            'articles'=>$articles,
            'catename'=>$catename
        ];
        $this->assign($viewDate);
        return view('index');
    }
}
