<?php

namespace app\admin\controller;

class Admin extends Base
{
    //管理员列表
    public function all(){
        $users=model('Admin')->order(['is_super'=>'asc','status'=>'asc'])->paginate(10);
        $viewData=[
            'users'=>$users
        ];
        $this->assign($viewData);
        return view();
    }

    //管理员添加
    public function add(){
        if(request()->isAjax()){
            $data=[
              'username'=>input('post.username'),
              'password'=>input('post.password'),
              'email'=>input('post.email'),
              'nickname'=>input('post.nickname'),
              'conpass'=>input('post.conpass'),
            ];
            $resule=model('Admin')->register($data);
            if($resule==1){
                $this->success('添加成功','admin/admin/all');
            }else{
                $this->error($resule);
            }
        }
        return view();
    }

    //管理员禁用启用
    public function status(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'status'=>input('post.status') ? 0 : 1
            ];
            $admin=model('Admin')->find($data['id']);
            $admin->status=$data['status'];
            $result=$admin->save();
            if($result){
                $this->success('操作成功','admin/admin/all');
            }else{
                $this->error('操作失败');
            }
        }
        return view();
    }

    //管理员编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'nickname'=>input('post.nickname'),
                'oldpass'=>input('post.oldpass'),
                'newpass'=>input('post.newpass')
            ];
            $result=model('Admin')->edit($data);
            if($result==1){
                $this->success('修改成功','admin/admin/all');
            }else{
                $this->error($result);
            }
        }
        $adminInfo=model('Admin')->find(input('id'));
        $viewData=[
            'adminInfo'=>$adminInfo
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
            $adminInfo=model('Admin')->find($data['id']);
            $result=$adminInfo->delete();
            if($result){
                $this->success('删除用户成功','admin/admin/all');
            }else{
                $this->error('删除失败');
            }
        }
        return view();
    }
}
