<?php

namespace app\admin\controller;

class Cate extends Base
{
    //栏目列表
    public function list(){
        $cates = model('Cate')->order('sort','asc')->paginate(10,false);
        //定义一个模板数据变量
        $viewData = [
            'cates'=>$cates
        ];
        $this->assign($viewData);
        return view();
    }

    //添加方法
    public function add(){
        if(request()->isAjax()){
            $data=[
                'catename'=>input('post.catename'),
                'sort'=>input('post.sort')
            ];
            $result=model('Cate')->add($data);
            if($result==1){
                $this->success('添加成功','admin/cate/list');
            }else{
                $this->error($result);
            }
        }
        return view();
    }

    //栏目排序
    public function sort(){
        $data=[
            'id'=>input('post.id'),
            'sort'=>input('post.sort')
        ];
        $result=model('Cate')->sort($data);
        if($result==1){
            $this->success('排序成功','admin/cate/list');
        }else{
            $this->error($result);
        }
    }

    //栏目编辑
    public function edit(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'catename'=>input('post.catename')
            ];
            $result=model('Cate')->edit($data);
            if($result==1){
                $this->success('修改成功','admin/cate/list');
            }else{
                $this->error($result);
            }
        }

        $cateInfo = model('Cate')->find(input('id'));
        $viewData=[
            'cateInfo' => $cateInfo
        ];
        $this->assign($viewData);
        return view();
    }

    //删除栏目
    public function del(){
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id')
            ];
            $cateInfo=model('Cate')->with('article,article.comments')->find($data['id']);
            //级联删除文章下的评论
            foreach ($cateInfo['article'] as $k=>$v){
                $v->together('comments')->delete();
            }
            $result=$cateInfo->together('article')->delete();
            if($result){
                $this->success('栏目删除成功','admin/cate/list');
            }else{
                $this->error('栏目删除失败');
            }
        }
    }
}
