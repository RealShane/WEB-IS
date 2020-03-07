<?php
namespace app\origin\controller;
use app\common\business\origin\Synthesize as SynthesizeBusiness;
use app\common\validate\origin\Synthesize as SynthesizeValidate;
use think\exception\ValidateException;

class Synthesize extends Auth
{

    public function signPKBW(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $data['pin_kun_message'] = $this->request->param("pin_kun_message", '', 'htmlspecialchars');
        $data['pin_kun_situation'] = $this->request->param("pin_kun_situation", '', 'htmlspecialchars');
        $data['ban_wei_message'] = $this->request->param("ban_wei_message", '', 'htmlspecialchars');
        $data['ban_wei_situation'] = $this->request->param("ban_wei_situation", '', 'htmlspecialchars');
        $data['type'] = $this->request->param("type", '', 'htmlspecialchars');
        $data['user_id'] = $user['id'];
        try {
            validate(SynthesizeValidate::class) ->scene($data['type']) -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $synthesizeBusiness = new SynthesizeBusiness();
        $info = $synthesizeBusiness -> signInfo($data);
        if($info == config("status.function_close")){
            return $this->show(
                config("status.failed"),
                config("message.function_close"),
                config("message.function_close")
            );
        }else if($info == config("status.sign_exist")){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                config("message.sign_exist")
            );
        }else{
            return $this->show(
                config("status.success"),
                config("message.success"),
                "修改了".$info."条信息"
            );
        }
    }

    public function score(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $data['type'] = $this->request->param("type", '', 'htmlspecialchars');
        $data['target'] = $this->request->param("target", '', 'htmlspecialchars');
        $data['mark'] = $this->request->param("mark", '', 'htmlspecialchars');
        $data['user_id'] = $user['id'];
        try {
            validate(SynthesizeValidate::class) ->scene($data['type']) -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $synthesizeBusiness = new SynthesizeBusiness();
        $info = $synthesizeBusiness -> markScore($data);

        if($info == config("status.function_close")){
            return $this->show(
                config("status.failed"),
                config("message.function_close"),
                config("message.function_close")
            );
        }else if($info == config("status.failed")){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "type类型有误"
            );
        }else{
            return $this->show(
                config("status.success"),
                config("message.success"),
                "修改了".$info."条信息"
            );
        }

    }



    public function targetStudent(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $id = $this->request->param("target", '', 'htmlspecialchars');
        $type = $this->request->param("type", '', 'htmlspecialchars');
        $synthesizeBusiness = new SynthesizeBusiness();
        if($type == "zong_ce"){
            $info = $synthesizeBusiness -> getTargetStudent($id);
        }
        if($type == "ban_wei" || $type == "pin_kun"){
            $info = $synthesizeBusiness -> getTargetStudentFromSynthesize($id, $user['classes_id']);
        }

        if($info == config("message.failed")){
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                NULL
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $info['name']
        );
    }

    public function allStudent(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $id = $user['id'];
        $type = $this->request->param("type", '', 'htmlspecialchars');
        $synthesizeBusiness = new SynthesizeBusiness();
        if($type == "zong_ce"){
            $info = $synthesizeBusiness -> getAllStudent($id);
        }else{
            $info = $synthesizeBusiness -> getAllStudentExceptZongCe($id);
        }
        if($info == config("message.failed")){
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                NULL
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $info
        );
    }

    public function getUserInfoByToken(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $token = request() -> header('access-token');
        return cache(config("redis.token_pre").$token);
    }

	public function tokenCheck(){
        return $this->show(
            config("status.success"),
            config("message.success"),
            "token鉴定成功！"
        );
	}

}






