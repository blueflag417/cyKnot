<?php
namespace Home\Controller;
use Think\Controller;
class DemoController extends Controller{
    public function index(){
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
        //return $rel->data->headimgurl;
        dump($rel);
    }
    public function demo(){
        $this->display("index");
    }
    public function demo_act(){
        dump(M('message')->where(array('id'=>22))->find());
    }
    public function d(){
        echo time();
    }
}