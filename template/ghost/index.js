document.addEventListener("pointermove",function(event){
    document.getElementById("ghost").style.transform="translate("+(event.clientX+2+10)+"px,"+(event.clientY+2+10)+"px)"
    document.getElementById("dot").style.transform="translate("+(event.clientX+2)+"px,"+(event.clientY+2)+"px)"
})