let split=location.href.split("=")
let key=split[split.length-1]
let ajax=new XMLHttpRequest()

ajax.onreadystatechange=function(){
    document.getElementById("context").innerHTML=this.responseText
}

if(key!="history"&&key!="event"&&key!="learning"){
    key="main"
}else{
    key="guitar_"+key
}

ajax.open("GET",key+".html",true)
ajax.send()