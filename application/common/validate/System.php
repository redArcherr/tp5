<?php
/**
 * Created by PhpStorm.
 * User: surfacepro
 * Date: 2018/9/30
 * Time: 22:33
 */

namespace app\common\validate;


use think\Validate;

class System extends Validate
{
    protected $rule=[
        'webname|网站名称'=>'require',
        'copyright|版权信息'=>'require'
    ];

    public function sceneEdit(){
        return $this->only(['webname','copyright']);
    }
}