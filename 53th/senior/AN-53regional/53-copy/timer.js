let timer=document.getElementById("timer").value
let lightbox=document.getElementById("lightbox")

lightbox.style.display="none"

let time=setInterval(updatetime,1000)

function updatetime(){
    timer--
    if(timer==0){
        clearInterval(timer)
        lightbox.style.display="block"
        timer=0
        setTimeout(function(){
            location.href="link.php?logout="
        },5000);
    }
    document.getElementById("timer").value=timer
}