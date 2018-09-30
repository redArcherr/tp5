<?php

namespace app\admin\controller;

class Article extends Base
{
    //文章列表
    public function list(){
        $articles=model('Article')->with('cate')->order(['is_top'=>'asc','create_time'=>'desc'])->paginate(10);
        $viewData=[
            'articles'=>$articles
        ];
        $this->assign($viewData);
        return view();
    }

    //文章添加
    public function add(){
        if(request()->isAjax()){
            $data=[
                'title'=>input('post.title'),
                'tags'=>input('post.tags'),
                'is_top'=>input('post.is_top',0),
                'cate_id'=>input('post.cate_id'),
                'desc'=>input('post.desc'),
                'content'=>input('post.content'),
            ];
            $result=model('Article')->add($data);
            if($result==1){
                $this->success('文章添加成功','admin/article/list');
            }else{
                $this->error($result);
            }
        }
        $cateIds=model('Cate')->select();
        $viewData=[
            'cateIds'=>$cateIds
        ];
        $this->assign($viewData);
        return view();
    }

    //推荐
    public function top(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'is_top'=>input('post.is_top')?0:1
            ];
            $result=model('Article')->top($data);
            if($result==1){
                $this->success('操作成功','admin/article/list');
            }else{
                $this->error($result);
            }
        }
    }

    //文章编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'title'=>input('post.title'),
                'tags'=>input('post.tags'),
                'is_top'=>input('post.is_top',0),
                'cate_id'=>input('post.cate_id'),
                'desc'=>input('post.desc'),
                'content'=>input('post.content'),
            ];
            $result=model('Article')->edit($data);
            if($result==1){
                $this->success('修改成功','admin/article/list');
            }else{
                $this->error($result);
            }
        }
        $article=model('Article')->find(input('id'));
        $cates=model('Cate')->select();
        $viewData=[
            'article'=>$article,
            'cates'=>$cates
        ];
        $this->assign($viewData);
        return view();
    }

    //删除
    public function del(){
        if(request()->isAjax()){
            $id=input('post.id');
            $article=model('Article')->with('comments')->find($id);
            $result=$article->together('comments')->delete();
            if($result){
                $this->success('文章删除成功','admin/article/list');
            }else{
                $this->error('文章删除失败');
            }
        }
    }
}
