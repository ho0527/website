let ajax=new XMLHttpRequest()

ajax.onreadystatechange=function(){
    document.getElementById("context").innerHTML=this.responseText
}

ajax.open("GET","main.html",true)
ajax.send()