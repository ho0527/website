let width=localStorage.getItem("width")
let height=localStorage.getItem("height")

document.getElementById("main").style.width=width+"px"
document.getElementById("main").style.height=height+"px"

function undo(){

}

function redo(){
    
}

document.getElementById("undo").onclick=function(){ undo() }
document.getElementById("redo").onclick=function(){ redo() }

document.getElementById("main").addEventListener("keydown",function(event){
    if(event.ctrlKey&&event.key=="Z"){ undo() }
    if(event.ctrlKey&&event.shiftKey&&event.key=="Z"){ redo() }
})