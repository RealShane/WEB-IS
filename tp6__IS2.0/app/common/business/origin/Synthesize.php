<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/28 上午12:38
 *
 */


namespace app\common\business\origin;
use app\common\model\mysql\origin\IsUniteUser as IsUniteUserModel;
use think\db\exception\DbException;
use think\facade\Db;

class Synthesize
{

    /**报名
     * @param $data
     * @return int|mixed|string
     */
    public function signInfo($data){
        try {
            $isAvailable = Db::table('synthesize_type') -> where('type', $data['type']) -> find();
            if(!$isAvailable['status']){
                return config("status.function_close");
            }
            $user = $this -> getTargetStudent($data['user_id']);
            $isExist = Db::table('synthesize_'.$user['classes_id']) -> where('name', $user['name']) -> find();

            if(empty($isExist)){
                if($data['type'] == "pin_kun_sign"){
                    $insertData = [
                        "name" => $user['name'],
                        "student_id" => $user['student_id'],
                        "situation" => $data['pin_kun_situation'],
                        "message" => $data['pin_kun_message']
                    ];
                }else if($data['type'] == "ban_wei_sign"){
                    $insertData = [
                        "name" => $user['name'],
                        "student_id" => $user['student_id'],
                        "situation" => $data['ban_wei_situation'],
                        "message" => $data['ban_wei_message']
                    ];
                }else{
                    return config("status.failed");
                }
                return Db::table('synthesize_'.$user['classes_id']) -> strict(false) -> insert($insertData);
            }

            return config("status.sign_exist");
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    /**打分
     * @param $data
     * @return int|mixed|string
     */
    public function markScore($data){
        try {
            $isAvailable = Db::table('synthesize_type') -> where('type', $data['type']) -> find();
            if(!$isAvailable['status']){
                return config("status.function_close");
            }
            $user = $this -> getTargetStudent($data['user_id']);
            if($data['type'] == "zong_ce"){
                $target = $this -> getTargetStudent($data['target']);
            }
            if($data['type'] == "ban_wei" || $data['type'] == "pin_kun"){
                $target = $this -> getTargetStudentFromSynthesize($data['target'], $user['classes_id']);
            }
            if($data['type'] == "pin_kun" || $data['type'] == "ban_wei"){
                $updateData = [
                    "zc".$user['student_id'] => 1
                ];
                return Db::table('synthesize_'.$user['classes_id']) -> where('name', $target['name']) -> data($updateData) -> update();
            }
            if($data['type'] != "zong_ce"){
                return config("status.failed");
            }

            $isExist = Db::table('synthesize_'.$user['classes_id']) -> where('name', $user['name']) -> find();

            if(empty($isExist)){
                $insertData = [
                    "name" => $user['name'],
                    "student_id" => $user['student_id'],
                    "zc".$target['student_id'] => $data['mark']
                ];
                return Db::table('synthesize_'.$user['classes_id']) -> strict(false) -> insert($insertData);
            }

            $updateData = [
                "zc".$target['student_id'] => $data['mark']
            ];
            return Db::table('synthesize_'.$user['classes_id']) -> where('name', $user['name']) -> data($updateData) -> update();
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    public function getTargetStudentFromSynthesize($id, $classes_id){
        if(empty($id)){
            return config("message.failed");
        }
        try {
            $info = Db::table('synthesize_'.$classes_id) -> where('id', $id) -> find();
            return [
                'id' => $info['id'],
                'name' => $info['name'],
                'student_id' => $info['student_id'],
            ];
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }
    /**获取目标学生(统一登陆表)
     * @param $id
     * @return array|bool|mixed|string|\think\Model|null
     */
    public function getTargetStudent($id){
        if(empty($id)){
            return config("message.failed");
        }

        try {
            $isUniteUserModel = new IsUniteUserModel();
            return $isUniteUserModel -> getUserById($id);
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    /**返回除综测以外的人员名单
     * @param $id
     * @return array|string
     */
    public function getAllStudentExceptZongCe($id){
        try {
            $user = $this -> getTargetStudent($id);
            $classes = $user['classes_id'];
            $str = "SELECT * FROM `synthesize_$classes`";
            $data = Db::query($str);
            $res = [];
            foreach($data as $key){
                try {
                    if($key['name'] == $user['name']){
                        continue;
                    }
                    if($key['message'] == NULL || $key['situation'] == NULL){
                        continue;
                    }
                    if($key["zc".$user['student_id']] != NULL){
                        continue;
                    }
                    $res[] = [
                        'id' => $key['id'],
                        'name' => $key['name']
                    ];
                }catch (\Exception $exception){
                    continue;
                }
            }
            return $res;
        }catch (DbException $exception){
            return $exception -> getMessage();
        }

    }

    /**获取综测未打分名单
     * @param $id
     * @return array|mixed|string
     */
    public function getAllStudent($id){
        if(empty($id)){
            return config("message.failed");
        }
        try {
            $isUniteUserModel = new IsUniteUserModel();
            $user = $this -> getTargetStudent($id);
            $data = $isUniteUserModel -> getAllUserByClasses($user['classes_id']);
            $res = [];
            $temp = Db::table('synthesize_'.$user['classes_id']) -> where('name', $user['name']) -> find();
            foreach($data as $key){
                try {
                    if($key['name'] == $user['name']){
                        continue;
                    }
                    if($temp != NULL){

                        if($temp["zc".$key['student_id']] == NULL){
                            $res[] = [
                                'id' => $key['id'],
                                'name' => $key['name']
                            ];
                        }
                    }else {
                        $res[] = [
                            'id' => $key['id'],
                            'name' => $key['name']
                        ];
                    }
                }catch (\Exception $exception){
                    continue;
                }
            }
            return $res;
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

}