let time="night"

document.getElementById("day").onclick=function(){
    if(time=="night"){
        document.getElementById("body").style.backgroundColor="rgb(246, 246, 131)"
        document.getElementById("sun").style.display="block"
        document.getElementById("sun").style.animation="1s up 1"
        document.getElementById("moon").style.animation="1s down 1"
        setTimeout(function(){
            document.getElementById("moon").style.display="none"
            document.getElementById("sun").style.animation=""
            document.getElementById("moon").style.animation=""
            time="day"
        },900)
    }
}

document.getElementById("night").onclick=function(){
    if(time=="day"){
        document.getElementById("body").style.backgroundColor="rgb(26, 34, 51)"
        document.getElementById("moon").style.display="block"
        document.getElementById("sun").style.animation="1s down 1"
        document.getElementById("moon").style.animation="1s up 1"
        setTimeout(function(){
            document.getElementById("sun").style.display="none"
            document.getElementById("sun").style.animation=""
            document.getElementById("moon").style.animation=""
            time="night"
        },900)
    }
}