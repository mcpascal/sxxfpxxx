function CheckValueNotAlert(){
	this.checkNull=function (name,val){
		if(trim(String(val))==""){
			window.top.win1.win1Show("提示",name+"不能为空！","",false);
			window.top.bg.show();
			return true;
		}else{
			return false;	
		}
	}
	this.checkLen=function (name,val,len){
		if(trim(String(val)).length>len){
			window.top.win1.win1Show("提示",name+"过长！","",false);
			window.top.bg.show();
			return false;	
		}else{
			return true;	
		}
	}
	this.checkReg=function (name,val,reg){
		if(String(val).match(reg)==null){
			window.top.win1.win1Show("提示",name+"格式错误！","",false);
			window.top.bg.show();
			return false;	
		}else{
			return true;	
		}
	}
	this.checkEqual=function (val,val1,message){
		if(val!=val1){
			window.top.win1.win1Show("提示",message,"",false);
			window.top.bg.show();
			return false;	
		}else{
			return true;	
		}
	}
	this.msg=function(message){
		window.top.win1.win1Show("提示",message,"",false);
		window.top.bg.show();
	}
}
try{
	document.onkeydown=function(e){ 
		var e=e||window.event; 
		if(e.keyCode==13){
			if(window.top.$("win1").style.display==""){
				window.top.win1.win1Eval();
				return false;
			}
		}
	}	
}catch(err){}
