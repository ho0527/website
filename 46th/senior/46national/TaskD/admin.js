let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=ajax.response
    if(!data){
        location.href="login.html"
    }
}