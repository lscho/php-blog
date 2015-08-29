<?php
namespace Admin\Model;
use Think\Model;
class CommentsModel extends Model {
    //获取留言
    public function getList($pid=0,$pageSize=10){
        if($pid){
            $where['pid']=$pid;
        }
        $where['tid']=1;
        $count = $this->where($where)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, $pageSize);
        $show = $Page->show();                  // 分页显示输出
        $showPage = $Page->showPage();          // 分页显示输出
        $list = $this->where($where)
                ->order('time desc')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->select();
        foreach($list as $k=>&$v){              //处理留言数据
            //父级留言
            if($v['nid']){
                $v['nodeList']=$this->where('id='.$v['nid'])->field('name,address,comment')->find();
            }
        }
        $rs['showPage'] = $showPage;
        $rs['count'] = $count;
        $rs['list'] = $list;
        $rs['page'] = $show;
        return $rs;
    }
    //获取最新
    public function getNew($nums=1){
        $where['ey_comments.tid']=1;
        $rs=$this->where($where)
                ->join('ey_contents ON ey_comments.pid=ey_contents.id')
                ->limit($nums)
                ->field("ey_comments.*,ey_contents.title")
                ->order('ey_comments.time desc')
                ->select();
        return $rs;
    }

}
