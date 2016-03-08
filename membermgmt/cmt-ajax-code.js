function ajaxFunction(myForm)
{
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
//alert(" Here ");

document.getElementById("txtHint").innerHTML=httpxml.responseText;
document.getElementById("myForm").reset();
document.getElementById("txtHint").style.background='#f1f1f1';
document.getElementById("txtHint").style.display='inline';

      }
    }
function getFormData() { 
//getElementByID(myForm);
var myParameters = new Array(); 

var str1=document.getElementById("cmt_todo").value;
str1 = "cmt_todo="+encodeURIComponent(str1);
myParameters.push(str1); 
/////
var str1=document.getElementById("mem_id").value;
str1 = "mem_id="+encodeURIComponent(str1);
myParameters.push(str1); 
//alert(str1);
/////

var str1=document.getElementById("dtl").value;
str1 = "dtl="+encodeURIComponent(str1);
myParameters.push(str1); 
//alert(myParameters.join("&"));
return myParameters.join("&"); 
} 



	var url="cmt-ajax-formck.php";
//var myForm = document.forms[0]; 

var parameters=getFormData();
httpxml.onreadystatechange=stateChanged;
httpxml.open("POST", url, true)
httpxml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
httpxml.send(parameters)  

document.getElementById("txtHint").style.background='#ffffcc';
document.getElementById("txtHint").innerHTML="Data Processing ....";
document.getElementById("txtHint").style.display='inline';

}

function hidemsg(){
document.getElementById("txtHint").style.display='none';

}
