<?php
/**
 * Created by PhpStorm.
 * User: surfacepro
 * Date: 2018/9/20
 * Time: 16:06
 */

namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule=[
        'username|用户名'=>'require',
        'password|密码'=>'require',
        'conpass|确认密码'=>'require|confirm:password',
        'nickname|昵称'=>'require',
        'email|邮箱'=>'require|email|unique:admin',
        'code|验证码'=>'require',
        'oldpass|旧密码'=>'require',
        'newpass|新密码'=>'require'
    ];

    //场景验证--登陆
    public function sceneLogin(){
        return $this->only(['username','password']);
    }
    //场景验证--注册
    public function sceneRegister(){
        //append中链接了一个独自的验证规则，注册用户名要相对admin表唯一
        return $this->only(['username','password','email','nickname','conpass'])->append('username','unique:admin');
    }
    //养正场景--验证码
    public function sceneReset(){
        return $this->only(['code']);
    }
    //验证场景--修改
    public function sceneEdit(){
        return $this->only(['oldpass','newpass','nickname']);
    }
}