let time=document.getElementById("timer").value
let lightbox=document.getElementById("lightbox")
let no=document.getElementById("no")

lightbox.style.display="none"

let timer=setInterval(updatetime,1000)
function updatetime(){
    time--
    if(time==0){
        clearInterval(timer)
        time=0
        setTimeout(function(){
            lightbox.style.display="block"
            check()
        },100);
    }
    document.getElementById("timer").value=time
}

function check(){
    no.onclick=function(){
        location.href="link.php?logout="
    }
    setTimeout(function(){
        location.href="link.php?logout="
    },5000)
}