let time=document.getElementById("timer")
let lightbox=document.getElementById("lightbox")
let timer
let s=document.getElementById("inputtime").value
let no=document.getElementById("no")

lightbox.style.display="none"

timer=setInterval(updatetimer,1000)
function updatetimer(){
    s--
    if(s==0){
        clearInterval(timer)
        setTimeout(function(){
            lightbox.style.display="block"
            time.value=0
            check()
        },100)
    }
    time.value=s
}

function check(){
    no.onclick=function(){
        location.href="link.php?logout"
    }
    setTimeout(function(){
        location.href="link.php?logout"
    },5000)
}
