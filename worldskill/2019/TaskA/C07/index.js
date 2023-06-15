function clock() {
    let date=new Date()
    let second=date.getSeconds()
    let minute=date.getMinutes()
    let hour=date.getHours()%12

    document.getElementById("second").style.transform="rotate("+(6*second)+"deg)"
    document.getElementById("minute").style.transform="rotate("+(6*minute+second*0.1)+"deg)"
    document.getElementById("hour").style.transform="rotate("+(30*hour+minute*0.5)+"deg)"
}

// Update the clock hands immediately
clock()

// Update the clock hands every second
setInterval(clock,1000)