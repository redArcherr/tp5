<?php

namespace app\admin\controller;

use think\Controller;

class Comment extends Base
{
    //评论列表
    public function all(){
        $comments=model('Comment')->with('article','member')->order('create_time','desc')->paginate(10);
        $viewData=[
          'comments'=>$comments
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
            $comment=model('Comment')->find($data['id']);
            $result=$comment->delete();
            if($result){
                $this->success('删除成功','admin/comment/all');
            }else{
                $this->error('删除失败');
            }
        }
        return view();
    }
}
