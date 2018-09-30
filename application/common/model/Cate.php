<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    use SoftDelete;

    //关联文章表
    public function article(){
        return $this->hasMany('Article','cate_id','id');
    }

    //添加方法
    public function Add($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('add')->check($data)){
            return $validate->getError();
        }

        $result=$this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '栏目添加失败';
        }
    }

    //排序
    public function Sort($data){
        $validate=new \app\common\validate\Cate();
        if(!$validate->scene('sort')->check($data)){
            return $validate->getError();
        }

        $cate=$this->find($data['id']);
        $cate->sort=$data['sort'];
        $result=$cate->save();
        if($result){
            return 1;
        }else{
            return '栏目添加失败';
        }
    }

    //编辑
    public function Edit($data){
        $validate = new \app\common\validate\Cate();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $cateInfo = $this->find($data['id']);
        $cateInfo->catename=$data['catename'];
        $result=$cateInfo->save();
        if($result){
            return 1;
        }else{
            return '修改失败';
        }
    }
}
