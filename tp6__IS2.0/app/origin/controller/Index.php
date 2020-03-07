<?php
namespace app\origin\controller;
use app\BaseController;
use think\facade\View;
use app\common\business\origin\TimePostal as TimePostalBusiness;
use app\common\business\origin\Forum as ForumBusiness;
use app\common\business\origin\UniteLogin as UniteLoginBusiness;
use app\common\validate\origin\UniteLogin as UniteLoginValidate;
use think\exception\ValidateException;

class Index extends BaseController
{

    /*------------Public---------------*/
    public function index(){
        return View::fetch('index/index');//渲染视图->主页
    }

    public function login(){
        return View::fetch('index/login');//渲染视图->主页
    }

    public function register(){
        return View::fetch('index/register');//渲染视图->注册
    }

    public function active(){
        return View::fetch('index/active');//渲染视图->激活注册
    }

    public function personal(){
        return View::fetch('index/personal');//渲染视图->个人主页
    }
    /*------------Public---------------*/

    /*------------SecondClass---------------*/
	public function secondClassIndex(){
        return View::fetch('second_class/index');//渲染视图->第二课堂主页
    }

    public function secondClassSign(){
        return View::fetch('second_class/sign');//渲染视图->第二课堂报名
    }

    public function secondClassSearch(){
        return View::fetch('second_class/search');//渲染视图->第二课堂查询报名情况
    }

    /*------------SecondClass---------------*/

    /*------------Synthesize---------------*/
    public function synthesizeIndex(){
        return View::fetch('synthesize/index');//渲染视图->综合测评主页
    }

    public function synthesizeScore(){
        return View::fetch('synthesize/score');//渲染视图->综合测评打分
    }

    public function synthesizeSign(){
        return View::fetch('synthesize/sign');//渲染视图->综合测评报名
    }
    /*------------Synthesize---------------*/



    /*------------TimePostal---------------*/


    public function timePostalIndex(){
        return View::fetch('time_postal/index');//渲染视图->时光邮箱主页（公开信）
    }

    public function timePostalWriteLetter(){
        return View::fetch('time_postal/write_letter');//渲染视图->时光邮箱写信
    }

    public function timePostalMailBox(){
        return View::fetch('time_postal/mailbox');//渲染视图->时光邮箱信箱
    }

    public function timePostalOpenLetter(){
        return View::fetch('time_postal/open_letter');//渲染视图->时光邮箱公开信
    }

    public function sendPrivateMail(){
        $timePostalBusiness = new TimePostalBusiness();
        $timePostalBusiness -> sendPrivateLetter();
        exit;
    }

    public function getTargetMail(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $timePostalBusiness = new TimePostalBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $timePostalBusiness -> getTargetLetter($id)
        );
    }

    public function getAllOpenMail(){
        if (!(request()->isPost())) {
            return back_origin_index();
        }
        $timePostalBusiness = new TimePostalBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $timePostalBusiness -> getAllOpenLetter()
        );
    }

    /*------------TimePostal---------------*/


    /*------------OnlineJudge---------------*/

    public function onlineJudgeIndex(){
        return View::fetch('online_judge/index');//渲染视图->通信答题主页
    }

    public function onlineJudgePaperList(){
        return View::fetch('online_judge/paper_list');//渲染视图->通信答题试卷列表
    }

    public function onlineJudgePaper(){
        return View::fetch('online_judge/paper');//渲染视图->通信答题答题
    }

    public function onlineJudgePersonalPaper(){
        return View::fetch('online_judge/personal_paper');//渲染视图->通信答题做过的试卷
    }

    public function onlineJudgeCatalogue(){
        return View::fetch('online_judge/catalogue');//渲染视图->通信答题试卷目录
    }
    /*------------OnlineJudge---------------*/


    /*------------Forum---------------*/

    public function forumIndex(){
        return View::fetch('forum/index');//渲染视图->论坛主页
    }

    public function forumArticleList(){
        return View::fetch('forum/article_list');//渲染视图->文章列表
    }

    public function forumArticle(){
        return View::fetch('forum/article');//渲染视图->文章
    }

    public function forumArticleWrite(){
        return View::fetch('forum/article_write');//渲染视图->写文章
    }

    public function forumGetAllComment(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $forumBusiness = new ForumBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $forumBusiness -> getArticleAllComment($id)
        );
    }

    public function forumGetArticle(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $forumBusiness = new ForumBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $forumBusiness -> getArticleById($id)
        );
    }

    public function forumGetArticleList(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $forumBusiness = new ForumBusiness();
        $isSuccess = $forumBusiness -> getAllArticleByModule($id);
        if(empty($isSuccess)){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "你访问的模块不存在！"
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $isSuccess
        );
    }

    public function forumGetTargetModule(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $id = $this->request->param("id", '', 'htmlspecialchars');
        $forumBusiness = new ForumBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $forumBusiness -> getModuleById($id)
        );
    }

    public function forumGetAllModule(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $forumBusiness = new ForumBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $forumBusiness -> getAllModule()
        );
    }

    /*------------Forum---------------*/



    /*------------Register---------------*/

    public function activeGetClasses(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $uniteLoginBusiness = new UniteLoginBusiness();
        return $this->show(
            config("status.success"),
            config("message.success"),
            $uniteLoginBusiness -> getAllClasses()
        );
    }

    public function activeRegister(){
        $token = $this -> request -> header('active-token');
        $redisEmail = cache(config("redis.active_pre").$token);
        if(!$redisEmail){
            return false;
        }
        $uniteLoginBusiness = new UniteLoginBusiness();
        $isSuccess = $uniteLoginBusiness -> activeRegisterByEmail($redisEmail['email']);
        if($isSuccess == config("status.failed")){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "未知原因，激活失败，请联系Shane手动激活！"
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            "激活成功，祝体验愉快！"
        );
    }

    public function uniteRegister(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $data['name'] = $this->request->param("name", '', 'htmlspecialchars');
        $data['student_id'] = $this->request->param("student_id", '', 'htmlspecialchars');
        $data['email'] = $this->request->param("email", '', 'htmlspecialchars');
        $data['password'] = $this->request->param("password", '', 'htmlspecialchars');
        $data['classes_id'] = $this->request->param("classes_id", '', 'htmlspecialchars');
        $data['validate'] = $this->request->param("validate", '', 'htmlspecialchars');
        try {
            validate(UniteLoginValidate::class) -> scene('register') -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $uniteLoginBusiness = new UniteLoginBusiness();
        $isSuccess = $uniteLoginBusiness -> uniteLoginRegister($data);
        if($isSuccess == config("status.sign_exist")){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                "姓名或学号或邮箱已被注册，如有问题请联系Shane！"
            );
        }
        return $this->show(
            config("status.success"),
            config("message.success"),
            $isSuccess
        );
    }


    /*------------Register---------------*/


    /*------------Login---------------*/

    public function uniteQuit(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $token = request() -> header('access-token');
        if(empty($token)){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                NULL
            );
        }
        $quitToken = cache(config("redis.token_pre").$token);
        if(empty($quitToken)){
            return $this->show(
                config("status.success"),
                config("message.success"),
                NULL
            );
        }
        $isQuit = cache(config("redis.token_pre").$token, NULL);
        if($isQuit){
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

    public function uniteLogin(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $data['password'] = $this->request->param("password", '', 'htmlspecialchars');
        $data['email'] = $this->request->param("email", '', 'htmlspecialchars');
        $data['random'] = $this->request->param("random", '', 'htmlspecialchars');
        $data['validate'] = $this->request->param("validate", '', 'htmlspecialchars');
        $login_type = $this->request->param("login_type", '', 'htmlspecialchars');
        try {
            validate(UniteLoginValidate::class) -> scene($login_type) -> check($data);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }
        $uniteLoginBusiness = new UniteLoginBusiness();
        if($login_type == "type_password"){
            $isSuccess = $uniteLoginBusiness -> loginByPassword($data);
            if($isSuccess == config("status.none_user")){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "用户不存在！"
                );
            }
            if($isSuccess == config("status.failed")){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "密码填写有误！"
                );
            }
            if($isSuccess == config("status.forbidden_user")){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "账号被禁用，请联系Shane启用！"
                );
            }

            return $this->show(
                config("status.success"),
                config("message.success"),
                $isSuccess
            );
        }
        if($login_type == "type_email"){

            $isSuccess = $uniteLoginBusiness -> loginByEmail($data);

            if($isSuccess == config("status.none_user")){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "用户不存在！"
                );
            }
            if($isSuccess == config("status.failed")){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "网络原因验证码生成失败或填写有误！"
                );
            }
            if($isSuccess == config("status.forbidden_user")){
                return $this->show(
                    config("status.failed"),
                    config("message.failed"),
                    "账号被禁用，请联系Shane启用！"
                );
            }

            return $this->show(
                config("status.success"),
                config("message.success"),
                $isSuccess
            );
        }



    }

    public function sendEmailRandom(){
        if (!(request()->isPost())) {
            return back_unite_login();
        }
        $validate['email'] = $this->request->param("email", '', 'htmlspecialchars');
        $validate['validate'] = $this->request->param("validate", '', 'htmlspecialchars');
        try {
            validate(UniteLoginValidate::class) -> scene('send_email') -> check($validate);
        } catch (ValidateException $exception) {
            return $this->show(
                config("status.failed"),
                config("message.no_key"),
                $exception->getMessage()
            );
        }

        $uniteLoginBusiness = new UniteLoginBusiness();
        $isSuccess = $uniteLoginBusiness -> sendRandom($validate['email']);

        if($isSuccess == config("status.success")){
            return $this->show(
                config("status.success"),
                config("message.success"),
                NULL
            );
        }

        if($isSuccess == config("status.failed")){
            return $this->show(
                config("status.failed"),
                config("message.failed"),
                config("message.failed_by_net")
            );
        }
    }

    /*------------Login---------------*/




}
