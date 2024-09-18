function reportError(msg,url,line){
line-=0;
var str='You have found an error as below: \n\n';
str+='Err:'+msg+'on line:'+(line);
alert(str);
window.onerror = null;
return true;
}

window.onerror=reportError;

var IE=document.all,NS4=document.layers;
var NS6=(!IE&&document.getElementById), NS=(NS4||NS6);

xmlHttp = false;

function CreatexmlHttp(){
	var xmlHttp = false;
	try{
	   xmlHttp = new XMLHttpRequest();
	}catch(trymicrosoft){
	   try{
	      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch(othermicrosoft){
	       try{
		      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		   }catch(failed){
		      xmlHttp = false;
		   }
	   }
	}
	return xmlHttp;
}

function VarExists(v){
      if(!v || v == 'undefined') return true;
	  return false;
}

//能用 ID
function $(ID){
	if (!IE && !NS) return false;
    var obj = document.getElementById(ID);
	if(obj == null || obj == '') return false;
	return obj;
}

//返回FORM 中的一个值 type可用与 input等

function GetVal(ID){
    var obj = $(ID);
	if(obj !== false) return obj.value;
	else return '';
}

//隐藏对像
function HiddenObject(ID){
   var Node = $(ID);
   if(Node){
        Node.style.visibility = "hidden";
        Node.style.display = 'none';
   }
}
//显示对像
function BlockObject(ID){
    var Node = $(ID);
	if(Node){
	   Node.style.visibility = "visible";
       Node.style.display = 'block';
	}
}

function GetFormElementsValues(FormName){
   var form = $(FormName);
   var ele = form.elements;
   var str = '';
   
   for(var i=0;i<ele.length;i++){
      if(i > 0) str +='&';
	  var f = ele[i];
	  str += f.name+'=';
	  //if(f.type == 'hidden') continue ;
	  if((f.type == 'select-one') || (f.type == 'select-multiple')){ 
	     if(f.options.length > 0 ){
		   str += f.options[f.options.selectedIndex].value;  //only select-one !
	     }
	  }else if(f.type == 'textarea'){
	     str += f.value;
	  }else{
	     str += f.value ;
	  }
	  
   }
   return str;
}


function GetFormElementsStr(FormName){
  return GetFormElementsValues(FormName);
}