<?php

namespace app\index\controller;

class Article extends Base
{
    //文章详情
    public function info(){
        $articleInfo=model('Article')->with('comments','comments.member')->find(input('id'));
        $articleInfo->setInc('click');//点击量，访问一次增加一次
        $viewData=[
            'articleInfo'=>$articleInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //评论
    public function comm(){
        if(request()->isAjax()){
            $data=[
                'article_id'=>input('post.article_id'),
                'member_id'=>input('post.member_id'),
                'content'=>input('post.content'),

            ];
            $result=model('Comment')->comm($data);
            if($result==1){
                $this->success('评论成功');
            }else{
                $this->error($result);
            }
        }
        return view();
    }
}
