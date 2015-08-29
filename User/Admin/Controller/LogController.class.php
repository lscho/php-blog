<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class LogController extends AdminController {

    //系统日志
    public function index() {
        $this->loglist = $this->getLog();
        $this->display();
    }

    //清除日志
    public function clear() {
        if($this->cLog()){
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }else{
            die(json_encode(array('status' => 1, 'msg' => '操作成功')));
        }
    }
    //修改记录日志状态
    public function status(){
        $status=I('status');
        $config['web_islog']=$status;
        $rs=$this->set($config);
        if($rs){
            $this->log("修改配置","error");
            die(json_encode(array('status' => 0, 'msg' => '保存失败！')));
        }else{
            $this->log("修改配置","seccess");
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        }        
    }

}
