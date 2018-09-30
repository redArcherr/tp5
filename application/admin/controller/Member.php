<?php

namespace app\admin\controller;

class Member extends Base
{
    //列表
    public function all(){
        $members=model('Member')->order('create_time','desc')->paginate(10);
        $viewData=[
            'members'=>$members
        ];
        $this->assign($viewData);
        return view();
    }

    //会员添加
    public function add(){
        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email'),
            ];
            $result=model('Member')->add($data);
            if($result==1){
                $this->success('添加成功','admin/member/all');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
              'id'=>input('post.id'),
              'oldpass'=>input('post.oldpass'),
              'password'=>input('post.password'),
              'nickname'=>input('post.nickname')
            ];
            $result=model('Member')->edit($data);
            if($result==1){
                $this->success('修改成功','admin/member/all');
            }else{
                $this->error($result);
            }
        }

        $member=model('Member')->find(input('id'));
        $viewData=[
            'member'=>$member
        ];
        $this->assign($viewData);
        return view();
    }

    //删除
    public function del(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id')
            ];
            $member=model('Member')->with('comments')->find($data['id']);
            $result=$member->together('comments')->delete();
            if($result){
                $this->success('删除成功','admin/member/all');
            }else{
                $this->error('删除失败');
            }
        }
    }
}
