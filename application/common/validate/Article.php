<?php
/**
 * Created by PhpStorm.
 * User: surfacepro
 * Date: 2018/9/28
 * Time: 15:25
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule=[
        'title|文章标题'=>'require|unique:article',
        'author|作者'=>'require',
        'tags|文章标签'=>'require',
        'desc|文章描述'=>'require',
        'content|文章内容'=>'require',
        'cate_id|文章栏目'=>'require',
        'is_top|是否置顶'=>'require',
    ];

    //添加场景
    public function sceneAdd(){
        return $this->only(['title','tags','desc','content','cate_id','author']);
    }

    public function sceneTop(){
        return $this->only(["is_top"]);
    }

    public function sceneEdit(){
        return $this->only(['tags','desc','content','cate_id','title','is_top','author']);
    }

}