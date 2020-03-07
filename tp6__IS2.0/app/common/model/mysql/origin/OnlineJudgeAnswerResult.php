<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/2/2 下午10:30
 *
 */


namespace app\common\model\mysql\origin;
use think\Model;

class OnlineJudgeAnswerResult extends Model
{

    protected $table = 'oj_answer_result';

    public function getAllResultsByStudentId($student_id){
        return $this -> where('student_id', $student_id) -> select();
    }

    public function getAllResultByStudentId($student_id){
        return $this -> where('student_id', $student_id) -> where('status', '已判') -> select();
    }

    public function judgePaper($data){
        $target = $this -> findPaper($data);
        return $target -> allowField(['mark', 'status']) -> save($data);
    }

    public function updatePaperAnswerSituation($data){
        $target = $this -> findPaper($data);
        return $target -> allowField(['single_answer', 'multiple_answer', 'judge_answer']) -> save($data);
    }

    public function addPaperAnswerSituation($data){
        return $this -> save($data);
    }

    public function findPaper($data){
        return $this -> where('student_id', $data['student_id']) -> where('paper_id', $data['paper_id']) -> find();
    }

}