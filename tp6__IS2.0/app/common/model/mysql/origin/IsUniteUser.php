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

class IsUniteUser extends Model
{
    protected $table = 'is_unite_user';

    public function getAllResultByClassesId($classes_id){
        return $this -> where('classes_id', $classes_id) -> where('status', '启用') -> select();
    }

    public function activeAccount($email){
        $update = $this -> getUnActiveUserByEmail($email);
        $data = [
            "status" => "启用"
        ];
        return $update -> allowField(['status']) -> save($data);
    }

    public function add($data){
        if(!is_array($data)){

            return $this -> show(
                config("status.failed"),
                config("message.key_fault"),
                NULL
            );
        }
        $this -> save($data);

        return $this -> id;
    }

    public function updateLoginTimeAndIp($data, $key){
        $update = $this -> getUserByEmail($key);
        return $update ->allowField(['last_login_ip', 'last_login_time']) -> save($data);
    }

    public function getAllUserByClasses($classes){
        if(empty($classes)){
            return false;
        }
        return $this -> where('classes_id', $classes) -> where('status', "启用") -> select();
    }

    public function getUserByName($name){
        if(empty($name)){
            return false;
        }
        return $this -> where('name', $name) -> where('status', "启用") -> find();
    }

    public function getUnActiveUserByName($name){
        if(empty($name)){
            return false;
        }
        return $this -> where('name', $name) -> find();
    }

    public function getUnActiveUserByStudentId($student_id){
        if(empty($student_id)){
            return false;
        }
        return $this -> where('student_id', $student_id) -> find();
    }

    public function getUserByStudentId($student_id){
        if(empty($student_id)){
            return false;
        }
        return $this -> where('student_id', $student_id) -> where('status', "启用") -> find();
    }

    public function getUnActiveUserByEmail($email){
        if(empty($email)){
            return false;
        }
        return $this -> where('email', $email) -> find();
    }

    public function getUserByEmail($email){
        if(empty($email)){
            return false;
        }
        return $this -> where('email', $email) -> where('status', "启用") -> find();
    }

    public function getUserById($id){
        if(empty($id)){
            return false;
        }
        return $this -> where('id', $id) -> where('status', "启用") -> find();
    }
}