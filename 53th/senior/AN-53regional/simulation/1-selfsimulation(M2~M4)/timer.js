let timer=document.getElementById("timer")
let t=document.getElementById("time").value
let ask=document.getElementById("ask")
let time

ask.style.display="none"

time=setInterval(timers,1000)

function timers(){
    t--
    if(t==0){
        clearInterval(time)
        setTimeout(() => {
            timer.value=0
            check()
        }, 100);
    }
    timer.value=t
}


function check(){
    ask.style.display="block"
    setTimeout(() => {
        location.href="link.php?logout"
    }, 5000)
}