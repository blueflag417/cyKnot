<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>信息</title>
    <script src="/cyKnot/Public/js/lib/init.js"></script>
    <link rel="stylesheet" type="text/css" href="/cyKnot/Public/css/lib/base.css">
    <link rel="stylesheet" type="text/css" href="/cyKnot/Public/css/info.css">
</head>
<body>
<div class="s-wrap">
    <header class="u-menu">
        <a href="javascript:history.back()" class="u-left"></a>
        <a class="f-sub js-form_sub" href="javascript:void(0)">完成</a>
        <span>完善或修改信息</span>
    </header>
    <form action="/cyKnot/Home/perfectInfo" method="post" id="info_form">
        <div class="m-inputs">
            <div class="item"><!--姓名-->
                <span class="filed_name">姓名</span>
                <input type="text" class="need_input" name="uname" placeholder="<?php echo ($info[0]['name']?$info[0]['name']:姓名); ?>"/><!--默认的姓名-->
            </div>
            <div class="item">
                <span class="filed_name">姓别</span>
                <span class="de_label"><?php echo ($info[0]['sex']?$info[0]['sex']:男); ?><i class="s-arrow"></i></span>
                <select name="ugender" id="s_sex" class="select_cahnge">
                    <option value="">男</option>
                    <option value="">女</option>
                </select>
            </div>
            <div class="item contact_way f-cb">
                <span class="filed_name">专业</span>
                <span class="exists_default"> <?php echo ($info[0]['profession']?$info[0]['profession']:计算机学院); ?> </span>
            </div>
            <div class="item">
                <span class="filed_name">家乡 </span>
                <span class="de_label"><?php echo ($info[0]['hometown']?$info[0]['hometown']:重庆); ?><i class="s-arrow"></i></span>
                <select name="" id="" class="select_cahnge">
                    <option value="">重庆</option>
                    <option value="">北京</option>
                    <option value="">湖北</option>
                </select>
            </div>
            <div class="item">
                <span class="filed_name">联系方式</span>
                <span class="de_label js-label_way"><?php echo ($Info[0]['contact']?$info[0]['contact']:微信); ?><i class="s-arrow"></i></span>
                <select name="connect" id="" class="select_cahnge js-c_way">
                    <option value="1">微信</option>
                    <option value="2">电话号码</option>
                    <option value="3">邮箱</option>
                </select>
            </div>
            <div class="s-c_way">
                <input type="text" name="ucv" placeholder="<?php echo ($info[0]['way']?$info[0]['way']:输入微信号); ?>" class="js-way_tip"/>
            </div>
            <div class="item">
                <span class="filed_name">简介</span>
                <input type="text" class="need_input"  placeholder="<?php echo ($info[0]['introduce']?$info[0]['introduce']:输入简介); ?>" />
            </div>
            <div class="upload_img">上传图片</div>
        </div>
    </form>
</div>
</body>
<script src="/cyKnot/Public/js/info.js"></script>
</html>