<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/25 下午9:41
 *
 */


namespace app\common\business\origin;
use think\cache\driver\Redis;
use think\db\exception\DbException;
use think\facade\Db;

class SecondClass
{

    public function getSearchInfo($id){
        try {
            $info = Db::table('second_class_sign') -> where('student_id', $id) -> find();
            if($info == NULL){
                return config("status.failed");
            }
            return $info;
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    /**第二课堂报名
     * @param $id
     * @param $user
     * @return int|mixed|string
     */
    public function signCourse($id, $user){
        try {
            $courseInfo = Db::table('second_class_course') -> where('id', $id) -> find();
            if(time() > $courseInfo['deadline']){
                return config("status.deadline_over");
            }
            if($courseInfo['sku_limit_occupy'] >= $courseInfo['sku_limit']){
                return config("status.sign_full");
            }
            $isExist = Db::table('second_class_sign') -> where('student_id', $user['student_id']) -> find();
            if($isExist != NULL){
                return config("status.sign_exist");
            }
            $redis = new Redis();

            $classes_name = Db::table('second_class_classes') -> where('classes_id', $user['classes_id']) -> find();
            $signInfo = [
                'student_id' => $user['student_id'],
                'name' => $user['name'],
                'course_id' => $id,
                'course_name' => $courseInfo['course_name'],
                'classes_id' => $user['classes_id'],
                'classes_name' => $classes_name['classes_name']
            ];
            $str_signInfo = '';
            foreach($signInfo as $key){
                $str_signInfo .= $key.",";
            }

            $setMembers = $redis -> redis_set_sMembers(config("redis.set_course_pre").$id);
            foreach($setMembers as $key){
                if($key == $str_signInfo){
                    return config("status.sign_exist");
                }
            }

            $isPush = $redis -> redis_push(config("redis.queue_course_pre").$id, $str_signInfo);
            if($isPush){
                $redis -> redis_set_push(config("redis.set_course_pre").$id, $str_signInfo);
                $redisPOP = $redis -> redis_pop(config("redis.queue_course_pre").$id);
                $redisPOP = explode(',', $redisPOP);
                $signInfo = [
                    'student_id' => $redisPOP[0],
                    'name' => $redisPOP[1],
                    'course_id' => $redisPOP[2],
                    'course_name' => $redisPOP[3],
                    'classes_id' => $redisPOP[4],
                    'classes_name' => $redisPOP[5],
                    'year' => time()
                ];
                $insert = Db::table('second_class_sign') -> strict(false) -> insert($signInfo);
                if($insert){
                    $courseInfo['sku_limit_occupy']++;
                    return Db::name('second_class_course') -> where('id', $id) -> data(['sku_limit_occupy' => $courseInfo['sku_limit_occupy']]) -> update();
                }
                return config("status.failed");
            }
            return config("status.failed");
        }catch (DbException $exception){
            return $exception -> getMessage();
        }

    }

    /**获取目标课程的信息
     * @param $id
     * @param $user
     * @return array|string|\think\Model|null
     */
    public function getTargetCourseInfo($id, $user){
        try {
            $courses_id = $this -> getAllFitCourseId($user);
            foreach($courses_id as $key){
                if($id == $key[0]){
                    $classInfo = Db::table('second_class_course') -> where('id', $id) -> find();
                    return [
                        'id' => $classInfo['id'],
                        'course_name' => $classInfo['course_name'],
                        'description' => $classInfo['description'],
                        'author' => $classInfo['author'],
                        'location' => $classInfo['location'],
                        'time' => $classInfo['time'],
                    ];
                }
            }
            return "此课程未对你班开放！";
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    /**获取所有的课程
     * @param $user
     * @return array|string
     */
    public function getAllFitCourse($user){
        try {
            $res = [];
            $courses_id = $this -> getAllFitCourseId($user);
            foreach($courses_id as $key){
                $temp = Db::table('second_class_course') -> where('id', $key[0]) -> find();
                $res[] = [
                    'id' => $temp['id'],
                    'course_name' => $temp['course_name'],
                    'author' => $temp['author'],
                    'location' => $temp['location'],
                    'time' => $temp['time'],
                ];
            }
            return $res;
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function getAllFitCourseId($user){
        $str = "SELECT * FROM `second_class_limit`";
        try {
            $courses_id = [];
            $courses = Db::query($str);
            foreach($courses as $course){
                $temp = explode(',', $course['classes_ids']);

                foreach($temp as $key){
                    if($key == $user['classes_id']){
                        $courses_id[] = [
                            $course['course_id']
                        ];
                    }
                }
            }
            return $courses_id;
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

}