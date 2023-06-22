let fontsize=30

document.getElementById("sizelow").onclick=function(){
    if(fontsize>=12){
        document.querySelectorAll("body")[0].style.fontSize=(fontsize-1)+"px"
        console.log(" document.querySelectorAll(\"body\")[0].style.fontSize="+ document.querySelectorAll("body")[0].style.fontSize)
        document.querySelectorAll("input").forEach(function(event){
            event.style.fontSize=(fontsize-1)+"px"
        })
        fontsize=fontsize-1
    }
}

document.getElementById("sizeup").onclick=function(){
    if(fontsize<=50){
        document.querySelectorAll("body")[0].style.fontSize=fontsize+1+"px"
        document.querySelectorAll("input").forEach(function(event){
            event.style.fontSize=fontsize+1+"px"
        })
        fontsize=fontsize+1
    }
}

document.getElementById("easy").onclick=function(){
    document.getElementById("easy").classList.add("selectbutton")
    document.getElementById("normal").classList.remove("selectbutton")
    document.getElementById("hard").classList.remove("selectbutton")
}

document.getElementById("normal").onclick=function(){
    document.getElementById("normal").classList.add("selectbutton")
    document.getElementById("easy").classList.remove("selectbutton")
    document.getElementById("hard").classList.remove("selectbutton")
}

document.getElementById("hard").onclick=function(){
    document.getElementById("hard").classList.add("selectbutton")
    document.getElementById("easy").classList.remove("selectbutton")
    document.getElementById("normal").classList.remove("selectbutton")
}
