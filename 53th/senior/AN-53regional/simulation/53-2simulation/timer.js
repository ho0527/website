let timer=document.getElementById("timer").value
let lightbox=document.getElementsByClassName("lightbox")

lightbox[0].style.display="none"
let time=setInterval(function(e){
    timer--
    if(timer==0){
        clearInterval(time)
        lightbox[0].style.display="block"
        timer=0
        setTimeout(function(){
            location.href="link.php?logout="
        },5000);
    }
    document.getElementById("timer").value=timer
},1000)