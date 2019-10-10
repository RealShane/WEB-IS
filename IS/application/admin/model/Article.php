<?php

namespace app\admin\model;

use think\Model;


class Article extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $table = 'article';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'user_type_text',
        'verify_text'
    ];
    

    
    public function getUserTypeList()
    {
        return ['正式成员' => __('正式成员'), '管理员' => __('管理员')];
    }

    public function getVerifyList()
    {
        return ['通过' => __('通过'), '不过' => __('不过')];
    }


    public function getUserTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['user_type']) ? $data['user_type'] : '');
        $list = $this->getUserTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getVerifyTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['verify']) ? $data['verify'] : '');
        $list = $this->getVerifyList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
