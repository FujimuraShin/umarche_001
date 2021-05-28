function BodyOnLoad(){
    var ratio=1;
    var w=document.getElementById('test').clientWidth;
    var h=document.getElementById('test').clientHeight;

    var touchstart_bar=0;
    var touchmove_bar=0;

    el=window;

    //タッチの場合
    el.addEventListener('touchstart',function(e){
        touchstart_bar=0;
        touchmove_bar=0;

        if(e.touches.length>1){
            window.alert("二本指でタッチした");
            //絶対値を取得
            w_abs_start=Math.abs(e.touches[1].pageX-e.touches[0].pageX);
            h_abs_start=Math.abs(e.touches[1].pageY-e.touches[0].pageY);
            //初めに２本指タッチした時の面積
            touchstart_bar=w*abs_start*h_abs_start;
        }else{
            
            window.alert("1本指でタッチした");
        }
        },false);

        //ムーブの場合
        el.addEventListener('touchmove',function(e){
            if(e.touchs_length>1){
                //絶対値を取得
                w_abs_move=Math.abs(e.touches[1].pageX-e.touches[0].pageX);
                h_abs_move=Math.abs(e.touches[1].pageY-e.touches[0].pageY);
                //ムーブした時の面積
                toucemove_bar=w_abs_move*h_abs_move;
                //初めに２タッチした面積からムーブした時の面積を引く
                area_bar=touchstart_bar-touchmove_bar;
                if(area_bar<0){
                    ratio *=0.9;
                }
                document.getElementById('test').width=w*ratio;
                document.getElementById('test').height=h*ratio;

            }
        });

}