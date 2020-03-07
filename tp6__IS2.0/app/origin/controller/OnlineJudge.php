<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/2/2 下午5:51
 *
 */


namespace app\origin\controller;
use app\common\business\origin\OnlineJudge as OnlineJudgeBusiness;
use app\common\validate\origin\OnlineJudge as OnlineJudgeValidate;
use think\exception\ValidateException;


class OnlineJudge extends Auth
{

    public function personalPapers(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $isRightClasses = $this -> isCommunicationEngineering($user['classes_id']);
        if(!$isRightClasses){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "本功能只开放17/18通信工程！"
            );
        }
        $onlineJudgeBusiness = new OnlineJudgeBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $onlineJudgeBusiness -> getPersonalPapers($user)
        );
    }

    public function rankList(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $isRightClasses = $this -> isCommunicationEngineering($user['classes_id']);
        if(!$isRightClasses){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "本功能只开放17/18通信工程！"
            );
        }
        $onlineJudgeBusiness = new OnlineJudgeBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $onlineJudgeBusiness -> rankListSort($user)
        );
    }

    public function doTargetPaper(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $isRightClasses = $this -> isCommunicationEngineering($user['classes_id']);
        if(!$isRightClasses){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "本功能只开放17/18通信工程！"
            );
        }
        $data['paper_id'] = $this->request->param("target", '', 'htmlspecialchars');
        $data['single_answer'] = $this->request->param("single_answer", '', 'htmlspecialchars');
        $data['multiple_answer'] = $this->request->param("multiple_answer", '', 'htmlspecialchars');
        $data['judge_answer'] = $this->request->param("judge_answer", '', 'htmlspecialchars');
        $data['status'] = $this->request->param("status", '', 'htmlspecialchars');
        $data['name'] = $user['name'];
        $data['student_id'] = $user['student_id'];
        try {
            validate(OnlineJudgeValidate::class) -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }

        $onlineJudgeBusiness = new OnlineJudgeBusiness();
        $info = $onlineJudgeBusiness -> doTheTargetPaper($data);
        if(gettype($info) == 'integer'){
            if($info == config('status.failed')){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "状态错误或答案个数大于正确答案个数！"
                );
            }else if($info == config('status.deadline_over')){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    config('message.deadline_over')
                );
            }else if($info == config('status.sign_exist')){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "已判过题无法再更改或判题！"
                );
            }
        }
        if($info){
            return $this->show(
                config("status.success"),
                config("message.success"),
                $info
            );
        }
    }

    public function getTargetPaper(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $isRightClasses = $this -> isCommunicationEngineering($user['classes_id']);
        if(!$isRightClasses){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "本功能只开放17/18通信工程！"
            );
        }
        $data['paper_id'] = $this->request->param("target", '', 'htmlspecialchars');
        $data['student_id'] = $user['student_id'];
        $onlineJudgeBusiness = new OnlineJudgeBusiness();
        $info = $onlineJudgeBusiness -> getTheTargetPaper($data);
        if($info == config('status.deadline_over')){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "该试卷截止日期已过！"
            );
        }
        if($info == config('status.not_begin_time')){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "暂未开始！"
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $info
        );
    }

    public function getAllPapers(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $id = $this->request->param("target", '', 'htmlspecialchars');
        $user = $this -> getUserInfoByToken();
        $isRightClasses = $this -> isCommunicationEngineering($user['classes_id']);
        if(!$isRightClasses){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "本功能只开放17/18通信工程！"
            );
        }
        $onlineJudgeBusiness = new OnlineJudgeBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $onlineJudgeBusiness -> getAllThePapers($id)
        );

    }

    public function getAllCatalogue(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $user = $this -> getUserInfoByToken();
        $isRightClasses = $this -> isCommunicationEngineering($user['classes_id']);
        if(!$isRightClasses){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "本功能只开放17/18通信工程！"
            );
        }
        $onlineJudgeBusiness = new OnlineJudgeBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $onlineJudgeBusiness -> getAllTheCatalogues()
        );
    }

    public function isCommunicationEngineering($classes){
        if($classes == 1804 || $classes == 1704){
            return true;
        }
        return false;
    }

    public function getUserInfoByToken(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $token = request() -> header('access-token');
        return cache(config("redis.token_pre").$token);
    }

}