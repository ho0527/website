let difficulty=weblsget("difficulty")
let timemin=0
let timesec=0

docgetid("difficulty").innerHTML=difficulty // 拿到難易度並顯示

setInterval(function(){
    timesec=timesec+1
    if(timesec==60){
        timemin=timemin+1
        timesec=0
    }
    let min=timemin.toString()
    let sec=timesec.toString()
    if(timesec<10){
        sec="0"+sec
    }
    if(timemin<10){
        min="0"+min
    }
    docgetid("time").innerHTML=`
        時間: ${min}:${sec}
    `
},1000)

startmacossection()