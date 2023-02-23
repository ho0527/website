let time=document.getElementById("timer").value
let lightbox=document.getElementById("lightbox")

lightbox.style.display="none"

let timer=setInterval(timerdef,1000)

function timerdef(){
    time--
    if(time==0){
        clearInterval(timer)
        time=0
        lightbox.style.display="block"
        setTimeout(function(){
            location.href="link.php?logout="
        },5000)
    }
    document.getElementById("timer").value=time
}