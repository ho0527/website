let timer=document.getElementById("timer").value
let lightbox=document.querySelector(".lightbox")

lightbox.style.display="none"
let time=setInterval(function(){
    timer--
    if(timer==0){
        timer=0
        clearInterval(time)
        lightbox.style.display="block"
        setTimeout(function(){
            location.href="link.php?logout="
        },5000)
    }
    document.getElementById("timer").value=timer
},1000)