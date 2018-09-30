<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    //验证是否登陆过
    public function initialize()
    {
        if(!session('?admin.id')){
            $this->redirect('admin/index/login');
        }
    }
}
