<?php

namespace app\admin\model;

use think\Model;


class ForumUser extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $table = 'forum_user';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'comment_text',
        'type_text'
    ];
    

    
    public function getCommentList()
    {
        return ['可以' => __('可以'), '不可以' => __('不可以')];
    }

    public function getTypeList()
    {
        return ['正式成员' => __('正式成员'), '管理员' => __('管理员')];
    }


    public function getCommentTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['comment']) ? $data['comment'] : '');
        $list = $this->getCommentList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
