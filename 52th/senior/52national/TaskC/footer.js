let link=document.querySelectorAll("#link")
let onoffbutton=document.querySelectorAll("#onoff")

link[0].style.display="block"

onoffbutton[0].onclick=function(){
    if(link[0].style.display=="block"){
        link[0].style.display="none"
        onoffbutton[0].innerHTML=`開啟footer`
    }else{
        link[0].style.display="block"
        onoffbutton[0].innerHTML=`關閉footer`
    }
}