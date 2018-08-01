var stickymenu = document.getElementById("menu-top")
var stickymenuoffset = stickymenu.offsetTop
var scrolltimer

window.addEventListener("scroll", function(e){
    requestAnimationFrame(function(){
        if (window.pageYOffset > stickymenuoffset){
            stickymenu.classList.add('sticky')
        }
        else{
            stickymenu.classList.remove('sticky')
        }
    })
})

function showConsulta() {
	$("#formSearch").css(
                    {"visibility":"visible"}
                    );
}

function changeUnit(u1, u2) {
    $("#height_integer_label").html('Estatura (' + u1 + '):');
    $("#height_decimal_label").html('Estatura (' + u2 + '):');
}