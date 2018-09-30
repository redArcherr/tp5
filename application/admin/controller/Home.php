<?php

namespace app\admin\controller;

class Home extends Base
{
    //首页
    public function index(){
        $systemInfo=model('System')->find(1);
        $viewData=[
            'systemInfo'=>$systemInfo
        ];
        $this->assign($viewData);
        return view();
    }

    public function loginout(){
        session(null);
        if(session('?admin.id')){
            $this->error('退出失败');
        }else{
            $this->success('退出成功','admin/index/login');
        }
    }
}
