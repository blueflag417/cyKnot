<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    //显示主页
    public function index(){
        $this->display("index");
    }
    //查看校友
    public function findSchoolfellow(){
        $this->display();
    }
    public function _before_findSchoolfellow(){
        //查看来访者是否绑定学号
        $ok = 1;
        if (!$ok){
            $this->redirect("请先绑定学号","xx",3);
        }
    }
    //完善信息表单提交处理
    public function perfectInfo(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = "./Public/";
        $upload->savePath = '/photos/'; // 设置附件上传目录
        $upload->saveName = "mm";
        $upload->autoSub = false;
        // 上传文件
        $info = $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $this->success('上传成功！');
        }
    }
    //完善信息页面
    public function information(){
        //获取访问者微信号
        $id = "18883866922";
        $this->assign("info",M("message")->where(array(
            "weixin_id" => $id
        ))->select());
        $this->assign("name","kiscall");
        $this->display("information");
    }
    //显示详细信息页面
    public function showDetail(){

    }
}