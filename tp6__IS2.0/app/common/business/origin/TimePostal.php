<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/30 上午3:43
 *
 */


namespace app\common\business\origin;
use app\common\model\mysql\origin\TimePostalMailbox as TimePostalMailboxModel;
use PHPMailer\PHPMailer\PHPMailer;

class TimePostal
{

    public function sendPrivateLetter(){
        $timePostalMailboxModel = new TimePostalMailboxModel();
        $allPrivateLetter = $timePostalMailboxModel -> getAllPrivateLetter();
        foreach($allPrivateLetter as $key){
            if(time() < $key['delivery_time']){
                continue;
            }
            $this -> sendPrivateEmail($key['email'], $key['title'], $key['letter']);
            $timePostalMailboxModel -> updateSendInfo($key['id']);
        }
    }

    public function getTargetLetter($id){
        $timePostalMailboxModel = new TimePostalMailboxModel();
        return $timePostalMailboxModel -> findTargetLetterById($id);
    }

    public function getAllOpenLetter(){
        $timePostalMailboxModel = new TimePostalMailboxModel();
        return $timePostalMailboxModel -> findAllOpenLetter();
    }

    public function recoveryLetterById($id, $email, $status){
        $timePostalMailboxModel = new TimePostalMailboxModel();
        $allLetter = $timePostalMailboxModel -> getLetterByEmail($email);
        foreach($allLetter as $key){
            if($id != $key['id']){
                continue;
            }
            $timePostalMailboxModel -> recoveryTheLetterById($id, $status);
        }
    }

    public function deleteLetterById($id, $email){
        $timePostalMailboxModel = new TimePostalMailboxModel();
        $allLetter = $timePostalMailboxModel -> getLetterByEmail($email);
        foreach($allLetter as $key){
            if($id != $key['id']){
                continue;
            }
            $timePostalMailboxModel -> softDeleteLetterById($id);
        }
    }

    public function getAllPrivateLetter($email){
        $timePostalMailboxModel = new TimePostalMailboxModel();
        $info = $timePostalMailboxModel -> getLetterByEmail($email);
        $res = [];
        foreach($info as $key){

            $temp = [
                "id" => $key['id'],
                "title" => $key['title'],
                "delivery_time" => $key['delivery_time'],
                "create_time" => $key['create_time'],
                "status" => $key['status'],
            ];
            $res[] = $temp;
        }
        return $res;
    }

    public function writeLetterIntoMailBox($data){
        $data["delivery_time"] = strtotime($data["delivery_time"]);
        $data['create_time'] = time();
        $timePostalMailboxModel = new TimePostalMailboxModel();
        return $timePostalMailboxModel -> add($data);
    }

    public function sendPrivateEmail($target, $title, $letter){
        $mailer = new PHPMailer();
        try {
            $mailer -> CharSet ="UTF-8";
            $mailer -> SMTPDebug = 0;
            $mailer -> isSMTP();
            $mailer -> Host = 'smtp.163.com';
            $mailer -> SMTPAuth = true;
            $mailer -> Username = 'redleafshane@163.com';
            $mailer -> Password = 'SJWZyHHf3sYxcSGN';
            $mailer -> SMTPSecure = 'ssl';
            $mailer -> Port = 465;

            $mailer -> setFrom('redleafshane@163.com', 'Shane');
            $mailer -> addAddress($target);
            $mailer -> addReplyTo('redleafshane@163.com', 'Shane');

            $mailer -> isHTML(true);
            $mailer -> Subject = "$title--工学部综合系统--时光邮箱";
            $mailer -> Body    = '<h1>汇华的同学你好：</h1><br>&nbsp;&nbsp;Shane把你的时光邮件带来了：<br>'.'&nbsp;&nbsp;'.$letter;
            $mailer -> AltBody = '汇华的同学你好：Shane把你的时光邮件带来了：'.$letter;

            $mailer -> send();
            return config("status.success");
        } catch (Exception $exception) {
            return $exception -> getMessage();
        }
    }

}