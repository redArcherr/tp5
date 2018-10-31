<?php

namespace app\api\controller;

use think\Controller;

class Index extends Controller
{
    //测试api接口
    public function list(){
        $result=array('status'=>'','message'=>'');
        $data=model('Admin')->select();
        if($data){
            $result['status']=0;
            $result['message']=$data;
        }else{
            $result['status']=-1;
            $result['message']='服务器错误';
        }
        return json($result);

    }
}
