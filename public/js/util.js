const BASE_URL = "http://localhost/sistema/";


$(function () {
    function blinker() {
        $('.blink_me').fadeOut(500);
        $('.blink_me').fadeIn(500);
    }
    setInterval(blinker, 500);
});//]]> 