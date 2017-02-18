function CheckValue(){
	this.checkNull=function (name,val){
		if(trim(String(val))==""){
			alert(name+"不能为空！");
			return true;	
		}else{
			return false;	
		}
	}
	this.checkLen=function (name,val,len){
		if(trim(String(val)).length>len){
			alert(name+"过长！");
			return false;	
		}else{
			return true;	
		}
	}
	this.checkReg=function (name,val,reg){
		if(String(val).match(reg)==null){
			alert(name+"格式错误！");
			return false;	
		}else{
			return true;	
		}
	}
}