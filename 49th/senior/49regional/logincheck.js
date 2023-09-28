let location=location.href.split("49regional/")[1]
let id=localStorage.getItem("49regionalid")
let permission=localStorage.getItem("49regionalpermission")

if(location==""||location=="index.html"||location=="usererror.html"){
    if(id!=null){
        location.href="verify.php"
    }
}else if(location=="verify.php"){
    if(id==null){
        location.href="index.php"
    }
    if(id!=1){
        location.href="main.php"
    }
}else if(location=="main.php"||location=="search.php"){
    if(id==null){
        location.href="index.php"
    }
}else{
    if(id==null||permission!="管理者"){
        location.href="index.php"
    }
}