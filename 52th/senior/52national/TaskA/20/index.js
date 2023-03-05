const timer=document.getElementById("timer")
const startButton=document.getElementById("start-button")
const stopButton=document.getElementById("stop-button")
const resetButton=document.getElementById("reset-button")
let timerInterval
let seconds3=0
let seconds2=0
let seconds1=0
let centiseconds2=0
let centiseconds1=0
//訂定變數

for(let i=1;i<=5;i=i+1){
    document.getElementById("digit"+i).innerHTML=`
        <div class="seg1"></div>
        <div class="seg2"></div>
        <div class="seg3"></div>
        <div class="seg4"></div>
        <div class="seg5"></div>
        <div class="seg6"></div>
        <div class="seg7"></div>
    `
}

function seg1(){
    document.querySelectorAll(".seg1").style.backgroundColor="red"
    document.querySelectorAll(".seg2").style.backgroundColor="rgba(red,0.3)"
    document.querySelectorAll(".seg3").style.backgroundColor="rgba(red,0.3)"
    document.querySelectorAll(".seg4").style.backgroundColor="rgba(red,0.3)"
    document.querySelectorAll(".seg5").style.backgroundColor="rgba(red,0.3)"
    document.querySelectorAll(".seg6").style.backgroundColor="rgba(red,0.3)"
    document.querySelectorAll(".seg7").style.backgroundColor="rgba(red,0.3)"
}


startButton.disabled=false
stopButton.disabled=true
//設定disabled
startButton.addEventListener("click",function(){//做start的監聽器
    timerInterval=setInterval(updateTimer,10)//執行updateTimer 等10秒
    startButton.disabled=true
    stopButton.disabled=false
    //設定disabled
})

stopButton.addEventListener("click",function(){//做stop的監聽器
    clearInterval(timerInterval)//暫停執行
    startButton.disabled=false
    stopButton.disabled=true
    //設定disabled
})

resetButton.addEventListener("click",function(){
    seconds1=0
    seconds2=0
    seconds3=0
    centiseconds1=0
    centiseconds2=0
    minutes=0
    //訂定變數
    //寫入innerHTML
    timer.innerHTML=`
        <div class="digit">0</div>
        <div class="digit">0</div>
        <div class="digit">0</div>
        <div class="digit">.</div>
        <div class="digit">0</div>
        <div class="digit">0</div>
    `
    startButton.disabled=false
    stopButton.disabled=false
})

function updateTimer(){
    centiseconds1=centiseconds1+1
    //將微秒數+1
    if(seconds3==9&seconds2==9&&seconds1==9&&centiseconds2==9&&centiseconds1==9){//當時間=9:59.99時..
        console.log("stop")
        clearInterval(timerInterval)//暫停執行
        setTimeout(function(){//等一下在更新內容
            //寫入innerHTML
            timer.innerHTML=`
                <div class="digit">9</div>
                <div class="digit">9</div>
                <div class="digit">9</div>
                <div class="digit">.</div>
                <div class="digit">9</div>
                <div class="digit">9</div>
            `
        },100)
        startButton.disabled=true
        stopButton.disabled=true
        //設定disabled
    }
    if(centiseconds1==9&&centiseconds2==9){//當微秒=99時..
        centiseconds1=0//微秒=00
        centiseconds2=0
        seconds1=seconds1+1//秒數+1
    }
    if(seconds1==10){//當第1位秒數=10時..
        seconds1=0//第1位秒數=0
        seconds2=seconds2+1//第2位+1
    }
    if(seconds2==10){//當第2位的秒數=6時..
        seconds1=0//秒數=00
        seconds2=0
        seconds3=seconds3+1//分鐘數+1
    }
    if(centiseconds1==10){//當第1位微秒數=10時..
        centiseconds1=0//第1為微秒數=0
        centiseconds2=centiseconds2+1//第2位+1
    }
    //寫入innerHTML
    timer.innerHTML=`
        <div class="digit">${seconds3}</div>
        <div class="digit">${seconds2}</div>
        <div class="digit">${seconds1}</div>
        <div class="digit">.</div>
        <div class="digit">${centiseconds2}</div>
        <div class="digit">${centiseconds1}</div>
    `
}

