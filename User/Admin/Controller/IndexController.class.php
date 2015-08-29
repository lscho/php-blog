<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class IndexController extends AdminController {

    //后台首页
    public function index() {
        //统计字段
        $count['content'] = M('contents')->count();
        $count['mood'] = M('moods')->count();
        $count['image'] = M('images')->count();
        $count['comment'] = M('comments')->count();
        $this->count=$count;
        //最新心情
        $this->newmood=D('Moods')->getNew(3);
        //最新留言
        $this->newcomment=D('Comments')->getNew(3);
        $this->display();
    }

    //主题编辑
    public function themes() {
        $f = new \Ey\Functions\f; //引入自定义函数库
        $files = $f->filelist();
        $path = I('get.path', null, "htmlspecialchars"); //路径
        if ($path == null) {
            $rs=$this->getHtml('Index_index.html');
            $this->assign('files', $files); //主题路径
            $this->assign('html', $rs);     //主题内容
            $this->display();               
        } else {
            $rs=$this->getHtml($path);
            echo $rs;
        }
    }
    //获取主题内容
    public function getHtml($path){
        $myfile = fopen(APP_ROOT . "/User/Home/View/" . $path, "r") or die(json_encode(array('status' => 0, 'msg' => '没有文件夹权限权限')));
		$html = fread($myfile, filesize(APP_ROOT . "/User/Home/View/" . $path)); 
        fclose($myfile);
        return $html;
    }

    //清除模板缓存
    public function del() {
        $f = new \Ey\Functions\f;
        $rs = $f->del_cache();
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '清除成功')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '清除失败')));
        }
    }
    //保存主题内容
    public function setHtml(){
        $html = $_POST["html"];
        ; //内容
        $path = I('post.path', NULL, "htmlspecialchars"); //路径
        $myfile = fopen(APP_ROOT . "/User/Home/View/" . $path, "w") or die(json_encode(array('status' => 1, 'msg' => '没有文件夹权限')));
        fwrite($myfile, $html);
        fclose($myfile);
        die(json_encode(array('status' => 1, 'msg' => '保存成功')));
    }

}
