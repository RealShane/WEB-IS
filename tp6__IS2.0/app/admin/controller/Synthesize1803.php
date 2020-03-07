<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\facade\View;
class Synthesize1803 extends BaseMethod {

    public function view(){
        return View::fetch('generate/synthesize1803/synthesize1803');
    }

    public function viewAddEdit(){
        return View::fetch('generate/synthesize1803/add_edit');
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
            $this -> Retrieve('synthesize_1803', $key, $value)
        );
    }
    
    public function updateData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','name','student_id','situation','message','zc2018510429','zc2018510435','zc2018510438','zc2018510447','zc2018510448','zc2018510450','zc2018510452','zc2018510456','zc2018510458','zc2018510463','zc2018510465','zc2018510469','zc2018510479','zc2018510490','zc2018510496','zc2018510498','zc2018510499','zc2018510520','zc2018510524','zc2018510534','zc2018510537','zc2018510541','zc2018510543','zc2018510552','zc2018510564','zc2018510568','zc2018510569','zc2018510579','zc2018510588','zc2018510591','zc2018510592','zc2018510594','zc2018510596','zc2018510600','zc2018510601','zc2018510616','zc2018510618','zc2018510620','zc2018510625','zc2018510628','zc2018510636','zc2018510640','zc2018510643','zc2018510647','zc2018510664','zc2018510666','zc2018510668','zc2018510671','zc2018510672','zc2018510679','zc2018510681','zc2018510691','zc2018510695','zc2018510696','zc2018510705','zc2018510708','zc2018510713','zc2018510721','zc2018510722','zc2018510728','zc2018510729','zc2018510752','zc2018510753','zc2018510755','final']);
        $backInfo = $this -> Update('synthesize_1803', $id ,$data);
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
            $this -> Delete('synthesize_1803', $id)
        );
    }
    
    public function createData(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        $data = $this -> request -> param();
        $backInfo = $this -> Create('synthesize_1803', $data);
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
            $this -> throwAll('synthesize_1803')
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
            $this -> batchDelete('synthesize_1803', $ids)
        );
    }
    
    public function export_file(){
        $data = $this -> throwAll('synthesize_1803');
        $user = session(config('admin.session_user'));
        $this -> push('synthesize_1803', $data, $user);
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

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "姓名")->setCellValue('C'.'1', "学号")->setCellValue('D'.'1', "	情况/职位")->setCellValue('E'.'1', "信息")->setCellValue('F'.'1', "顾梓琨")->setCellValue('G'.'1', "蒋官正")->setCellValue('H'.'1', "汲恒龙")->setCellValue('I'.'1', "李家哲")->setCellValue('J'.'1', "刘恺征")->setCellValue('K'.'1', "李腾飞")->setCellValue('L'.'1', "史冰洁")->setCellValue('M'.'1', "吴生祥")->setCellValue('N'.'1', "房晓闯")->setCellValue('O'.'1', "郭紫阳")->setCellValue('P'.'1', "张一斌")->setCellValue('Q'.'1', "史佳晟")->setCellValue('R'.'1', "岳恺峻")->setCellValue('S'.'1', "闫禹杉")->setCellValue('T'.'1', "刘迎")->setCellValue('U'.'1', "段非凡")->setCellValue('V'.'1', "王一凡")->setCellValue('W'.'1', "单烁")->setCellValue('X'.'1', "闫瑾")->setCellValue('Y'.'1', "宋晶晶")->setCellValue('Z'.'1', "王晶晶")->setCellValue('AA'.'1', "李若彤")->setCellValue('AB'.'1', "逯辰祺")->setCellValue('AC'.'1', "戴金宏")->setCellValue('AD'.'1', "马佳琪")->setCellValue('AE'.'1', "赵轩艺")->setCellValue('AF'.'1', "戈红玉")->setCellValue('AG'.'1', "康佳璇")->setCellValue('AH'.'1', "梁梦超")->setCellValue('AI'.'1', "周水漫")->setCellValue('AJ'.'1', "李伊丹")->setCellValue('AK'.'1', "周思佳")->setCellValue('AL'.'1', "王硕菲")->setCellValue('AM'.'1', "蔡静美")->setCellValue('AN'.'1', "段亦婷")->setCellValue('AO'.'1', "李欣阅")->setCellValue('AP'.'1', "张怡凡")->setCellValue('AQ'.'1', "郑亚彤")->setCellValue('AR'.'1', "纪思萌")->setCellValue('AS'.'1', "刘湘")->setCellValue('AT'.'1', "袁佳怡")->setCellValue('AU'.'1', "彭慧敏")->setCellValue('AV'.'1', "闫伊明")->setCellValue('AW'.'1', "李佳琪")->setCellValue('AX'.'1', "毕令琪")->setCellValue('AY'.'1', "霍星潼")->setCellValue('AZ'.'1', "石祎玮")->setCellValue('BA'.'1', "张倩")->setCellValue('BB'.'1', "李晨颍")->setCellValue('BC'.'1', "单梦凡")->setCellValue('BD'.'1', "张颖月")->setCellValue('BE'.'1', "李佳惠")->setCellValue('BF'.'1', "王坦")->setCellValue('BG'.'1', "张宁")->setCellValue('BH'.'1', "梁家璇")->setCellValue('BI'.'1', "崔苗苗")->setCellValue('BJ'.'1', "李晓雯")->setCellValue('BK'.'1', "路谢欢")->setCellValue('BL'.'1', "孟妍")->setCellValue('BM'.'1', "魏明月")->setCellValue('BN'.'1', "何乾乾")->setCellValue('BO'.'1', "魏叶茹")->setCellValue('BP'.'1', "陈涵")->setCellValue('BQ'.'1', "马建云")->setCellValue('BR'.'1', "最终评分(平均)");
    
        foreach($data as $key => $value){

            $num = $key + 2;
            $id = $value['id'];$name = $value['name'];$student_id = $value['student_id'];$situation = $value['situation'];$message = $value['message'];$zc2018510429 = $value['zc2018510429'];$zc2018510435 = $value['zc2018510435'];$zc2018510438 = $value['zc2018510438'];$zc2018510447 = $value['zc2018510447'];$zc2018510448 = $value['zc2018510448'];$zc2018510450 = $value['zc2018510450'];$zc2018510452 = $value['zc2018510452'];$zc2018510456 = $value['zc2018510456'];$zc2018510458 = $value['zc2018510458'];$zc2018510463 = $value['zc2018510463'];$zc2018510465 = $value['zc2018510465'];$zc2018510469 = $value['zc2018510469'];$zc2018510479 = $value['zc2018510479'];$zc2018510490 = $value['zc2018510490'];$zc2018510496 = $value['zc2018510496'];$zc2018510498 = $value['zc2018510498'];$zc2018510499 = $value['zc2018510499'];$zc2018510520 = $value['zc2018510520'];$zc2018510524 = $value['zc2018510524'];$zc2018510534 = $value['zc2018510534'];$zc2018510537 = $value['zc2018510537'];$zc2018510541 = $value['zc2018510541'];$zc2018510543 = $value['zc2018510543'];$zc2018510552 = $value['zc2018510552'];$zc2018510564 = $value['zc2018510564'];$zc2018510568 = $value['zc2018510568'];$zc2018510569 = $value['zc2018510569'];$zc2018510579 = $value['zc2018510579'];$zc2018510588 = $value['zc2018510588'];$zc2018510591 = $value['zc2018510591'];$zc2018510592 = $value['zc2018510592'];$zc2018510594 = $value['zc2018510594'];$zc2018510596 = $value['zc2018510596'];$zc2018510600 = $value['zc2018510600'];$zc2018510601 = $value['zc2018510601'];$zc2018510616 = $value['zc2018510616'];$zc2018510618 = $value['zc2018510618'];$zc2018510620 = $value['zc2018510620'];$zc2018510625 = $value['zc2018510625'];$zc2018510628 = $value['zc2018510628'];$zc2018510636 = $value['zc2018510636'];$zc2018510640 = $value['zc2018510640'];$zc2018510643 = $value['zc2018510643'];$zc2018510647 = $value['zc2018510647'];$zc2018510664 = $value['zc2018510664'];$zc2018510666 = $value['zc2018510666'];$zc2018510668 = $value['zc2018510668'];$zc2018510671 = $value['zc2018510671'];$zc2018510672 = $value['zc2018510672'];$zc2018510679 = $value['zc2018510679'];$zc2018510681 = $value['zc2018510681'];$zc2018510691 = $value['zc2018510691'];$zc2018510695 = $value['zc2018510695'];$zc2018510696 = $value['zc2018510696'];$zc2018510705 = $value['zc2018510705'];$zc2018510708 = $value['zc2018510708'];$zc2018510713 = $value['zc2018510713'];$zc2018510721 = $value['zc2018510721'];$zc2018510722 = $value['zc2018510722'];$zc2018510728 = $value['zc2018510728'];$zc2018510729 = $value['zc2018510729'];$zc2018510752 = $value['zc2018510752'];$zc2018510753 = $value['zc2018510753'];$zc2018510755 = $value['zc2018510755'];$final = $value['final'];
            $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.$num, "$id")->setCellValue('B'.$num, "$name")->setCellValue('C'.$num, "$student_id")->setCellValue('D'.$num, "$situation")->setCellValue('E'.$num, "$message")->setCellValue('F'.$num, "$zc2018510429")->setCellValue('G'.$num, "$zc2018510435")->setCellValue('H'.$num, "$zc2018510438")->setCellValue('I'.$num, "$zc2018510447")->setCellValue('J'.$num, "$zc2018510448")->setCellValue('K'.$num, "$zc2018510450")->setCellValue('L'.$num, "$zc2018510452")->setCellValue('M'.$num, "$zc2018510456")->setCellValue('N'.$num, "$zc2018510458")->setCellValue('O'.$num, "$zc2018510463")->setCellValue('P'.$num, "$zc2018510465")->setCellValue('Q'.$num, "$zc2018510469")->setCellValue('R'.$num, "$zc2018510479")->setCellValue('S'.$num, "$zc2018510490")->setCellValue('T'.$num, "$zc2018510496")->setCellValue('U'.$num, "$zc2018510498")->setCellValue('V'.$num, "$zc2018510499")->setCellValue('W'.$num, "$zc2018510520")->setCellValue('X'.$num, "$zc2018510524")->setCellValue('Y'.$num, "$zc2018510534")->setCellValue('Z'.$num, "$zc2018510537")->setCellValue('AA'.$num, "$zc2018510541")->setCellValue('AB'.$num, "$zc2018510543")->setCellValue('AC'.$num, "$zc2018510552")->setCellValue('AD'.$num, "$zc2018510564")->setCellValue('AE'.$num, "$zc2018510568")->setCellValue('AF'.$num, "$zc2018510569")->setCellValue('AG'.$num, "$zc2018510579")->setCellValue('AH'.$num, "$zc2018510588")->setCellValue('AI'.$num, "$zc2018510591")->setCellValue('AJ'.$num, "$zc2018510592")->setCellValue('AK'.$num, "$zc2018510594")->setCellValue('AL'.$num, "$zc2018510596")->setCellValue('AM'.$num, "$zc2018510600")->setCellValue('AN'.$num, "$zc2018510601")->setCellValue('AO'.$num, "$zc2018510616")->setCellValue('AP'.$num, "$zc2018510618")->setCellValue('AQ'.$num, "$zc2018510620")->setCellValue('AR'.$num, "$zc2018510625")->setCellValue('AS'.$num, "$zc2018510628")->setCellValue('AT'.$num, "$zc2018510636")->setCellValue('AU'.$num, "$zc2018510640")->setCellValue('AV'.$num, "$zc2018510643")->setCellValue('AW'.$num, "$zc2018510647")->setCellValue('AX'.$num, "$zc2018510664")->setCellValue('AY'.$num, "$zc2018510666")->setCellValue('AZ'.$num, "$zc2018510668")->setCellValue('BA'.$num, "$zc2018510671")->setCellValue('BB'.$num, "$zc2018510672")->setCellValue('BC'.$num, "$zc2018510679")->setCellValue('BD'.$num, "$zc2018510681")->setCellValue('BE'.$num, "$zc2018510691")->setCellValue('BF'.$num, "$zc2018510695")->setCellValue('BG'.$num, "$zc2018510696")->setCellValue('BH'.$num, "$zc2018510705")->setCellValue('BI'.$num, "$zc2018510708")->setCellValue('BJ'.$num, "$zc2018510713")->setCellValue('BK'.$num, "$zc2018510721")->setCellValue('BL'.$num, "$zc2018510722")->setCellValue('BM'.$num, "$zc2018510728")->setCellValue('BN'.$num, "$zc2018510729")->setCellValue('BO'.$num, "$zc2018510752")->setCellValue('BP'.$num, "$zc2018510753")->setCellValue('BQ'.$num, "$zc2018510755")->setCellValue('BR'.$num, "$final");
                
        }

        $objPHPExcel -> getActiveSheet() -> setTitle('User');
        $objPHPExcel -> setActiveSheetIndex(0);

        header('Content-Type: application.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xls');
        $objWriter -> save('php://output');
        exit;
    }

}
        