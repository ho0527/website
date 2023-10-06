let file=location.href.split("49regional/")[1]
let id=localStorage.getItem("49regionalid")
let permission=localStorage.getItem("49regionalpermission")

if(file==""||file=="index.html"||file=="usererror.html"){
    if(id!=null){
        location.href="verify.php"
    }
}else if(file=="verify.php"){
    if(id==null){
        location.href="index.html"
    }
    if(id!="a0000"){
        location.href="main.html"
    }
}else if(file=="main.html"){
    if(id==null){
        location.href="index.html"
    }
}else{
    if(id==null||permission!="管理者"){
        location.href="index.html"
    }
}

startmacossection()