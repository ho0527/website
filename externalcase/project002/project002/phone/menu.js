let menu="off"

document.getElementById("menubutton").onclick=function(){
    if(menu=="on"){
        document.getElementById("menu").style.display="none"
        menu="off"
    }else{
        document.getElementById("menu").style.display="block"
        menu="on"
    }
}