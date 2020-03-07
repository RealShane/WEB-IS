<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/27 上午3:35
 *
 */


namespace app\common\model\mysql\origin;
use think\Model;

class TimePostalMailbox extends Model
{
    protected $table = 'time_postal_mailbox';

    public function updateSendInfo($id){
        $data = [
            "status" => "已发送"
        ];
        return $this -> getLetterById($id) -> allowField(['status']) -> save($data);
    }

    public function getAllPrivateLetter(){
        return $this -> where('status', "时光信件") -> select();
    }

    public function findTargetLetterById($id){
        return $this -> where('id', $id) -> where('status', "公开信") -> find();
    }

    public function findAllOpenLetter(){
        return $this -> where('status', "公开信") -> select();
    }

    public function recoveryTheLetterById($id ,$status){
        $data = [
            "status" => $status
        ];
        return $this -> getLetterById($id) -> allowField(['status']) -> save($data);
    }

    public function softDeleteLetterById($id){
        $data = [
            "status" => "删除"
        ];
        return $this -> getLetterById($id) -> allowField(['status']) -> save($data);
    }

    public function getLetterById($id){
        if(empty($id)){
            return false;
        }
        return $this -> where('id', $id) -> find();
    }

    public function getLetterByEmail($email){
        if(empty($email)){
            return config("status.failed");
        }
        return $this -> where('email', $email) -> select();
    }

    public function add($data){
        if(!is_array($data)){

            return $this -> show(
                config("status.failed"),
                config("message.key_fault"),
                NULL
            );
        }
        if($this -> save($data)){
            return config("status.success");
        }

        return config("status.failed");
    }


}