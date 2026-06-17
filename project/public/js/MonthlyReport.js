function ChangeTargetMonth(){
	document.getElementById("ChangeTargetMonth_fm").submit();
}

function ChangeShowClm(obj){
	let not_show_cmls = document.getElementsByClassName('not_show_cml');
	if(not_show_cmls[0].style.display=="none"){
		$('.not_show_cml').css('display', '');
		obj.textContent = '詳細非表示';
	}else{
		$('.not_show_cml').css('display', 'none');
		obj.textContent = '詳細表示';
	}
}