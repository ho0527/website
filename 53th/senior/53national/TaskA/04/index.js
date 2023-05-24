let time="night"

document.getElementById("day").onclick=function(){
    if(time=="night"){
        document.getElementById("body").style.backgroundColor="rgb(246, 246, 131)"
        document.getElementById("moonandsun").src="image/2.png"
        time="day"
    }
}

document.getElementById("night").onclick=function(){
    if(time=="day"){
        document.getElementById("body").style.backgroundColor="rgb(26, 34, 51)"
        document.getElementById("moonandsun").src="image/3.png"
        time="night"
    }
}