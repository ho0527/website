let file=location.href.split("53regional/")[1]
let id=localStorage.getItem("53regionaluserid")
let permission=localStorage.getItem("53regionalpermission")

if(file==""||file=="index.php"||file=="usererror.html"){
    if(id!=null){
        location.href="verify.php"
    }
}else if(file=="verify.php"){
    if(id==null){
        location.href="index.php"
    }
}else if(file=="main.php"){
    if(id==null){
        location.href="index.php"
    }
}else{
    if(id==null||permission!="管理者"){
        location.href="index.html"
    }
}

startmacossection()