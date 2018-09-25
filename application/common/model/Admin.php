<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;

    //登陆校验
    public function login($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('login')->check($data)){
                return $validate->getError();
        }
        $result=$this->where($data)->find();
        if($result){
            if($result['status']!=1){
                return '账号被封';
            }else{
                //1代表有数据
                $sessionData=[
                    'id'=>$result['id'],
                    'nickname'=>$result['nickname'],
                    'is_super'=>$result['is_super']
                ];
                session('admin',$sessionData);
                return 1;
            }
        }else{
            return '用户名或密码错误!';
        }
    }

    //注册账户
    public function register($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('register')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);//只插入数据库中有的字段
        if($result){
            mailSend($data['email'],'注册成功！','恭喜注册成功验证码是');
            return 1;
        }else{
            return $this->error('注册失败！');
        }
    }

    //根据验证码重置密码
    public function reset($data){
        $validate=new \app\common\validate\Admin();
        if(!$validate->scene('reset')->check($data)){
            return $validate->getError();
        }
        if($data['code']!=session('code')){
            return '验证码错误';
        }
        $adminInfo=$this->where('email',$data['email'])->find();
        $password=mt_rand(1000,9999);
        $adminInfo->password=$password;
        $result=$adminInfo->save();
        if($result){
            $content='您的新密码是<br>用户名是：'.$adminInfo['username'].'<br>新密码是：'.$password;
            mailSend($data['email'],'密码重置成功',$content);
            return 1;
        }else{
            return '重置密码失败';
        }

    }
}
