<?php

namespace Admin\Common;

use Think\Controller;

//Admin控制器父类
class AdminController extends Controller {

    //控制器类公共函数
    public function _initialize() {
        $this->checkLogin();
    }

    //检测登陆状态
    public function checkLogin() {
        $id = session('ey_id');
        if (isset($id)) {
            $user['id'] = $id;
            $user['user']=session('ey_user');
            $this->user = $user;
        } else {
            $this->log('尝试进行未授权操作','error');
            $this->redirect('Home/Login/index');
        }
    }

    //系统日志
    public function log($str, $status) {
        $data = '[' . date("Y/m/d H:i:s") . ']';
        $data.='----' . $status;
        $data.='----' . $_SERVER["REMOTE_ADDR"];
        $data.='----ADMIN***' . $str . "***";
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {//判断服务器类型
            $data.="\r\n";
        } else {
            $data.="\n";
        }
        $myfile = fopen("./log.txt", "a") or die("Unable to open file!"); //a表示追加写入，w表示覆盖写入
        fwrite($myfile, $data);
        fclose($myfile);
    }

    //读取日志
    public function getLog() {
        $myfile = fopen("./log.txt", "r") or die("Unable to open file!");
        while (!feof($myfile)) {
            $line[] = fgets($myfile);
        }
        return $line;
        fclose($myfile);
    }

    //清除日志
    public function cLog() {
        $myfile = fopen("./log.txt", "wb") or die("Unable to open file!");
        fclose($myfile);
    }
    //配置保存
    public function set($data){
        $confile=APP_ROOT.'/User/Common/Conf/web_config.php';
        $c=require($confile);
        $c=array_merge($c,$data);
        $settingstr='<?php '."\n"
                . 'return  '.var_export($c,true).';';
        file_put_contents($confile,$settingstr); 
    }

}
