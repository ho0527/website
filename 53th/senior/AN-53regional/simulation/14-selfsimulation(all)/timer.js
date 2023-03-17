let timer=document.getElementById("timer").value
let lightbox=document.getElementsByClassName("lightbox")

lightbox[0].style.display="none"
let time=setInterval(function(){
    timer--
    if(timer==0){
        timer=0
        clearInterval(timer)
        timer=0
        lightbox[0].style.display="block"
        timer=0
        setTimeout(function(){
            location.href="link.php?logout="
        },5000)   
    }
    document.getElementById("timer").value=timer
},1000)