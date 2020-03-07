<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/2/2 下午10:26
 *
 */


namespace app\common\business\origin;
use app\common\model\mysql\origin\OnlineJudgeSetsPaper as OnlineJudgeSetsPaperModel;
use app\common\model\mysql\origin\OnlineJudgeAnswerResult as OnlineJudgeAnswerResultModel;
use app\common\model\mysql\origin\OnlineJudgeCatalogue as OnlineJudgeCatalogueModel;
use app\common\model\mysql\origin\IsUniteUser as IsUniteUserModel;

class OnlineJudge
{

    public function getPersonalPapers($user){
        try {
            $onlineJudgeAnswerResultModel = new OnlineJudgeAnswerResultModel();
            $onlineJudgeSetsPaperModel = new OnlineJudgeSetsPaperModel();
            $info = $onlineJudgeAnswerResultModel -> getAllResultsByStudentId($user['student_id']);
            $res = [];
            foreach($info as $key){
                $temp = $onlineJudgeSetsPaperModel -> findTargetAvailablePaper($key['paper_id']);
                $res[] = [
                    'id' => $key['id'],
                    'paper_id' => $key['paper_id'],
                    'paper_name' => $temp['head'],
                    'mark' => $key['mark'],
                    'status' => $key['status']
                ];
            }
            return $res;
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    public function rankListSort($user){
        try{
            $onlineJudgeAnswerResultModel = new OnlineJudgeAnswerResultModel();
            $isUniteUserModel = new IsUniteUserModel();
            $allData = $isUniteUserModel -> getAllResultByClassesId($user['classes_id']);
            $allResult = [];
            foreach($allData as $key){
                $temp = $onlineJudgeAnswerResultModel -> getAllResultByStudentId($key['student_id']);
                if($temp -> isEmpty()){
                    continue;
                }
                $allResult[] = $temp;
            }
            $rankList = [];$i = 0;
            foreach($allResult as $keys){
                $temp = 0;
                foreach($keys as $key){
                    $temp += $key['mark'];
                    $rankList[$i] = [
                        'name' => $key['name'],
                        'mark' => $temp
                    ];
                }
                $i++;
            }
            array_multisort(array_column($rankList, 'mark'), SORT_DESC, $rankList);
            return $rankList;
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    public function doTheTargetPaper($data){

        try {
            if($data['status'] == '未判'){
                return $this -> doUnJudgePaper($data);
            }else if($data['status'] == '已判'){
                return $this -> doJudgePaper($data);
            }else{
                return config('status.failed');
            }
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    public function doJudgePaper($data){
        try {
            $onlineJudgeAnswerResultModel = new OnlineJudgeAnswerResultModel();
            $isExist = $onlineJudgeAnswerResultModel -> findPaper($data);
            $isDead = $this -> getTheTargetPaper($data);
            if(time() < $isDead['bornline']){
                return config('status.not_begin_time');
            }
            if(time() > $isDead['deadline']){
                return config('status.deadline_over');
            }

            if(!empty($isExist)){
                if($isExist['status'] == '已判'){
                    return config('status.sign_exist');
                }
                $answers = [
                    'single_answer' => $isExist['single_answer'],
                    'multiple_answer' => $isExist['multiple_answer'],
                    'judge_answer' => $isExist['judge_answer'],
                ];
                $mark = $this -> countMark($answers, $data['paper_id']);
                if($mark == 10000){
                    return config('status.failed');
                }
                $res = [
                    'student_id' => $data['student_id'],
                    'paper_id' => $data['paper_id'],
                    'mark' => $mark,
                    'status' => $data['status'],
                ];
                return $onlineJudgeAnswerResultModel -> judgePaper($res);
            }
            $answers = [
                'single_answer' => $data['single_answer'],
                'multiple_answer' => $data['multiple_answer'],
                'judge_answer' => $data['judge_answer'],
            ];
            $mark = $this -> countMark($answers, $data['paper_id']);
            if($mark == 10000){
                return config('status.failed');
            }
            $res = [
                'name' => $data['name'],
                'student_id' => $data['student_id'],
                'paper_id' => $data['paper_id'],
                'single_answer' => $data['single_answer'],
                'multiple_answer' => $data['multiple_answer'],
                'judge_answer' => $data['judge_answer'],
                'mark' => $mark,
                'status' => '已判',
            ];
            return $onlineJudgeAnswerResultModel -> addPaperAnswerSituation($res);
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    public function countMark($your_answer, $paper_id){
        $onlineJudgeSetsPaperModel = new OnlineJudgeSetsPaperModel();
        $info = $onlineJudgeSetsPaperModel -> findTargetAvailablePaper($paper_id);

        $single_answer = explode(',', rtrim($info['single_answer'], ','));
        $multiple_answer = explode(',', rtrim($info['multiple_answer'], ','));
        $judge_answer = explode(',', rtrim($info['judge_answer'], ','));
        $your_answer_single = explode(',', rtrim($your_answer['single_answer'], ','));
        $your_answer_multiple = explode(',', rtrim($your_answer['multiple_answer'], ','));
        $your_answer_judge = explode(',', rtrim($your_answer['judge_answer'], ','));

        if(count($single_answer) != count($your_answer_single) || count($multiple_answer) != count($your_answer_multiple) || count($judge_answer) != count($your_answer_judge)){
            return 10000;
        }
        $mark = 0;

        if(!empty($single_answer[0])){
            for($i = 0; $i < count($single_answer); $i++){
                if($single_answer[$i] == $your_answer_single[$i]){
                    $mark++;
                }
            }
        }

        if(!empty($multiple_answer[0])){
            for($i = 0; $i < count($multiple_answer); $i++){
                if($multiple_answer[$i] == $your_answer_multiple[$i]){
                    $mark++;
                }
            }
        }

        if(!empty($judge_answer[0])){
            for($i = 0; $i < count($judge_answer); $i++){
                if($judge_answer[$i] == $your_answer_judge[$i]){
                    $mark++;
                }
            }
        }

        return $mark;
    }

    public function doUnJudgePaper($data){
        try {
            $onlineJudgeAnswerResultModel = new OnlineJudgeAnswerResultModel();
            $isExist = $onlineJudgeAnswerResultModel -> findPaper($data);
            $isDead = $this -> getTheTargetPaper($data);
            if(time() < $isDead['bornline']){
                return config('status.not_begin_time');
            }
            if(time() > $isDead['deadline']){
                return config('status.deadline_over');
            }

            if(!empty($isExist)){
                if($isExist['status'] == '已判'){
                    return config('status.sign_exist');
                }
                return $onlineJudgeAnswerResultModel -> updatePaperAnswerSituation($data);
            }
            return $onlineJudgeAnswerResultModel -> addPaperAnswerSituation($data);

        }catch (\Exception $exception){
            return $exception -> getMessage();
        }

    }

    public function getTheTargetPaper($data){
        try {
            $onlineJudgeSetsPaperModel = new OnlineJudgeSetsPaperModel();
            $info = $onlineJudgeSetsPaperModel -> findTargetAvailablePaper($data['paper_id']);

            if(time() < $info['bornline']){
                return config('status.not_begin_time');
            }
            if(time() > $info['deadline']){
                return config('status.deadline_over');
            }
            $onlineJudgeAnswerResultModel = new OnlineJudgeAnswerResultModel();
            $isExist = $onlineJudgeAnswerResultModel -> findPaper($data);
            $info['single'] = explode(',', rtrim($info['single'], ','));
            $info['multiple'] = explode(',', rtrim($info['multiple'], ','));
            $info['judge'] = explode(',', rtrim($info['judge'], ','));

            $body = [];

            if(!empty($info['single'][0])){
                foreach($info['single'] as $key){
                    $body['single'][] = explode('`', $key);
                }
            }else{
                $body['single'] = NULL;
            }
            if(!empty($info['multiple'][0])){
                foreach($info['multiple'] as $key){
                    $body['multiple'][] = explode('`', $key);
                }
            }else{
                $body['multiple'] = NULL;
            }
            if(!empty($info['judge'][0])){
                foreach($info['judge'] as $key){
                    $body['judge'][] = explode('`', $key);
                }
            }else{
                $body['judge'] = NULL;
            }

            if(!empty($isExist)){
                $temp_a = explode(',', $isExist['single_answer']);
                $temp_b = explode(',', $isExist['multiple_answer']);
                $temp_c = explode(',', $isExist['judge_answer']);
                if(empty($temp_a[0])){
                    $isExist['single_answer'] = NULL;
                }
                if(empty($temp_b[0])){
                    $isExist['multiple_answer'] = NULL;
                }
                if(empty($temp_c[0])){
                    $isExist['judge_answer'] = NULL;
                }
                if($isExist['status'] == '已判'){
                    $temp_analysis_a = explode(',', $info['single_analysis']);
                    $temp_analysis_b = explode(',', $info['multiple_analysis']);
                    $temp_analysis_c = explode(',', $info['judge_analysis']);
                    $temp_answer_a = explode(',', $info['single_answer']);
                    $temp_answer_b = explode(',', $info['multiple_answer']);
                    $temp_answer_c = explode(',', $info['judge_answer']);
                    if(empty($temp_analysis_a[0])){
                        $info['single_analysis'] = NULL;
                    }
                    if(empty($temp_analysis_b[0])){
                        $info['multiple_analysis'] = NULL;
                    }
                    if(empty($temp_analysis_c[0])){
                        $info['judge_analysis'] = NULL;
                    }
                    if(empty($temp_answer_a[0])){
                        $info['single_answer'] = NULL;
                    }
                    if(empty($temp_answer_b[0])){
                        $info['multiple_answer'] = NULL;
                    }
                    if(empty($temp_answer_c[0])){
                        $info['judge_answer'] = NULL;
                    }

                    return [
                        'id' => $info['id'],
                        'head' => $info['head'],
                        'body' => $body,
                        'bornline' => $info['bornline'],
                        'deadline' => $info['deadline'],
                        'single_answer' => $isExist['single_answer'],
                        'multiple_answer' => $isExist['multiple_answer'],
                        'judge_answer' => $isExist['judge_answer'],
                        'single_analysis' => $info['single_analysis'],
                        'multiple_analysis' => $info['multiple_analysis'],
                        'judge_analysis' => $info['judge_analysis'],
                        'correct_single_answer' => $info['single_answer'],
                        'correct_multiple_answer' => $info['multiple_answer'],
                        'correct_judge_answer' => $info['judge_answer'],
                        'status' => $isExist['status']

                    ];
                }
                return [
                    'id' => $info['id'],
                    'head' => $info['head'],
                    'body' => $body,
                    'bornline' => $info['bornline'],
                    'deadline' => $info['deadline'],
                    'single_answer' => $isExist['single_answer'],
                    'multiple_answer' => $isExist['multiple_answer'],
                    'judge_answer' => $isExist['judge_answer'],
                    'status' => $isExist['status']
                ];
            }
            return [
                'id' => $info['id'],
                'head' => $info['head'],
                'body' => $body,
                'bornline' => $info['bornline'],
                'deadline' => $info['deadline']
            ];
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }
    }

    public function getAllThePapers($id){

        try {
            $onlineJudgeCatalogueModel = new OnlineJudgeCatalogueModel();
            $onlineJudgeSetsPaperModel = new OnlineJudgeSetsPaperModel();
            $catalogue = $onlineJudgeCatalogueModel -> findTargetCatalogue($id);
            $paper_ids = explode(',', $catalogue['paper_ids']);
            $res = [];
            foreach($paper_ids as $key){
                $temp = $onlineJudgeSetsPaperModel -> findTargetAvailablePaper($key);
                if(empty($temp)){
                    continue;
                }

                $res[] = [
                    'id' => $temp['id'],
                    'head' => $temp['head'],
                    'bornline' => $temp['bornline'],
                    'deadline' => $temp['deadline'],
                ];
            }

            return $res;
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }

    }

    public function getAllTheCatalogues(){

        try {
            $onlineJudgeCatalogueModel = new OnlineJudgeCatalogueModel();
            return $onlineJudgeCatalogueModel -> findAllAvailableCatalogues();
        }catch (\Exception $exception){
            return $exception -> getMessage();
        }

    }

}