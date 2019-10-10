<?php

namespace app\admin\model;

use think\Model;


class Sdc1806 extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $table = 'sdc1806';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'is_afl_text'
    ];
    

    
    public function getIsAflList()
    {
        return ['有' => __('有'), '无' => __('无')];
    }


    public function getIsAflTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['is_afl']) ? $data['is_afl'] : '');
        $list = $this->getIsAflList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
