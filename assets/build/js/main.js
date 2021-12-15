jQuery(document).ready(function (t) {

    t('.flipbox').hover(function(){

        t(this).addClass('flip');
    },function(){
        t(this).removeClass('flip');
    });
});
