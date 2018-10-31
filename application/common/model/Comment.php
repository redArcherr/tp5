<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    use SoftDelete;
    //关联文章表
    public function article(){
        return $this->belongsTo('Article','article_id','id');
    }

    //关联会员表
    public function member(){
        return $this->belongsTo('Member','member_id','id');
    }

    //添加评论
    public function comm($data){
        $validate=new \app\common\validate\Comment();
        if(!$validate->scene('comm')->check($data)){
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '评论失败';
        }
    }
}
