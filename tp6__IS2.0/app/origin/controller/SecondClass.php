<?php
namespace app\origin\controller;

use app\common\business\origin\SecondClass as SecondClassBusiness;
use think\exception\ValidateException;

class SecondClass extends Auth
{

    public function searchSign(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }

        $id = $this->request->param("student_id", '', 'htmlspecialchars');
        $secondClassBusiness = new SecondClassBusiness();
        $isSuccess = $secondClassBusiness->getSearchInfo($id);
        if($isSuccess == config("status.failed")){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                config("message.no_res")
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $isSuccess
        );
    }

    public function signForCourse(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }

        $id = $this->request->param("target", '', 'htmlspecialchars');
        $user = $this -> getUserInfoByToken();

        $secondClassBusiness = new SecondClassBusiness();
        $isSuccess = $secondClassBusiness -> signCourse($id, $user);

        if ($isSuccess == config("status.sign_full")) {
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                config("message.sign_full")
            );
        }
        if ($isSuccess == config("status.sign_exist")) {
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                config("message.sign_exist")
            );
        }
        if ($isSuccess == config("status.deadline_over")) {
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                config("message.deadline_over")
            );
        }
        if ($isSuccess == config("status.failed")) {
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "网络原因报名失败"
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $isSuccess
        );

    }

    public function targetCourseInfo(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $id = $this->request->param("target", '', 'htmlspecialchars');
        $user = $this -> getUserInfoByToken();
        $secondClassBusiness = new SecondClassBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $secondClassBusiness -> getTargetCourseInfo($id, $user)
        );
    }

    public function allCourse(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $secondClassBusiness = new SecondClassBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $secondClassBusiness->getAllFitCourse($user)
        );
    }

    public function getUserInfoByToken(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $token = request() -> header('access-token');
        return cache(config("redis.token_pre").$token);
    }

}