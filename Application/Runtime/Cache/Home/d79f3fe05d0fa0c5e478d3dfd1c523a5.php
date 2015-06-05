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
    <form action="/cyKnot/Home/Index/perfectInfo" method="post" id="info_form">
        <div class="m-inputs">
            <div class="item"><!--姓名-->
                <span class="filed_name">姓名</span>
                <input type="text" class="need_input" name="uname" <?php if($info[0]['name']): ?>value=<?php echo ($info[0]['name']); else: ?>placeholder='输入姓名'<?php endif; ?> /><!--默认的姓名-->
            </div>
            <div class="item">
                <span class="filed_name">姓别</span>
                <span class="de_label">
                    <?php if($info[0]['sex']): echo ($info[0]['sex']); ?>
                        <?php else: ?>
                        男<?php endif; ?>
                    <i class="s-arrow"></i></span>
                <select name="ugender" id="s_sex" class="select_cahnge">
                    <option value="">男</option>
                    <option value="">女</option>
                </select>
            </div>
            <div class="item contact_way f-cb">
                <span class="filed_name">专业</span>
                <span class="exists_default">
                    <?php if($info[0]['college']): echo ($info[0]['college']); ?>
                        <?php else: ?>
                        填入学院<?php endif; ?>
                </span>
            </div>
            <div class="item">
                <span class="filed_name">家乡 </span>
                <span class="de_label">
                    <?php if($info[0]['hometown']): echo ($info[0]['hometown']); ?>
                        <?php else: ?>
                        重庆<?php endif; ?>
                    <i class="s-arrow"></i></span>
                <select name="hometown" id="" class="select_cahnge">
                    <option value="北京">北京</option>
                    <option value="上海">上海</option>
                    <option value="天津">天津</option>
                    <option value="重庆">重庆</option>
                    <option value="黑龙江">黑龙江</option>
                    <option value="吉林">吉林</option>
                    <option value="辽宁">辽宁</option>
                    <option value="江苏">江苏</option>
                    <option value="山东">山东</option>
                    <option value="安徽">安徽</option>
                    <option value="河北">河北</option>
                    <option value="河南">河南</option>
                    <option value="湖北">湖北</option>
                    <option value="湖南">湖南</option>
                    <option value="江西">江西</option>
                    <option value="山西">山西</option>
                    <option value="陕西">陕西</option>
                    <option value="四川">四川</option>
                    <option value="青海">青海</option>
                    <option value="海南">海南</option>
                    <option value="广东">广东</option>
                    <option value="贵州">贵州</option>
                    <option value="浙江">浙江</option>
                    <option value="福建">福建</option>
                    <option value="台湾">台湾</option>
                    <option value="甘肃">甘肃</option>
                    <option value="云南">云南</option>
                    <option value="内蒙古">内蒙古</option>
                    <option value="宁夏">宁夏</option>
                    <option value="新疆">新疆</option>
                    <option value="西藏">西藏</option>
                    <option value="云南">云南</option>
                </select>
            </div>
            <div class="item">
                <span class="filed_name">联系方式</span>
                <span class="de_label js-label_way">
                    <?php if($info[0]['contact']): echo ($info[0]['contact']); ?>
                        <?php else: ?>
                        微信<?php endif; ?>
                    <i class="s-arrow"></i></span>
                <select name="connect" id="" class="select_cahnge js-c_way">
                    <option value="1">微信</option>
                    <option value="2">电话号码</option>
                    <option value="3">邮箱</option>
                </select>
            </div>
            <div class="s-c_way">
                <input type="text" name="ucv"
                <?php if($info[0]['way']): ?>value=<?php echo ($info[0]['way']); else: ?>placeholder='输入号码'<?php endif; ?>
                       class="js-way_tip"/>
            </div>
            <div class="item">
                <span class="filed_name">简介</span>
                <input name="introduce" type="text" class="need_input"
                <?php if($info[0]['introduce']): ?>value=<?php echo ($info[0]['introduce']); else: ?>placeholder='输入简介'<?php endif; ?> />
            </div>
            <div class="upload_img">上传图片</div>
        </div>
    </form>
</div>
</body>
<script src="/cyKnot/Public/js/info.js"></script>
</html>