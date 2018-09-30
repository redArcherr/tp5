<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::group('admin',function (){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('reset','admin/index/reset','post');
    Route::rule('index','admin/home/index','post|get');
    Route::rule('loginout','admin/home/loginout','post|get');
    Route::rule('catelist','admin/cate/list','get');
    Route::rule('cateadd','admin/cate/add','get|post');
    Route::rule('catesort','admin/cate/sort','get|post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');//中括号代表可选参数
    Route::rule('catedel/[:id]','admin/cate/del','get|post');//中括号代表可选参数,去掉中括号就必填
    Route::rule('articlelist','admin/article/list','get');
    Route::rule('articleadd','admin/article/add','get|post');
    Route::rule('articletop','admin/article/top','post');
    Route::rule('articleedit/[:id]','admin/article/edit','get|post');
    Route::rule('articledel/[:id]','admin/article/del','post');
    Route::rule('memberlist','admin/member/all','get');
    Route::rule('memberadd','admin/member/add','get|post');
    Route::rule('memberedit/[:id]','admin/member/edit','get|post');
    Route::rule('memberdel/[:id]','admin/member/del','get|post');
    Route::rule('adminlist','admin/admin/all','get');
    Route::rule('adminadd','admin/admin/add','get|post');
    Route::rule('adminstatus','admin/admin/status','post');
    Route::rule('adminedit/[:id]','admin/admin/edit','get|post');
    Route::rule('admindel/[:id]','admin/admin/del','post');
    Route::rule('commentlist','admin/comment/all','get');
    Route::rule('commentdel','admin/comment/del','post');
    Route::rule('set','admin/system/set','get|post');
});