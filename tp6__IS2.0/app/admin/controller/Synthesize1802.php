<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\View;
class Synthesize1802 extends BaseMethod {

    public function view(){
        return View::fetch('generate/synthesize1802/synthesize1802');
    }

    public function viewAddEdit(){
        return View::fetch('generate/synthesize1802/add_edit');
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
            $this -> Retrieve('synthesize_1802', $key, $value)
        );
    }
    
    public function updateData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','name','student_id','situation','message','zc2018510431','zc2018510432','zc2018510436','zc2018510439','zc2018510444','zc2018510453','zc2018510462','zc2018510464','zc2018510475','zc2018510481','zc2018510482','zc2018510488','zc2018510489','zc2018510495','zc2018510500','zc2018510504','zc2018510510','zc2018510513','zc2018510531','zc2018510533','zc2018510535','zc2018510540','zc2018510542','zc2018510546','zc2018510553','zc2018510554','zc2018510559','zc2018510560','zc2018510563','zc2018510566','zc2018510584','zc2018510589','zc2018510590','zc2018510595','zc2018510597','zc2018510605','zc2018510606','zc2018510613','zc2018510615','zc2018510617','zc2018510622','zc2018510651','zc2018510659','zc2018510660','zc2018510669','zc2018510676','zc2018510684','zc2018510686','zc2018510699','zc2018510716','zc2018510720','zc2018510724','zc2018510726','zc2018510727','zc2018510730','zc2018510731','zc2018510739','zc2018510740','zc2018510744','zc2018510745','zc2018510748','zc2018510750','zc2018512964','final']);
        $backInfo = $this -> Update('synthesize_1802', $id ,$data);
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
            $this -> Delete('synthesize_1802', $id)
        );
    }
    
    public function createData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $data = $this -> request -> param();
        $backInfo = $this -> Create('synthesize_1802', $data);
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
            $this -> throwAll('synthesize_1802')
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
            $this -> batchDelete('synthesize_1802', $ids)
        );
    }
    
    public function export_file(){
        $res['key'] = $this -> request -> param("key", '', 'trim');
        $res['value'] = $this -> request -> param("value", '', 'trim');
        $data = $this -> throwAll('synthesize_1802');
        if(!empty($key) && !empty($value)){
            $data = $this -> retrieveData($res);
        }
        $user = session(config('admin.session_user'));
        $this -> push('synthesize_1802', $data, $user);
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

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "学生姓名")->setCellValue('C'.'1', "学号")->setCellValue('D'.'1', "情况/职位")->setCellValue('E'.'1', "信息")->setCellValue('F'.'1', "刘智斌")->setCellValue('G'.'1', "霍一儒")->setCellValue('H'.'1', "赵天资")->setCellValue('I'.'1', "梁耀辉")->setCellValue('J'.'1', "肖赛")->setCellValue('K'.'1', "翟鹏程")->setCellValue('L'.'1', "江云达")->setCellValue('M'.'1', "朱敬满")->setCellValue('N'.'1', "张二达")->setCellValue('O'.'1', "廉一凡")->setCellValue('P'.'1', "石辉")->setCellValue('Q'.'1', "田亦泽")->setCellValue('R'.'1', "高磊")->setCellValue('S'.'1', "李洋焘")->setCellValue('T'.'1', "申正")->setCellValue('U'.'1', "魏婷婷")->setCellValue('V'.'1', "马瑞")->setCellValue('W'.'1', "吕志萌")->setCellValue('X'.'1', "郑傲梅")->setCellValue('Y'.'1', "宋莹慧")->setCellValue('Z'.'1', "赵琪")->setCellValue('AA'.'1', "姚越华")->setCellValue('AB'.'1', "闫格")->setCellValue('AC'.'1', "郝梦男")->setCellValue('AD'.'1', "王宏婧")->setCellValue('AE'.'1', "史程程")->setCellValue('AF'.'1', "靳维华")->setCellValue('AG'.'1', "刘冬梅")->setCellValue('AH'.'1', "代依洋")->setCellValue('AI'.'1', "张银月")->setCellValue('AJ'.'1', "张萌")->setCellValue('AK'.'1', "白晨阳")->setCellValue('AL'.'1', "李佳琦")->setCellValue('AM'.'1', "白佳薇")->setCellValue('AN'.'1', "常晓露")->setCellValue('AO'.'1', "苗然")->setCellValue('AP'.'1', "白晓璐")->setCellValue('AQ'.'1', "李文丽")->setCellValue('AR'.'1', "刘晓莎")->setCellValue('AS'.'1', "张玉晴")->setCellValue('AT'.'1', "赵梦凡")->setCellValue('AU'.'1', "陈敏")->setCellValue('AV'.'1', "张任愿")->setCellValue('AW'.'1', "郝辰宇")->setCellValue('AX'.'1', "刘琛")->setCellValue('AY'.'1', "郭丹")->setCellValue('AZ'.'1', "田晓彤")->setCellValue('BA'.'1', "马辰婧")->setCellValue('BB'.'1', "李淑静")->setCellValue('BC'.'1', "白雯华")->setCellValue('BD'.'1', "杨毅")->setCellValue('BE'.'1', "刘佳澳")->setCellValue('BF'.'1', "马子涵")->setCellValue('BG'.'1', "王紫婷")->setCellValue('BH'.'1', "张晨旭")->setCellValue('BI'.'1', "方迎澳")->setCellValue('BJ'.'1', "王畔月")->setCellValue('BK'.'1', "陈晓慧")->setCellValue('BL'.'1', "冯胜怡")->setCellValue('BM'.'1', "丁慧慧")->setCellValue('BN'.'1', "王烨文")->setCellValue('BO'.'1', "李雅娴")->setCellValue('BP'.'1', "胡宗宇")->setCellValue('BQ'.'1', "最终评分(平均)");
    
        foreach($data as $key => $value){

            $num = $key + 2;
            $id = $value['id'];$name = $value['name'];$student_id = $value['student_id'];$situation = $value['situation'];$message = $value['message'];$zc2018510431 = $value['zc2018510431'];$zc2018510432 = $value['zc2018510432'];$zc2018510436 = $value['zc2018510436'];$zc2018510439 = $value['zc2018510439'];$zc2018510444 = $value['zc2018510444'];$zc2018510453 = $value['zc2018510453'];$zc2018510462 = $value['zc2018510462'];$zc2018510464 = $value['zc2018510464'];$zc2018510475 = $value['zc2018510475'];$zc2018510481 = $value['zc2018510481'];$zc2018510482 = $value['zc2018510482'];$zc2018510488 = $value['zc2018510488'];$zc2018510489 = $value['zc2018510489'];$zc2018510495 = $value['zc2018510495'];$zc2018510500 = $value['zc2018510500'];$zc2018510504 = $value['zc2018510504'];$zc2018510510 = $value['zc2018510510'];$zc2018510513 = $value['zc2018510513'];$zc2018510531 = $value['zc2018510531'];$zc2018510533 = $value['zc2018510533'];$zc2018510535 = $value['zc2018510535'];$zc2018510540 = $value['zc2018510540'];$zc2018510542 = $value['zc2018510542'];$zc2018510546 = $value['zc2018510546'];$zc2018510553 = $value['zc2018510553'];$zc2018510554 = $value['zc2018510554'];$zc2018510559 = $value['zc2018510559'];$zc2018510560 = $value['zc2018510560'];$zc2018510563 = $value['zc2018510563'];$zc2018510566 = $value['zc2018510566'];$zc2018510584 = $value['zc2018510584'];$zc2018510589 = $value['zc2018510589'];$zc2018510590 = $value['zc2018510590'];$zc2018510595 = $value['zc2018510595'];$zc2018510597 = $value['zc2018510597'];$zc2018510605 = $value['zc2018510605'];$zc2018510606 = $value['zc2018510606'];$zc2018510613 = $value['zc2018510613'];$zc2018510615 = $value['zc2018510615'];$zc2018510617 = $value['zc2018510617'];$zc2018510622 = $value['zc2018510622'];$zc2018510651 = $value['zc2018510651'];$zc2018510659 = $value['zc2018510659'];$zc2018510660 = $value['zc2018510660'];$zc2018510669 = $value['zc2018510669'];$zc2018510676 = $value['zc2018510676'];$zc2018510684 = $value['zc2018510684'];$zc2018510686 = $value['zc2018510686'];$zc2018510699 = $value['zc2018510699'];$zc2018510716 = $value['zc2018510716'];$zc2018510720 = $value['zc2018510720'];$zc2018510724 = $value['zc2018510724'];$zc2018510726 = $value['zc2018510726'];$zc2018510727 = $value['zc2018510727'];$zc2018510730 = $value['zc2018510730'];$zc2018510731 = $value['zc2018510731'];$zc2018510739 = $value['zc2018510739'];$zc2018510740 = $value['zc2018510740'];$zc2018510744 = $value['zc2018510744'];$zc2018510745 = $value['zc2018510745'];$zc2018510748 = $value['zc2018510748'];$zc2018510750 = $value['zc2018510750'];$zc2018512964 = $value['zc2018512964'];$final = $value['final'];
            $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.$num, "$id")->setCellValue('B'.$num, "$name")->setCellValue('C'.$num, "$student_id")->setCellValue('D'.$num, "$situation")->setCellValue('E'.$num, "$message")->setCellValue('F'.$num, "$zc2018510431")->setCellValue('G'.$num, "$zc2018510432")->setCellValue('H'.$num, "$zc2018510436")->setCellValue('I'.$num, "$zc2018510439")->setCellValue('J'.$num, "$zc2018510444")->setCellValue('K'.$num, "$zc2018510453")->setCellValue('L'.$num, "$zc2018510462")->setCellValue('M'.$num, "$zc2018510464")->setCellValue('N'.$num, "$zc2018510475")->setCellValue('O'.$num, "$zc2018510481")->setCellValue('P'.$num, "$zc2018510482")->setCellValue('Q'.$num, "$zc2018510488")->setCellValue('R'.$num, "$zc2018510489")->setCellValue('S'.$num, "$zc2018510495")->setCellValue('T'.$num, "$zc2018510500")->setCellValue('U'.$num, "$zc2018510504")->setCellValue('V'.$num, "$zc2018510510")->setCellValue('W'.$num, "$zc2018510513")->setCellValue('X'.$num, "$zc2018510531")->setCellValue('Y'.$num, "$zc2018510533")->setCellValue('Z'.$num, "$zc2018510535")->setCellValue('AA'.$num, "$zc2018510540")->setCellValue('AB'.$num, "$zc2018510542")->setCellValue('AC'.$num, "$zc2018510546")->setCellValue('AD'.$num, "$zc2018510553")->setCellValue('AE'.$num, "$zc2018510554")->setCellValue('AF'.$num, "$zc2018510559")->setCellValue('AG'.$num, "$zc2018510560")->setCellValue('AH'.$num, "$zc2018510563")->setCellValue('AI'.$num, "$zc2018510566")->setCellValue('AJ'.$num, "$zc2018510584")->setCellValue('AK'.$num, "$zc2018510589")->setCellValue('AL'.$num, "$zc2018510590")->setCellValue('AM'.$num, "$zc2018510595")->setCellValue('AN'.$num, "$zc2018510597")->setCellValue('AO'.$num, "$zc2018510605")->setCellValue('AP'.$num, "$zc2018510606")->setCellValue('AQ'.$num, "$zc2018510613")->setCellValue('AR'.$num, "$zc2018510615")->setCellValue('AS'.$num, "$zc2018510617")->setCellValue('AT'.$num, "$zc2018510622")->setCellValue('AU'.$num, "$zc2018510651")->setCellValue('AV'.$num, "$zc2018510659")->setCellValue('AW'.$num, "$zc2018510660")->setCellValue('AX'.$num, "$zc2018510669")->setCellValue('AY'.$num, "$zc2018510676")->setCellValue('AZ'.$num, "$zc2018510684")->setCellValue('BA'.$num, "$zc2018510686")->setCellValue('BB'.$num, "$zc2018510699")->setCellValue('BC'.$num, "$zc2018510716")->setCellValue('BD'.$num, "$zc2018510720")->setCellValue('BE'.$num, "$zc2018510724")->setCellValue('BF'.$num, "$zc2018510726")->setCellValue('BG'.$num, "$zc2018510727")->setCellValue('BH'.$num, "$zc2018510730")->setCellValue('BI'.$num, "$zc2018510731")->setCellValue('BJ'.$num, "$zc2018510739")->setCellValue('BK'.$num, "$zc2018510740")->setCellValue('BL'.$num, "$zc2018510744")->setCellValue('BM'.$num, "$zc2018510745")->setCellValue('BN'.$num, "$zc2018510748")->setCellValue('BO'.$num, "$zc2018510750")->setCellValue('BP'.$num, "$zc2018512964")->setCellValue('BQ'.$num, "$final");
                
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
        