const timer=document.getElementById("timer")
const resetbutton=document.getElementById("resetbutton")
const ask=document.getElementById("ask")
let timerInterval
let seconds=document.getElementById("changetimer").value
let asktimer=5
let yes=document.getElementById("yes")
let no=document.getElementById("no")

ask.style.display="none"

//訂定變數
//設定disabled

console.log(seconds)
timerInterval=setInterval(updateTimer,1000)
resetbutton.onclick=function(){
    seconds=document.getElementById("changetimer").value
    timer.value=seconds
}

function updateTimer(){
    seconds=seconds-1
    if(seconds==0){//當時間=9:59.99時..
        console.log("stop")
        clearInterval(timerInterval)//暫停執行
        setTimeout(function(){
            ask.style.display="block"
            timer.value=0
            check()
        },100)
    }
    timer.value=seconds
}

function check(){
    yes.onclick=function(){
        ask.style.display="none"
        location.reload()
    }
    setTimeout(function(){
        alert("登出成功!")
        location.href="index.php"
    },5000)
}