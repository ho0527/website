let seconds=document.getElementById("changetimer").value
let asktimer=5

document.getElementById("ask").style.display="none"

let timerInterval=setInterval(updateTimer,1000)
document.getElementById("resetbutton").onclick=function(){
    seconds=document.getElementById("changetimer").value
    document.getElementById("timer").value=seconds
}

function updateTimer(){
    seconds=seconds-1
    if(seconds==0){//當時間=9:59.99時..
        console.log("stop")
        clearInterval(timerInterval)//暫停執行
        setTimeout(function(){
            ask.style.display="block"
            document.getElementById("timer").value=0
            setTimeout(function(){
                location.href="api.php?logout="
            },5000)
        },100)
    }
    document.getElementById("timer").value=seconds
}

document.getElementById("yes").onclick=function(){
    ask.style.display="none"
    location.reload()
}

document.getElementById("no").onclick=function(){
    location.href="api.php?logout="
}