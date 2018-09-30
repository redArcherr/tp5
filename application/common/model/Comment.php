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
}
