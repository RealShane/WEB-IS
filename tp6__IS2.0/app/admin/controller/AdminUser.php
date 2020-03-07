<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/12 下午8:24
 *
 */


namespace app\admin\controller;


use app\common\business\admin\AdminUser as AdminUserBusiness;
use app\common\business\lib\BaseMethod;
use app\common\validate\admin\AdminUser as AdminUserValidate;


class AdminUser extends BaseMethod
{




    /**添加管理员
     * @return string|\think\response\Json
     * @throws \Exception
     */
    public function addAdminUser(){

        if(!(request()->isPost())){
            return back_admin_index();
        }
        //数据获取
        $data["username"] = $this -> request -> param("username", '', 'trim');
        $data["password"] = $this -> request -> param("password", '', 'trim');
        $validate = validate(AdminUserValidate::class);

        if(!$validate -> check($data)){

            return $this -> show(
                config("status.error"),
                config("message.no_key"),
                NULL
            );
        }
        $adminUserBusiness = new AdminUserBusiness();
        $data = $adminUserBusiness -> passwordAddSalt($data);
        $res = $adminUserBusiness -> add($data);

        if($res == "用户名重复"){

            return $this -> show(
                config("status.failed"),
                config("message.name_multiple"),
                $res
            );
        }

        return $this -> show(
            config("status.success"),
            config("message.success"),
            $res
        );

    }

    public function retrieveData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> Retrieve('z_admin_user', $key, $value)
        );
    }

    public function updateData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','username','password','password_salt','last_login_ip','last_login_time','create_time','update_time']);
        $backInfo = $this -> Update('z_admin_user', $id ,$data);
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "更改了".$backInfo."条数据"
        );
    }

    public function deleteData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> Delete('z_admin_user', $id)
        );
    }

    public function seeAll(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_admin_user')
        );
    }

    public function batchDeleteData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $ids = $this -> request -> param("ids", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> batchDelete('z_admin_user', $ids)
        );
    }

    public function export_file(){
        $data = $this -> throwAll('z_admin_user');
        $user = session(config('admin.session_user'));
        $this -> push('z_admin_user', $data, $user);
        $this -> redirect('export');
    }

    public function push($title, $data, $user){

        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator($user)
            ->setLastModifiedBy($user)
            ->setTitle($title)
            ->setSubject($title)
            ->setDescription($title)
            ->setKeywords("excel")
            ->setCategory("result file");

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "用户名")->setCellValue('C'.'1', "密码")->setCellValue('D'.'1', "密码盐")->setCellValue('E'.'1', "上次登陆IP")->setCellValue('F'.'1', "上次登陆时间")->setCellValue('G'.'1', "创建时间")->setCellValue('H'.'1', "更新时间");

        foreach($data as $key => $value){

            $num = $key + 2;
            $id = $value['id'];$username = $value['username'];$password = $value['password'];$password_salt = $value['password_salt'];$last_login_ip = $value['last_login_ip'];$last_login_time = $value['last_login_time'];$create_time = $value['create_time'];$update_time = $value['update_time'];
            $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.$num, "$id")->setCellValue('B'.$num, "$username")->setCellValue('C'.$num, "$password")->setCellValue('D'.$num, "$password_salt")->setCellValue('E'.$num, "$last_login_ip")->setCellValue('F'.$num, "$last_login_time")->setCellValue('G'.$num, "$create_time")->setCellValue('H'.$num, "$update_time");

        }

        $objPHPExcel -> getActiveSheet() -> setTitle('User');
        $objPHPExcel -> setActiveSheetIndex(0);

        header('Content-Type: application.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter -> save('php://output');
        exit;
    }

}