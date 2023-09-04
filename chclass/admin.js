let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    if(!(data["success"]=="true"&&data["permission"]=="admin")){
        location.href="login.html"
    }
}

startmacossection()