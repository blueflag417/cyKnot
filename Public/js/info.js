/**
 * Created by Administrator on 2015/5/30.
 */
(function(W){
    var D = W.document, Each = [].forEach;

    D.addEventListener('DOMContentLoaded', function(){
        //选择联系方式填写
        Each.call( $d('.js-c_way'), function(ele,i){
            (function(index){
                ele.addEventListener('change', function(){
                    var self = this, v = self.value;
                    Each.call( $d('option', self), function(ele, i){
                        if(ele.value == v){
                            var sl = ps(self), et = ele.innerText;
                            $d('.js-label_way', sl)[0].innerText = et;
                            index === 2 && ( $d('.js-way_tip')[0].placeholder = '请输入'+et );
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

    function $d(s, c){
        //console.log(c);
        return (c?c:D).querySelectorAll(s);
    }

    //去除文本节点
    function ps(n){
        var ret = n.previousSibling;
        while(ret.nodeType !== 1)ret = ret.previousSibling;
        return ret;
    }
})(window);