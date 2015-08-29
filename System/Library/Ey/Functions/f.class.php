<?php

namespace Ey\Functions;

class f {//自定义扩展类

    function filelist() {             //返回主题文件路径
        $dir = APP_ROOT . "/User/Home/View"; //主题目录
        $list = scandir($dir);
        foreach ($list as $file) {//遍历
            $path = $dir . "/" . $file;
            if (is_dir($path) && $file != "." && $file != "..") { //判断是否是路径
                filelist($path);
            } else if ($this->extend($file) == "html") {
                $rs[] = array(
                    "file" => $file,
                    "path" => $path,
                );
            }
        }
        return $rs;
    }

    function extend($file_name) {         //返回文件类型 
        $extend = explode(".", $file_name);
        $va = count($extend) - 1;
        return $extend[$va];
    }
    //清除缓存
    public function del_cache() { 
        header("Content-type: text/html; charset=utf-8");
        //清文件缓存
        $dirs = array(APP_ROOT . "/User/Runtime/");
        //mkdir('Runtime', 0777, true);
        //清理缓存
        foreach ($dirs as $value) {
            $rs=$this->rmdirr($value);
        }
        return $rs;
    }
    //清除方法
    public function rmdirr($dirname) {
        if (!file_exists($dirname)) {
            return false;
        }
        if (is_file($dirname) || is_link($dirname)) {
            return unlink($dirname);
        }
        $dir = dir($dirname);
        if ($dir) {
            while (false !== $entry = $dir->read()) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                //递归
                $this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
            }
        }
        $dir->close();
        return rmdir($dirname);
    }

}
