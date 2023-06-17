let time="night"

document.getElementById("day").onclick=function(){
    if(time=="night"){
        document.getElementById("body").style.backgroundColor="rgb(197, 159, 5)"
        document.getElementById("sun").style.display="block"
        document.getElementById("sun").style.animation="1s up 1"
        document.getElementById("moon").style.animation="1s down 1"
        document.getElementById("mainimage").style.filter="hue-rotate(198deg) contrast(1.8) brightness(1)"
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
        document.getElementById("mainimage").style.filter="hue-rotate(370deg) contrast(2) brightness(0.4)"
        setTimeout(function(){
            document.getElementById("sun").style.display="none"
            document.getElementById("sun").style.animation=""
            document.getElementById("moon").style.animation=""
            time="night"
        },900)
    }
}