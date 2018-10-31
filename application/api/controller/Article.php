<?php

namespace app\api\controller;

use think\Controller;

class Article extends Controller
{
    //文章查询
    public function list(){
        $result=array('status'=>'','message'=>'');
        $data=model('Article')->select();
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
