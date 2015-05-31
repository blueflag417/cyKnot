//var d = document;
//d.addEventListener('DOMContentLoaded', load);
//
//function load(){
//    if(!drop()) return false;
//    var c_f = $d('#f_bg')[0], ctx = c_f.getContext('2d');
//    c_f.width = d.body.clientWidth;
//    c_f.height = c(172);
//    c_f.style.border = '1px solid red';
//
//    if(!ctx)return false;
//    draw();
//
//    //绘制
//    function draw(){
//        ctx.moveTo(0,c(79));
//        ctx. quadraticCurveTo(c(350), c(89), c_f.width, c(52) );
//        ctx.lineTo( c_f.width, c_f.height);
//        ctx.lineTo(0, c_f.height);
//        ctx.fillStyle = '#fff';
//        ctx.fill();
//    }
//
//    //优雅降级
//    function drop(){
//        var gH = $d('.g-container')[0].offsetHeight,
//                fH = c(172);
//        if(fH+ fH > document.body.clientHeight){
//            return false;
//        }
//        return true;
//    }
//
//    //计算
//    function c(v){
//        return v/640 *  ( c_f.width > 540 ? 540:c_f.width)
//    }
//}
//
////辅助函数
//function $d(s){
//    return d.querySelectorAll(s);
//}