<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    //显示主页
    public function index(){
        $this->display("index");
    }

    //查看来访者是否绑定学号,未绑定则跳转到绑定学号页面,绑定了的话将用户openid存储起来
    public function _before_index(){
        $info = $this->bindVerify(I('get.openid'));
        session('info',array(
            "openid" => I('get.openid'),
            "stuid" => $info->stuId,
        ));
        if ($info->status != 200) {
            redirect("http://hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Bind/Bind/bind/openid/".session('openid')."/token/gh_68f0a1ffc303.html", 3, "请先绑定学号！3秒钟后跳转到绑定学号页面...");
        }
    }

    //查看校友
    public function findSchoolfellow(){
        $info = M('message')->where(array(
            "openid"=>session("info")['openid'],
        ))->find();
        $pos_tar = $this->getLocation(session('info')['openid']);
        $sf = M('message')->where(array(
            "hometown"=>$info['hometown'],
        ))->order("photo,desc")->select();
        for ($i=0; $i<count($sf); $i++){
            $pos_fri = $this->getLocation($sf[$i]['openid']);
            if ($this->computeDis($pos_tar['lan'], $pos_fri['lan'], $pos_tar['long'], $pos_fri['long'])>1000){
                unset($sf[$i]);
            }
        }
        $this->assign("friend",$sf);
        $this->display();
    }
    //完善信息表单提交处理
    public function perfectInfo(){
        $imgName = session('info')['stuid'].time();
        $exixtUser = M('message')->where(array(
            "openid" => session('info')['openid']
        ))->select();
        $img = M('message')->where(array(
            'openid'=>session('info')['openid']
        ))->field('photo')->find();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = "./Public/";
        $upload->savePath = '/photos/'; // 设置附件上传目录
        $upload->saveName = $imgName;
        $upload->autoSub = false;
        // 上传文件
        $info = $upload->upload();
        $data = array(
            "name" => I('post.uname'),
            "sex" => I('post.ugender'),
            "college" => I("post.college"),
            "stuid" => session('info')['stuid'],
            "hometown" => I('post.hometown'),
            'contact' => I('post.connect'),
            'way' => I('post.ucv'),
            'introduce' => I('post.introduce'),
        );
        if ($info) {
            $data['photo'] = $imgName.$info['photo']['ext'];
            $data['has_img'] = 1;
            if ($img['photo']){
                unlink('Public/'.$img['photo']);
            }
        }
        if ($exixtUser){
            M('message')->where(array(
                "openid"=>session('info')['openid']
            ))->data($data)->save();
        } else {
            M('message')->where(array(
                "openid"=>session('info')['openid']
            ))->data($data)->add();
        }
        if(!$info) {// 上传错误提示错误信息
            $this->error("图片上传失败！");
        }else{// 成功
            $this->success('完善信息成功！');
        }
    }
    public function _after_perfectInfo(){
        $rel = M('message')->where(array(
            "openid" => session('info')['openid'],
        ))->find();
        $bool = true;
        for ($i=0; $i<9; $i++){
            if (!$rel[$i]) {
                $bool = false;
                break;
            }
        }
        if ($bool) {
            $data['perfect'] = 1;
        }
        $data['headimgurl'] = $this->getHeadImgUrl(session('info')['openid']);
        M('message')->where(array(
            'openid' => session('info')['openid'],
        ))->data($data)->save();
    }

    //完善信息页面
    public function information(){
        $this->assign("info",M('message')->where(array(
            "openid" => session('info')['openid'],
        ))->select());
        $this->display("information");
    }

    //显示详细信息页面
    public function showDetail(){
        $this->assign("info",M('message')->where(array(
            "id" => I('get.id'),
        ))->find());
        $this->display();
    }

    /*
     *
     * 一些前面判断、计算要用到的函数
     *
     * */

    //通过经纬度计算两点的距离，返回单位米
    public function computeDis($lat1, $lat2, $lung1, $lung2){
        $a = $lat1 - $lat2;
        $b = $lung1 - $lung2;
        $dis = 2*asin(sqrt(sin($a/2)*sin($a/2)+cos($lat1)*cos($lat2)*sin($b/2)*sin($b/2)))*6378137;
        return $dis;
    }
    /*
     *
     *判断该用户是否绑定了学号
     * 返回值是这个样子
     * object(stdClass)[6]
     * public 'status' => int 200
     * public 'info' => string 'success' (length=7)
     * public 'stuId' => string '2013211689' (length=10)
     *
     * */
    public function bindVerify($openid){
        $url = "http://Hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/bindVerify";
        $timestamp = time();
        $string = "";
        $arr = "abcdefghijklmnopqistuvwxyz0123456789ABCDEFGHIGKLMNOPQISTUVWXYZ";
        for ($i=0; $i<16; $i++) {
            $y = rand(0,41);
            $string .= $arr[$y];
        }
        $secret = sha1(sha1($timestamp).md5($string).'redrock');
        $post_data = array (
            "timestamp" => $timestamp,
            "string" => $string,
            "secret" => $secret,
            "openid" => $openid,
            "token" => "gh_68f0a1ffc303",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }
    /*
     *
     * 获得用户的经纬度
     * 接口返回值是这个样子
     * object(stdClass)[6]
     * public 'status' => string '-400' (length=4)
     * public 'info' => string 'success' (length=7)
     * public 'data' =>
     *     object(stdClass)[7]
     *     public 'openid' => string 'ouRCyjo24q67OUj5uH-e-ra_Jcp8' (length=28)
     *     public 'latitude' => string '29.535849' (length=9)
     *     public 'longitude' => string '106.605179' (length=10)
     *
     * */
    public function getLocation($openid){
        $url = "http://Hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/location";
        $timestamp = time();
        $string = "";
        $arr = "abcdefghijklmnopqistuvwxyz0123456789ABCDEFGHIGKLMNOPQISTUVWXYZ";
        for ($i=0; $i<16; $i++) {
            $y = rand(0,41);
            $string .= $arr[$y];
        }
        $secret = sha1(sha1($timestamp).md5($string).'redrock');
        $post_data = array (
            "timestamp" => $timestamp,
            "string" => $string,
            "secret" => $secret,
            "openid" => $openid,
            "token" => "gh_68f0a1ffc303",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        $rel = json_decode($output);
        return array(
            "lat" => $rel->data->latitude,
            "long" => $rel->data->longitude,
        );
    }
    /*
     *
     * 获得用户头像url
     * 返回url字符串
     *
     * */
    public function getHeadImgUrl(){
        $url = "http://Hongyan.cqupt.edu.cn/MagicLoop/index.php?s=/addon/Api/Api/userInfo";
        $timestamp = time();
        $string = "";
        $arr = "abcdefghijklmnopqistuvwxyz0123456789ABCDEFGHIGKLMNOPQISTUVWXYZ";
        for ($i=0; $i<16; $i++) {
            $y = rand(0,41);
            $string .= $arr[$y];
        }
        $secret = sha1(sha1($timestamp).md5($string).'redrock');
        $post_data = array (
            "timestamp" => $timestamp,
            "string" => $string,
            "secret" => $secret,
            "openid" => "ouRCyjo24q67OUj5uH-e-ra_Jcp8",
            "token" => "gh_68f0a1ffc303",
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        $rel = json_decode($output);
        return $rel->data->headimgurl;
    }
}