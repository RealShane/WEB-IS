<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\View;
class Ojsetspaper extends BaseMethod {

    public function view(){
        return View::fetch('generate/ojsetspaper/ojsetspaper');
    }

    public function viewAddEdit(){
        return View::fetch('generate/ojsetspaper/add_edit');
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
            $this -> Retrieve('oj_sets_paper', $key, $value)
        );
    }
    
    public function updateData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','head','single','multiple','judge','single_answer','multiple_answer','judge_answer','single_analysis','multiple_analysis','judge_analysis','bornline','deadline','status']);
        $backInfo = $this -> Update('oj_sets_paper', $id ,$data);
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
            $this -> Delete('oj_sets_paper', $id)
        );
    }
    
    public function createData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $data = $this -> request -> param();
        $backInfo = $this -> Create('oj_sets_paper', $data);
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
            $this -> throwAll('oj_sets_paper')
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
            $this -> batchDelete('oj_sets_paper', $ids)
        );
    }
    
    public function export_file(){
        $data = $this -> throwAll('oj_sets_paper');
        $user = session(config('admin.session_user'));
        $this -> push('oj_sets_paper', $data, $user);
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

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "试卷名")->setCellValue('C'.'1', "单选")->setCellValue('D'.'1', "多选")->setCellValue('E'.'1', "判断")->setCellValue('F'.'1', "单选答案")->setCellValue('G'.'1', "多选答案")->setCellValue('H'.'1', "判断答案")->setCellValue('I'.'1', "单选解析")->setCellValue('J'.'1', "多选解析")->setCellValue('K'.'1', "判断解析")->setCellValue('L'.'1', "开始时间")->setCellValue('M'.'1', "截止时间")->setCellValue('N'.'1', "状态");
    
        foreach($data as $key => $value){

            $num = $key + 2;
            $id = $value['id'];$head = $value['head'];$single = $value['single'];$multiple = $value['multiple'];$judge = $value['judge'];$single_answer = $value['single_answer'];$multiple_answer = $value['multiple_answer'];$judge_answer = $value['judge_answer'];$single_analysis = $value['single_analysis'];$multiple_analysis = $value['multiple_analysis'];$judge_analysis = $value['judge_analysis'];$bornline = $value['bornline'];$deadline = $value['deadline'];$status = $value['status'];
            $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.$num, "$id")->setCellValue('B'.$num, "$head")->setCellValue('C'.$num, "$single")->setCellValue('D'.$num, "$multiple")->setCellValue('E'.$num, "$judge")->setCellValue('F'.$num, "$single_answer")->setCellValue('G'.$num, "$multiple_answer")->setCellValue('H'.$num, "$judge_answer")->setCellValue('I'.$num, "$single_analysis")->setCellValue('J'.$num, "$multiple_analysis")->setCellValue('K'.$num, "$judge_analysis")->setCellValue('L'.$num, "$bornline")->setCellValue('M'.$num, "$deadline")->setCellValue('N'.$num, "$status");
                
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
        