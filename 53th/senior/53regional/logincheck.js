let file=location.href.split("53regional/")[1]
let id=localStorage.getItem("53regionaluserid")
let permission=localStorage.getItem("53regionalpermission")

if(file==""||file=="index.php"||file=="usererror.html"){
    if(id!=null){
        location.href="verify.php"
    }
}else if(file=="verify.php"){
    if(id==null){
        location.href="index.html"
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

document.getElementById("logout").onclick=function(){

}

startmacossection()