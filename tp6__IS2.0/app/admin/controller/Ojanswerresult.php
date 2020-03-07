<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use think\facade\View;
class Ojanswerresult extends BaseMethod {

    public function view(){
        return View::fetch('generate/ojanswerresult/ojanswerresult');
    }

    public function viewAddEdit(){
        return View::fetch('generate/ojanswerresult/add_edit');
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
            $this -> Retrieve('oj_answer_result', $key, $value)
        );
    }
    
    public function updateData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','name','student_id','paper_id','answer','mark','status']);
        $backInfo = $this -> Update('oj_answer_result', $id ,$data);
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
            $this -> Delete('oj_answer_result', $id)
        );
    }
    
    public function createData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $data = $this -> request -> param();
        $backInfo = $this -> Create('oj_answer_result', $data);
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
            $this -> throwAll('oj_answer_result')
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
            $this -> batchDelete('oj_answer_result', $ids)
        );
    }
    
    public function export_file(){
        $data = $this -> throwAll('oj_answer_result');
        $user = session(config('admin.session_user'));
        $this -> push('oj_answer_result', $data, $user);
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

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "姓名")->setCellValue('C'.'1', "学号")->setCellValue('D'.'1', "试卷id")->setCellValue('E'.'1', "答题情况")->setCellValue('F'.'1', "分数")->setCellValue('G'.'1', "状态");
    
        foreach($data as $key => $value){

            $num = $key + 2;
            $id = $value['id'];$name = $value['name'];$student_id = $value['student_id'];$paper_id = $value['paper_id'];$answer = $value['answer'];$mark = $value['mark'];$status = $value['status'];
            $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.$num, "$id")->setCellValue('B'.$num, "$name")->setCellValue('C'.$num, "$student_id")->setCellValue('D'.$num, "$paper_id")->setCellValue('E'.$num, "$answer")->setCellValue('F'.$num, "$mark")->setCellValue('G'.$num, "$status");
                
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
        