<?php
/*
	作者：大萌
	网址：http://www.eyblog.com
	代码遵守Apache License开源。希望保留版权！
*/
if (version_compare(PHP_VERSION, '5.3.0', '<'))     // 检测PHP环境
    die('easyou：require PHP > 5.3.0 !');
//define('APP_DEBUG', True);                          // 调试模式
define("APP_ROOT", dirname(__FILE__));              //网站根目录
define('APP_PATH', './User/');                      // 应用目录
require './System/System.php';                      // 引入系统核心文件