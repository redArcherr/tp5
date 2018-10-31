<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    use SoftDelete;
    //只读字段，不允许修改
    protected $readonly = ['username','email'];

    //关联评论表
    public function comments(){
        return $this->hasMany('Comment','member_id','id');
    }

    //添加
    public function add($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '会员添加失败';
        }
    }

    //编辑
    public function edit($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $member=$this->find($data['id']);
        if($data['oldpass']!=$member['password']){
            return '旧密码填写不正确';
        }
        $member->password=$data['password'];
        $member->nickname=$data['nickname'];
        $result=$member->save();
        if($result){
            return 1;
        }else{
            return '修改失败';
        }
    }

    //注册
    public function register($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }

        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '注册失败';
        }

    }

    //登陆
    public function login($data){
        $validate=new \app\common\validate\Member();
        if(!$validate->scene('login')->check($data)){
            return $validate->getError();
        }
        unset($data['verify']);

        $result=$this->where($data)->find();
        if($result){
            $sessionData=[
                'id'=>$result['id'],
                'nickname'=>$result['nickname'],
            ];
            session('index',$sessionData);
            return 1;
        }else{
            return '用户名或密码错误';
        }

    }
}
