window.onscroll = function(){
if($(window).scrollTop() === 0){
    $(".nav-item a").css("color", "#fff");
    $(".navbar-brand").css("color", "#fff");
    $("nav").css("background","#ffffff00");
}
else{
    $(".nav-item a").css("color", "#000");
    $(".navbar-brand").css("color", "#000");
    $("nav").css("background","#ffffffcf");
}};
