<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\View;
class Isuniteuser extends BaseMethod {

    public function view(){
        return View::fetch('generate/isuniteuser/isuniteuser');
    }

    public function viewAddEdit(){
        return View::fetch('generate/isuniteuser/add_edit');
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
            $this -> Retrieve('is_unite_user', $key, $value)
        );
    }
    
    public function updateData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','name','student_id','email','password','password_salt','classes_id','forum_comment','user_type','last_login_ip','last_login_time','create_time','update_time','status']);
        $backInfo = $this -> Update('is_unite_user', $id ,$data);
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
            $this -> Delete('is_unite_user', $id)
        );
    }
    
    public function createData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $data = $this -> request -> param();
        $backInfo = $this -> Create('is_unite_user', $data);
        if($backInfo == 1){
            return $this -> show(
                config("status.success"),
                config("message.success"),
                NULL
            );
        }
        return $this -> show(
            config("status.failed"),
            config("message.failed"),
            $backInfo
        );
    }
    
    public function seeAll(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('is_unite_user')
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
            $this -> batchDelete('is_unite_user', $ids)
        );
    }
    
    public function export_file(){
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        $data = $this -> throwAll('is_unite_user');
        if(!empty($key) && !empty($value)){
            $data = $this -> Retrieve('is_unite_user', $key, $value);
        }
        $user = session(config('admin.session_user'));
        $this -> push('is_unite_user', $data, $user);
        $this -> redirect('export');
    }

    public function push($title, $data, $user){

        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->getProperties()->setCreator($user)
            ->setLastModifiedBy($user)
            ->setTitle($title)
            ->setSubject($title)
            ->setDescription($title)
            ->setKeywords("excel")
            ->setCategory("result file");

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "姓名")->setCellValue('C'.'1', "学号")->setCellValue('D'.'1', "邮箱")->setCellValue('E'.'1', "密码")->setCellValue('F'.'1', "密码盐")->setCellValue('G'.'1', "所属班级id")->setCellValue('H'.'1', "论坛是否可评论")->setCellValue('I'.'1', "用户类型")->setCellValue('J'.'1', "上次登陆ip")->setCellValue('K'.'1', "上次登陆时间")->setCellValue('L'.'1', "创建时间")->setCellValue('M'.'1', "更新时间")->setCellValue('N'.'1', "账号状态");
    
        foreach($data as $key => $value){

            $num = $key + 2;
            $id = $value['id'];$name = $value['name'];$student_id = $value['student_id'];$email = $value['email'];$password = $value['password'];$password_salt = $value['password_salt'];$classes_id = $value['classes_id'];$forum_comment = $value['forum_comment'];$user_type = $value['user_type'];$last_login_ip = $value['last_login_ip'];$last_login_time = $value['last_login_time'];$create_time = $value['create_time'];$update_time = $value['update_time'];$status = $value['status'];
            $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.$num, "$id")->setCellValue('B'.$num, "$name")->setCellValue('C'.$num, "$student_id")->setCellValue('D'.$num, "$email")->setCellValue('E'.$num, "$password")->setCellValue('F'.$num, "$password_salt")->setCellValue('G'.$num, "$classes_id")->setCellValue('H'.$num, "$forum_comment")->setCellValue('I'.$num, "$user_type")->setCellValue('J'.$num, "$last_login_ip")->setCellValue('K'.$num, "$last_login_time")->setCellValue('L'.$num, "$create_time")->setCellValue('M'.$num, "$update_time")->setCellValue('N'.$num, "$status");
                
        }

        $objPHPExcel -> getActiveSheet() -> setTitle('User');
        $objPHPExcel -> setActiveSheetIndex(0);

        header('Content-Type: application.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xls');
        $objWriter -> save('php://output');
        exit;
    }

}
        