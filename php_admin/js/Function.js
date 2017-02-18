var winWidth=0,winHeight=0,lv;
function $(elementId){
	return document.getElementById(elementId);	
}
function $$(elementId){
	if(document.getElementById(elementId))
		return true;
	else
		return false;
}
function getWinWidthAndHeight(){
	winWidth=document.documentElement.clientWidth;
	window.innerHeight?winHeight=window.innerHeight:winHeight=document.documentElement.clientHeight;
}
function trim(str){   
    return str.replace(/^(\s|\u00A0)+/,'').replace(/(\s|\u00A0)+$/,'');   
} 