<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;

    //关联栏目表
    public function cate(){
        return $this->belongsTo('Cate','cate_id');
    }

    //关联评论表
    public function comments(){
        return $this->hasMany('Comment','article_id','id');
    }

    //文章添加
    public function add($data){
        $validate =new \app\common\validate\Article();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '添加失败';
        }
    }

    //推荐
    public function top($data){
        $validate = new \app\common\validate\Article();
        if(!$validate->scene('top')->check($data)){
            return $validate->getError();
        }
        $article=$this->find($data['id']);
        $article->is_top=$data['is_top'];
        $result=$article->save();
        if($result){
            return 1;
        }else{
            return '操作失败';
        }
    }

    //修改
    public function edit($data){
        $validate = new \app\common\validate\Article();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $article=$this->find($data['id']);
        $article->title=$data['title'];
        $article->tags=$data['tags'];
        $article->is_top=$data['is_top'];
        $article->cate_id=$data['cate_id'];
        $article->desc=$data['desc'];
        $article->content=$data['content'];
        $result=$article->allowField(true)->save();
        if($result){
            return 1;
        }else{
            return '操作失败';
        }
    }
}
