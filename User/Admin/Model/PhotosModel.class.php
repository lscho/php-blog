<?php

namespace Admin\Model;

use Think\Model;

class PhotosModel extends Model {

    //获取相册列表
    public function getList($where = null,$pageSize=10) {
        $count = $this->where($where)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, $pageSize);
        $show = $Page->show(); // 分页显示输出
        $showPage = $Page->showPage(); // 分页显示输出
        $list = $this->where($where)
                ->order('time desc')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->select();
        $rs['showPage'] = $showPage;
        $rs['count'] = $count;
        $rs['list'] = $list;
        $rs['page'] = $show;
        return $rs;
    }
}
