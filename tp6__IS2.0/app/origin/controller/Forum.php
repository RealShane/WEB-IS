<?php
namespace app\origin\controller;
use app\common\business\origin\Forum as ForumBusiness;
use app\common\validate\origin\Forum as ForumValidate;
use think\exception\ValidateException;

class Forum extends Auth
{

    public function articleWrite(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $user = $this -> getUserInfoByToken();
        $data['type'] = $this->request->param("type", '', 'htmlspecialchars');
        $data['title'] = $this->request->param("title", '', 'htmlspecialchars');
        $data['content'] = $this->request->param("content", '', 'htmlspecialchars');
        $data['validate'] = $this->request->param("validate", '', 'htmlspecialchars');
        $data['author'] = $user['name'];
        $data['email'] = $user['email'];
        try {
            validate(ForumValidate::class) ->scene('article') -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $forumBusiness = new ForumBusiness();
        $isSuccess = $forumBusiness -> setArticleWrite($data);
        if($isSuccess == 1){
            return $this->show(
                config("status.success"),
                config("message.success"),
                NULL
            );
        }else{
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "未知错误，请联系Shane"
            );
        }

    }

    public function commentSet(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $user = $this -> getUserInfoByToken();
        $data['id'] = $this->request->param("id", '', 'htmlspecialchars');
        $data['comment'] = $this->request->param("comment", '', 'htmlspecialchars');
        $data['validate'] = $this->request->param("validate", '', 'htmlspecialchars');
        $data['name'] = $user['name'];
        $data['email'] = $user['email'];
        try {
            validate(ForumValidate::class) ->scene('comment') -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $forumBusiness = new ForumBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            "成功添加".$forumBusiness -> commentRelateArticleSet($data)."条记录"
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