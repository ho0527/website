let time=document.getElementById("timer").value
let lightbox=document.getElementById("lightbox")

lightbox.style.display="none"
let timer=setInterval(updatetime,1000)

function updatetime(){
    time--
    if(time==0){
        time=0
        lightbox.style.display="block"
        clearInterval(time)
        setTimeout(function(){
            location.href="link.php?logout="
        },5000)
    }
    document.getElementById("timer").value=time
}