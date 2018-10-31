<?php
/**
 * Created by PhpStorm.
 * User: surfacepro
 * Date: 2018/9/30
 * Time: 21:29
 */

namespace app\common\validate;


use think\Validate;

class Comment extends Validate
{
    protected $rule=[
        'content'=>'require',
    ];
    public function sceneComm(){
        return $this->only(['content']);
    }
}