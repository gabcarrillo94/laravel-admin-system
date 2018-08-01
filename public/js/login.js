$(document).ready(function() {
	var formInputs = $('input[type="email"],input[type="password"]');
	var bg_rdm = Math.floor(Math.random() * 2);
	
	formInputs.focus(function() {
       $(this).parent().children('p.formLabel').addClass('formTop');
       $('div#formWrapper').addClass('darken-bg');
       $('div.logo').addClass('logo-active');
	});
	
	formInputs.focusout(function() {
		if ($.trim($(this).val()).length == 0){
		$(this).parent().children('p.formLabel').removeClass('formTop');
		}
		$('div#formWrapper').removeClass('darken-bg');
		$('div.logo').removeClass('logo-active');
	});
	
	$('p.formLabel').click(function(){
		 $(this).parent().children('.form-style').focus();
	});
	
	if (bg_rdm===0) {
        $('body').css('background-image',
					  'url(http://foreverfitbylv.com/wp-content/uploads/2018/06/banner-primero-1024x512.jpg)');
    }
	else if (bg_rdm===1) {
        $('body').css('background-image',
					  'url(http://foreverfitbylv.com/wp-content/uploads/2018/06/banner-segundo-1-1024x512.jpg)');
    }
	else {
		$('body').css('background-image',
					  'url(http://foreverfitbylv.com/wp-content/uploads/2018/06/banner-tercero-1-1024x512.jpg)');
	}
	
});

function checkBodyType(radioBtn) {
	document.getElementById(radioBtn).checked = true;
}