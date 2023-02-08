let link=document.querySelectorAll("#link")
let onoffbutton=document.querySelectorAll("#onoff")
let fb=document.querySelectorAll("#fb")
let twitter=document.querySelectorAll("#twitter")
let youtube=document.querySelectorAll("#youtube")

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

fb[0].onclick=function(){
    location.href="https://www.facebook.com/"
}

twitter[0].onclick=function(){
    location.href="https://www.twitter.com/"
}

youtube[0].onclick=function(){
    location.href="https://www.youtube.com/"
}
