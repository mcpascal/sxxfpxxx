var winWidth=0,winHeight=0,winScrollTop=0;
function $$(elementId){
	return document.getElementById(elementId);	
}
function $$$(elementId){
	if(document.getElementById(elementId))
		return true;
	else
		return false;
}
function getWinWidthAndHeight(){
	winWidth=document.documentElement.clientWidth;
	window.innerHeight?winHeight=window.innerHeight:winHeight=document.documentElement.clientHeight;
	document.documentElement.scrollTop>document.body.scrollTop?winScrollTop=document.documentElement.scrollTop:winScrollTop=document.body.scrollTop;
}

function code(){
	getWinWidthAndHeight();
	$$("code").style.left = (winWidth-100)+"px";
	$$("code").style.top = winHeight-101+winScrollTop+"px";
	$$("code").style.display = "";
	
}

if(window.ActiveXObject){
	window.attachEvent("onload",code);
	window.attachEvent("onresize",code);
	window.attachEvent("onscroll",code);
}else{
	window.addEventListener("load",code,false);
	window.addEventListener("resize",code,false);
	window.addEventListener("scroll",code,false);
}



function trim(str){   
    return str.replace(/^(\s|\u00A0)+/,'').replace(/(\s|\u00A0)+$$/,'');   
} 
//加入收藏
function addFavorite(sURL, sTitle) {
	sURL = encodeURI(sURL); 
	try{   
		window.external.addFavorite(sURL, sTitle);   
	}catch(e) {   
		try{   
			window.sidebar.addPanel(sTitle, sURL, "");   
		}catch (e) {   
			alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
		}   
	}
}
//设为首页
function setHome(url){
	if (document.all) {
		document.body.style.behavior='url(#default#homepage)';
		   document.body.setHomePage(url);
	}else{
		alert("您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页!");
	}
}
function goToPage(){
	var selectd = $$("gotopage");  
	var index = selectd.selectedIndex;  
	window.open(selectd.options[index].value,"_self");
}