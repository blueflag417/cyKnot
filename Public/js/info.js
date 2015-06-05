/**
 * Created by Administrator on 2015/5/30.
 */
(function(W){
    var D = W.document, Each = [].forEach, wx = W.wx;
    //wexin js sdk 配置
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '', // 必填，公众号的唯一标识
        timestamp: , // 必填，生成签名的时间戳
        nonceStr: '', // 必填，生成签名的随机串
        signature: '',// 必填，签名，见附录1
        jsApiList: [] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });



    D.addEventListener('DOMContentLoaded', function(){
        //选择联系方式填写
        Each.call( $d('.js-c_way'), function(ele,i){
            (function(index){
                ele.addEventListener('change', function(){
                    var self = this, v = self.value;
                    Each.call( $d('option', self), function(ele, i){
                        if(ele.value == v){
                            //console.log();
                            var sl = ps(self), et = ele.innerText;
                            //console.log(sl);
                            $d('.js-label_way', sl)[0].innerText = et;
                            if(self.getAttribute('data-tag') === 'spec'){
                                var tip = $d('.js-way_tip')[0];
                                tip.value = '';
                                tip.placeholder = '请输入'+et;
                                 //&& (  );
                            }

                        }
                    });
                });
            })(i);
        });

        //提交表单
        $d('.js-form_sub')[0].addEventListener('touchstart', function(){
            var form = $d('#info_form')[0];
            if(form.uname.value.length === 0 && form.uname.placeholder.length === 0) {
                alert('请填写姓名');
                return false;
            }
            form.submit();
        });
    });

    $d('.js-up_hcon')[0].addEventListener('touchstart', function(){
        alert('touchstart');
    });


    function $d(s, c){
        return (c?c:D).querySelectorAll(s);
    }

    //去除文本节点
    function ps(n){
        var ret = n.previousSibling;
        while(ret.nodeType !== 1)ret = ret.previousSibling;
        return ret;
    }
})(window);