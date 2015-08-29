<?php if (!isset($_POST['db_host'])) { ?>
    <!DOCTYPE html>
    <html>
        <head lang="en">
            <meta charset="UTF-8">
            <title>easyou安装程序</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <meta name="format-detection" content="telephone=no">
            <meta name="renderer" content="webkit">
            <meta http-equiv="Cache-Control" content="no-siteapp" />
            <link rel="stylesheet" href="Public/css/amazeui.min.css"/>
            <script src="Public/js/jquery.min.js"></script>
            <style>
                .header {
                    text-align: center;
                }
                .header h1 {
                    font-size: 200%;
                    color: #333;
                    margin-top: 30px;
                }
                .header p {
                    font-size: 14px;
                }
            </style>
        </head>

        <body>

            <div class="header">

                <div class="am-g">

                    <h1>easyou轻博客安装...</h1>

                    <p>简单、年轻、给你自由</p>

                </div>

                <hr />

            </div>

            <div class="am-g">

                <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">

                    <h3>填入各项信息并开始安装</h3>

                    <p>环境要求：php5.3+,apache[注：其他http服务器需要自己定义伪静态规则]</p>
                    
                     <p>后台默认用户名:admin   默认密码:easyou</p>
                     
                      <p>安装完成请手动删除本文件与easyou.sql</p>

                    <form id="my_form" method="post" class="am-form" action="__ROOT__/Admin/Login/dologin.html">

                        <label for="email">数据库地址：</label>*一般为localhost

                        <input type="text" id="db_host">

                        <br>
                        <label for="email">用户名：</label>

                        <input type="text" id="db_user">

                        <br>

                        <label for="password">密码:</label>

                        <input type="password" id="db_pwd" value=""><input type="button" onclick="test()" value="测试可用性" class="am-btn am-btn-default am-btn-sm am-fl">

                        <br><br>

                        <label for="email">数据库名：</label>*本程序表以ey_开头，请注意原有数据表名字。

                        <input type="text" id="db_name" value="">

                        <br>
                        <div class="am-cf">

                            <input type="button" onclick="install()" name="" value="安装" class="am-btn am-btn-default am-btn-sm am-fl">

                        </div>

                    </form>

                    <hr>

                    <p>如果您遇到困难可以尝试到<a href="http://eyblog.com">easyou博客</a>留言。或者加入<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=a70c000a01abbae891fc1d994d0f23cadf26ac7a14fdee353f0af3fe757060db"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="交流群" title="交流群"></a>来与我们交流。</p>

                </div>

            </div>
            <script type="text/javascript">
                function test() {
                    var db_host = $("#db_host").val();
                    var db_user = $("#db_user").val();
                    var db_pwd = $("#db_pwd").val();
                    var url = window.location.href;
                    $.post(url, {
                        db_host: db_host,
                        db_user: db_user,
                        db_pwd: db_pwd,
                        ceshi: 1
                    }, function(data, status) {
                        alert(data);
                    });
                }
                function install() {
                    var db_host = $("#db_host").val();
                    var db_user = $("#db_user").val();
                    var db_pwd = $("#db_pwd").val();
                    var db_name = $("#db_name").val();
                    var url = window.location.href;
                    $.post(url, {
                        db_host: db_host,
                        db_user: db_user,
                        db_pwd: db_pwd,
                        db_name: db_name,
                    }, function(data, status) {
                        alert(data);
                    });
                }

            </script>

        </body>

    </html>
    <?php
}

class db {

    private $dbhost; //服务器名 
    private $dbuser; //用户名 
    private $dbpwd; //密码 
    private $dbname; //数据库名 

    function db($dbhost = "localhost", $dbuser = "root", $dbpwd = "", $dbname = "test") {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpwd = $dbpwd;
        $this->dbname = $dbname;
    }

    function dbs($dbsql) {
        $con = mysql_connect($this->dbhost, $this->dbuser, $this->dbpwd); //分别是数据库主机,数据库名,数据库密码
        if (!$con) {
            die('Could not connect: ' . mysql_error()); //返回连接错误信息
        }
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET CHARACTER_SET_CLIENT=utf8");
        mysql_query("SET CHARACTER_SET_RESULTS=utf8"); //强制设置为utf8类型
        mysql_select_db($this->dbname, $con); //设置连接连接数据库
        $result = mysql_query($dbsql);
        if (is_resource($result)) {
            $row = mysql_fetch_array($result);
            return $row;
        }
        mysql_close($con);
    }

}

//清除缓存
function del_cache() {
    header("Content-type: text/html; charset=utf-8");
    //清文件缓存
    $dirs = array("./User/Runtime/");
    //清理缓存
    foreach ($dirs as $value) {
        $rs = rmdirr($value);
    }
    return $rs;
}

//清除方法
function rmdirr($dirname) {
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
            rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
        }
    }
    $dir->close();
    return rmdir($dirname);
}
//测试是否可用
if (isset($_POST['ceshi'])) {
    $con = @mysql_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pwd']); //分别是数据库主机,数据库名,数据库密码
    if (!$con) {
        die('test:error');
    } else {
        die('test:success');
    }
}
//开始安装
if (isset($_POST['db_host'])) {
    $db = new db($_POST['db_host'], $_POST['db_user'], $_POST['db_pwd'], $_POST['db_name']);
    $lines = file("easyou.sql");
    $sqlstr = "";
    foreach ($lines as $line) {

        $line = trim($line);

        if ($line != "") {
            if (!($line{0} == "#" || $line{0} . $line{1} == "--")) {
                $sqlstr.=$line;
            }
        }
    }
    $sqlstr = rtrim($sqlstr, ";");
    $sqls = explode(";", $sqlstr);
    foreach ($sqls as $k => $v) {
        $rs = $db->dbs($v);
    }
    if ($rs) {
        echo 'install:error';
    } else {
        $data['DB_HOST'] = $_POST['db_host'];
        $data['DB_NAME'] = $_POST['db_name'];
        $data['DB_USER'] = $_POST['db_user'];
        $data['DB_PWD'] = $_POST['db_pwd'];
        $data['install'] = 1;
        $confile = 'config.php';
        $c = require($confile);
        $c = array_merge($c, $data);
        $settingstr = '<?php ' . "\n"
                . 'return  ' . var_export($c, true) . ';';
        file_put_contents($confile, $settingstr);
        del_cache();
        echo 'install:success';
    }
}
?>