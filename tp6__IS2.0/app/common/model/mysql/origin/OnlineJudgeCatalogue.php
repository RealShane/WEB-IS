<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/2/2 下午10:29
 *
 */


namespace app\common\model\mysql\origin;
use think\Model;

class OnlineJudgeCatalogue extends Model
{

    protected $table = 'oj_catalogue';

    public function findTargetCatalogue($id){
        return $this -> where('id', $id) -> where('status', '启用') -> find();
    }

    public function findAllAvailableCatalogues(){
        return $this -> where('status', '启用') -> select();
    }

}