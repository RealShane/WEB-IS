<?php
namespace app\origin\controller;
use app\common\business\origin\TimePostal as TimePostalBusiness;
use app\common\validate\origin\TimePostal as TimePostalValidate;
use think\exception\ValidateException;


class TimePostal extends Auth
{

    public function recoveryMail(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $status = $this->request->param("status", '', 'htmlspecialchars');
        $user = $this -> getUserInfoByToken();
        $timePostalBusiness = new TimePostalBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $timePostalBusiness -> recoveryLetterById($id, $user['email'], $status)
        );

    }

    public function deleteMail(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $user = $this -> getUserInfoByToken();
        $timePostalBusiness = new TimePostalBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $timePostalBusiness -> deleteLetterById($id, $user['email'])
        );

    }

    public function letterInMailBox(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $timePostalBusiness = new TimePostalBusiness();
        $info = $timePostalBusiness -> getAllPrivateLetter($user['email']);

        return $this->show(
            config("status.success"),
            config("message.success"),
            $info
        );
    }
    
    public function writeLetter(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $data['title'] = $this->request->param("title", '', 'htmlspecialchars');
        $data['letter'] = $this->request->param("letter", '', 'htmlspecialchars');
        $data['delivery_time'] = $this->request->param("delivery_time", '', 'htmlspecialchars');
        $data['status'] = $this->request->param("status", '', 'htmlspecialchars');
        $data['validate'] = $this->request->param("validate", '', 'htmlspecialchars');
        $data['name'] = $user['name'];
        $data['email'] = $user['email'];
        if($data['status'] == "公开信"){
            $data['delivery_time'] = NULL;
        }
        try {
            validate(TimePostalValidate::class) ->scene($data['status']) -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $timePostalBusiness = new TimePostalBusiness();
        $isSuccess = $timePostalBusiness -> writeLetterIntoMailBox($data);
        if($isSuccess == config("status.success")){
            return $this->show(
                config("status.success"),
                config("message.success"),
                NULL
            );
        }
        return $this->show(
            config("status.failed"),
            config("message.failed"),
            NULL
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