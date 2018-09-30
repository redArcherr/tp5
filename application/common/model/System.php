<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class System extends Model
{
    use SoftDelete;

    public function edit($data){
        $validate=new \app\common\validate\System();
        if(!$validate->scene('edit')->check($data)){
            return $validate->getError();
        }
        $system=$this->find($data['id']);
        $system->webname=$data['webname'];
        $system->copyright=$data['copyright'];
        $result=$system->save();
        if($result){
            return 1;
        }else{
            return '修改失败';
        }
    }
}
