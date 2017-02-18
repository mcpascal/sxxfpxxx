function changeTrbk(id){
	trid="tr"+id;
	$(trid).className="trBg";
}
function changeTrbk1(id){
	trid="tr"+id;
	$(trid).className="trBg1";
}
function getImg(imgid,newsrc){
	$(imgid).src=newsrc;
}
function showBigImg(e,smallImg){
	$("big_img_div").style.display="";
	$("big_img").src=$(smallImg).src;
	e=e||event;
	x=e.clientX;
	y=e.clientY;
	$("big_img_div").style.left=x+1+"px";
	$("big_img_div").style.top=y+1+"px";
}
function hiddenBigImg(){
	$("big_img_div").style.display="none";
	$("big_img").src="";
}
function goToPage(){
	var selectd = $("goToPage");  
	var index = selectd.selectedIndex;  
	window.open(selectd.options[index].value,"_self");
}