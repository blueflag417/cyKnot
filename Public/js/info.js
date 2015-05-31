/**
 * Created by Administrator on 2015/5/30.
 */
(function(W){
    var D = W.document, Each = [].forEach;

    D.addEventListener('DOMContentLoaded', function(){
        //选择联系方式填写
        $d('.js-c_way')[0].addEventListener('change', function(){
            var self = this, v = self.value;
            Each.call( $d('option', self), function(ele, i){
                if(ele.value == v)
                    $d('.js-way_tip')[0].placeholder = $d('.js-label_way')[0].innerText = ele.innerText;
            });
        });

        //提交表单
        $d('.js-form_sub')[0].addEventListener('click', function(){
            var form = $d('#info_form')[0];
            if(form.uname.value.length === 0 && form.uname.placeholder.length === 0) {
                alert('请填写姓名');
                return false;
            }
            form.submit();
        });
    });

    function $d(s, c){
        return (c?c:D).querySelectorAll(s);
    }
})(window);