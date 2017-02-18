function checkIE67(){
	browser=navigator.appName;
	if(browser=="Microsoft Internet Explorer"){
		browseVersion=navigator.appVersion.split(";")[1].replace(/[ ]/g,"");
		if(browseVersion=="MSIE7.0"||browseVersion=="MSIE6.0"){
			alert("请使用更高版本的浏览器");
			window.location.href="LoginOut.php";
		}
	}
}
function winLoadAndResize(){
	if(ifLeave=="1"){
		leave();
	}
	getWinWidthAndHeight();
	$("iframe").height=winHeight;
	right.moveDown(30);
	bg.resize();
}
if(window.ActiveXObject){
	window.attachEvent("onload",checkIE67);
	window.attachEvent("onload",winLoadAndResize);
	window.attachEvent("onresize",winLoadAndResize);
}else{
	window.addEventListener("load",winLoadAndResize,false);
	window.addEventListener("resize",winLoadAndResize,false);
}
function background(){
	this.showTimer=null;
	this.hiddenTimer=null;
	var self=this;
	this.resize=function(){
		if($("bg").style.display==""){
			$("bg").style.width=winWidth+"px";
			$("bg").style.height=winHeight+"px";
			$("bg").style.left="0px";
			$("bg").style.top="0px";
		}
	}
	this.show=function(){
		$("bg").style.display="";
		$("bg").style.width="0px";
		$("bg").style.height="0px";
		clearInterval(self.showTimer);
		self.showTimer=setInterval(self.show1,1);
	}
	this.show1=function(){
		//if(parseFloat($("bg").style.width)+50<winWidth){
//			lv=winHeight/winWidth;
//			$("bg").style.width=parseFloat($("bg").style.width)+50+"px";
//			$("bg").style.height=parseFloat($("bg").style.width)*lv+"px";
//			$("bg").style.left=parseInt((winWidth-parseFloat($("bg").style.width))/2)+"px";
//			$("bg").style.top=parseInt((winHeight-parseFloat($("bg").style.height))/2)+"px";
//		}else{
			$("bg").style.width=winWidth+"px";
			$("bg").style.height=winHeight+"px";
			$("bg").style.left="0px";
			$("bg").style.top="0px";
			clearInterval(self.showTimer);
		//}	
	}
	this.hidden=function(){
		clearInterval(self.hiddenTimer);
		self.hiddenTimer=setInterval(self.hidden1,1);
	}
	this.hidden1=function(){
		//if(parseFloat($("bg").style.width)-50>0){
//			lv=winHeight/winWidth;
//			$("bg").style.width=parseFloat($("bg").style.width)-50+"px";
//			$("bg").style.height=parseFloat($("bg").style.width)*lv+"px";
//			$("bg").style.left=parseInt((winWidth-parseFloat($("bg").style.width))/2)+"px";
//			$("bg").style.top=parseInt((winHeight-parseFloat($("bg").style.height))/2)+"px";
//		}else{
			$("bg").style.width=0+"px";
			$("bg").style.height=0+"px";
			$("bg").style.left="0px";
			$("bg").style.top="0px";
			clearInterval(self.hiddenTimer);
		//}	
	}
}
function right(){
	this.moveTimer=null;
	var self=this;
	this.moveTimes=0;
	this.hasMoveTimes=0;
	this.cellDistance=10;
	this.moveDown=function(moveTimes){
		$("right").style.display="";
		$("right").style.width="57px";
		$("right").style.left=winWidth-parseInt($("right").style.width)+"px";
		$("right").style.top=-parseInt($("right").style.height)+"px";
		self.hasMoveTimes=0;
		self.moveTimes=moveTimes;
		self.cellDistance=parseInt(parseInt($("right").style.top)-(winHeight-parseInt($("right").style.height))/2)/moveTimes;
		clearInterval(self.moveTimer);
		self.moveTimer=setInterval(self.moveDown1,5);
		self.waitSeconds=3000;
	}
	this.moveDown1=function(){
		if(self.hasMoveTimes<self.moveTimes+5){
			$("right").style.top=parseInt($("right").style.top)-self.cellDistance+"px";
		}else if(self.hasMoveTimes<self.moveTimes+10){
			$("right").style.top=parseInt($("right").style.top)+self.cellDistance+"px";
		}else{
			$("right").style.top=(winHeight-parseInt($("right").style.height))/2+"px";
			clearInterval(self.moveTimer);
			setTimeout("right.waitSeconds=0;right.showOrHidden("+false+")",right.waitSeconds);
		}
		self.hasMoveTimes+=1;
	}
	this.waitSeconds=3000;
	this.lock=false;
	this.showTimer=null;
	this.ifShow=1;
	this.showOrHidden=function(ifShow){
		if(!self.lock&&self.waitSeconds==0){
			self.ifShow=ifShow;
			clearInterval(self.showTimer);
			self.lock=true;
			self.showTimer=setInterval(self.showOrHidden1,10);
		}
	}
	this.showOrHidden1=function(){
		if(self.ifShow){
			if(parseInt($("right").style.width)<57){
				$("right").style.width=parseInt($("right").style.width)+3+"px";
				$("right").style.left=parseInt($("right").style.left)-3+"px";
			}
		}else{
			if(parseInt($("right").style.width)>0){
				$("right").style.width=parseInt($("right").style.width)-3+"px";
				$("right").style.left=parseInt($("right").style.left)+3+"px";
			}
		}
		if(parseInt($("right").style.width)>=57||parseInt($("right").style.width)<=0){
			clearInterval(self.showTimer);
			self.lock=false;
		}
	}
}
function windows(){
	var self=this;
	this.win1MaxWidth=362;
	this.win1MaxHeight=173;
	this.win1EvalStr="";
	this.inital=function(){
		self.win1Hidden();
		self.win2Hidden();
	}
	this.win1Show=function(title,content,evalStr,ifShowCncleButton){
		self.inital();
		self.win1EvalStr=evalStr;
		$("win1Title").innerHTML=title;
		$("win1Content").innerHTML=content;
		$("win1").style.display="";
		ifShowCncleButton?$("win1CancleButton").style.display="":$("win1CancleButton").style.display="none";
		$("win1").style.width=self.win1MaxWidth+"px";
		$("win1").style.height=self.win1MaxHeight+"px";
		$("win1").style.left=(winWidth-parseInt($("win1").style.width))/2+"px";
		$("win1").style.top=(winHeight-parseInt($("win1").style.height))/2+"px";
	}
	this.win1Hidden=function(){
		$("win1").style.display="none";
		self.win1EvalStr="";
		bg.hidden();
	}
	this.win1Eval=function(){
		if(self.win1EvalStr!=""){
			eval(self.win1EvalStr);
		}
		self.win1Hidden();
	}
	
	XmlHttpRequest.call(this);
	this.win2MaxWidth=362;
	this.win2MaxHeight=173;
	this.win2EvalStr="";
	this.win2Show=function(title,content,evalStr){
		self.inital();
		self.win2EvalStr=evalStr;
		$("win2Title").innerHTML=title;
		$("win2Err").innerHTML=content;
		$("win2").style.display="";
		$("win2").style.width=self.win2MaxWidth+"px";
		$("win2").style.height=self.win2MaxHeight+"px";
		$("win2").style.left=(winWidth-parseInt($("win2").style.width))/2+"px";
		$("win2").style.top=(winHeight-parseInt($("win2").style.height))/2+"px";
		self.set("window.location.href='LoginOut.php'");
		self.sendPost("Leave.php",Math.random(),"");
	}
	this.win2Eval=function(){
		if(self.win2EvalStr!=""){
			eval(self.win2EvalStr);
		}
	}
	this.win2Hidden=function(){
		$("win2").style.display="none";
		$("win2Err").innerHTML="";
		$("win2Password").value="";
		self.win2EvalStr="";
		bg.hidden();
	}
	this.win2CheckPassword=function(){
		password=$("win2Password").value;
		if(password==""){
			$("win2Err").innerHTML="请输入密码";
		}else if(password.match(/^\w{5,15}$/)==null){
			$("win2Err").innerHTML="密码格式错误";
		}else{
			$("win2Err").innerHTML="<img src='images/loading.gif' /><span style='color:#333'>验证中...</span>";
			self.set("window.location.href='LoginOut.php'");
			self.sendPost("CheckPassword.php","password="+password+"&"+Math.random(),"self.win2CallBackFun()");
		}
	}
	this.win2CallBackFun=function(){
		switch(self.xml.responseText){
			case "-1":
				window.location.href="LoginOut.php";
				break;
			case "-2":
				$("win2Err").innerHTML="密码格式错误";
				break;
			case "-3":
				$("win2Err").innerHTML="密码错误，请重新输入";
				$("win2Password").value="";
				break;
			case "1":
				self.win2Hidden();
				break;
			default:
		}
	}
	
	this.win3MaxWidth=200;
	this.win3MaxHeight=50;
	this.win3EvalStr="";
	this.win3Timer=null;
	this.win3Show=function(type,content,evalStr){
		self.win3EvalStr=evalStr;
		type==1?$("win3Img").innerHTML="<img src='images/dui.png'>":$("win3Img").innerHTML="<img src='images/cuo.png'>";
		$("win3Content").innerHTML=content;
		$("win3").style.left=(winWidth-self.win3MaxWidth)/2+"px";
		$("win3").style.top=(winHeight-self.win3MaxHeight)/2+"px";
		$("win3").style.display="";
		self.win3Eval();
		self.win3Timer=setTimeout(self.win3Hidden,1000);
	}
	this.win3Eval=function(){
		if(self.win3EvalStr!=""){
			eval(self.win3EvalStr);
		}
	}
	this.win3Hidden=function(){
		$("win3").style.display="none";
		bg.hidden();
	}
	
}

function exit(){
	window.win1.win1Show("提示","您确定要退出吗？","window.location.href='LoginOut.php'",true);
	window.bg.show();
}
function leave(){
	window.win2.win2Show("提示","请输入密码","win2.win2CheckPassword()");
	window.bg.show();
}
document.onkeydown=function(e){ 
	var e=e||window.event; 
	if(e.keyCode==13){
		if($("win1").style.display==""){
			win1.win1Eval();
		}
		if($("win2").style.display==""){
			win2.win2Eval();
		}
	}
}



