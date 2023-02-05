let read=document.getElementById("readmoreless")
let text=document.getElementById("readmore")

text.style.display="none"

read.onclick=function(){
    if(text.style.display=="none"){
        text.style.display="inline"
        read.innerHTML="閱讀更少(readless)"
    }else{
        text.style.display="none"
        read.innerHTML="閱讀更多(Read More)"
    }
}
