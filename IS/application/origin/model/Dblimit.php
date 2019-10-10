<?php
namespace app\origin\model;
use think\Model;
class Dblimit extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'limit';
	public function Dbcourse()
    {
        return $this->hasOne('Dbcourse','id','course_id',[],'LEFT');
    }
	public function Dbclasses()
    {
        return $this->hasOne('Dbclasses','id','classes_id',[],'LEFT');
    }
}