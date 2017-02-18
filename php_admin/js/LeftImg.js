function setimgMiddle(){
	if (window.innerWidth){
			winWidth = window.innerWidth;
		}
	else if ((document.body) && (document.body.clientWidth)){
			winWidth = document.body.clientWidth;
		}
	if (window.innerHeight){
			winHeight = window.innerHeight;
		}
	else if ((document.body) && (document.body.clientHeight)){
			winHeight = document.body.clientHeight;
		}
	if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth){
			winHeight = document.documentElement.clientHeight;
			winWidth = document.documentElement.clientWidth;
		}
	$("imgLeft").style.marginTop=parseInt((parseInt(winHeight)-59)/2)+"px";
	$("line").style.height=winHeight+"px";
}
window.onload=window.onresize=setimgMiddle;