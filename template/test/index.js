let id1=document.getElementById("id1")
let id2=document.getElementById("id2")
let but=document.getElementById("but")


id2.style.display="none"

but.onclick=function(){
    if(id2.style.display=="none"){
        id1.style.display="none"
        id1.style.opacity="1"
        id2.style.display="block"
        id2.style.opacity="0"
    }else{
        id2.style.display="none"
        id1.style.display="block"
    }
}