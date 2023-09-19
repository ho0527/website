let admin=false

let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    if(!(data["success"]=="true"&&data["permission"]=="user")){
        location.href="login.html"
    }
}

startmacossection()