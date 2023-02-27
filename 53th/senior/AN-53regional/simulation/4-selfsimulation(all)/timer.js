let timer=document.getElementById("timer").value
let lightbox=document.getElementById("lightbox")

lightbox.style.display="none"
let time=setInterval(updatetime,1000)
function updatetime(){
    timer--
    if(timer==0){
        clearInterval(time)
        time=0
        lightbox.style.display="block"
        setTimeout(function(){
           location.href="link.php?logout=" 
        },5000);
    }
    document.getElementById("timer").value=timer
}
