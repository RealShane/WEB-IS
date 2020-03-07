<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/30 下午3:10
 *
 */


namespace app\common\business\origin;


use think\db\exception\DbException;
use think\facade\Db;

class Forum
{

    public function setArticleWrite($res){
        $data = [
            'title' => $res['title'],
            'content' => $res['content'],
            'author' => $res['author'],
            'email' => $res['email'],
            'type' => $res['type'],
            'create_time' => time(),
            'update_time' => time(),
            'status' => "不通过",
        ];
        return Db::name('forum_article')->strict(false)->insert($data);
    }

    public function getArticleAllComment($id){
        try {
            $articles = Db::table('forum_comment') -> where('article_with', $id) -> where('status', "启用") -> select();
            $res = [];
            foreach($articles as $key){
                $res[] = [
                    'id' => $key['id'],
                    'name' => $key['name'],
                    'comment' => $key['comment'],
                    'create_time' => $key['create_time']
                ];
            }
            return array_reverse($res);
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function commentRelateArticleSet($res){
        try {

            $data = [
                'name' => $res['name'],
                'email' => $res['email'],
                'comment' => $res['comment'],
                'article_with' => $res['id'],
                'create_time' => time(),
                'status' => "启用",
            ];
            return Db::name('forum_comment')->strict(false)->insert($data);
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function getArticleById($id){
        try {
            return Db::table('forum_article') -> where('id', $id) -> find();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function getAllArticleByModule($id){
        try {
            $isExist = $this -> getModuleById($id);
            if(empty($isExist)){
                return NULL;
            }
            $articles = Db::table('forum_article') -> where('type', $id) -> where('status', "通过") -> select();
            $res = [];
            foreach($articles as $key){
                $res[] = [
                    'id' => $key['id'],
                    'title' => $key['title'],
                    'author' => $key['author'],
                    'create_time' => $key['create_time'],
                ];
            }
            return array_reverse($res);
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function getModuleById($id){
        if(empty($id)){
            return config("status.failed");
        }
        try {
            return Db::table('forum_module') -> where('id', $id) -> where('status', "启用") -> find();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function getAllModule(){
        try {
            return Db::table('forum_module') -> where('status', "启用") -> select();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

}