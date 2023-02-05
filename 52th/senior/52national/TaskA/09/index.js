let smile=document.getElementById(":)")
let soso=document.getElementById(":|")
let sad=document.getElementById(":(")
let smilebut=document.getElementById(":)but")
let sosobut=document.getElementById(":|but")
let sadbut=document.getElementById(":(but")

smile.style.display="none"
soso.style.display="block"
sad.style.display="none"

smilebut.onclick=function(){
    smile.style.display="block"
    soso.style.display="none"
    sad.style.display="none"
    smile.style.opacity=0
    setTimeout(function(){
        smile.style.opacity=1
    },500)
}

sosobut.onclick=function(){
    smile.style.display="none"
    soso.style.display="block"
    sad.style.display="none"
    soso.style.opacity=0
    setTimeout(function(){
        soso.style.opacity=1
    },500)
}

sadbut.onclick=function(){
    smile.style.display="none"
    soso.style.display="none"
    sad.style.display="block"
    sad.style.opacity=0
    setTimeout(function(){
        sad.style.opacity=1
    },500)
}