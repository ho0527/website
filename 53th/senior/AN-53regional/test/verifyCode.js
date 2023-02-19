let drags=document.querySelectorAll(".dragimg")
let drops=document.querySelectorAll("#dropbox")
let a=""

drags.forEach(function(drag){
    drag.addEventListener("dragstart",dragstart)
})

drops.forEach(function(dropimg){
    dropimg.addEventListener("dragover",drag)
    dropimg.addEventListener("dragleave",drag)
    dropimg.addEventListener("dragenter",drag)
    dropimg.addEventListener("drop",drop)
})

function dragstart(e){
    e.dataTransfer.setData("text",e.target.id)
}

function drag(e){
    e.preventDefault()
}

function drop(e){
    let id=e.dataTransfer.getData("text")
    let dragable=document.getElementById(id)
    a=a+id
    e.target.appendChild(dragable)
}

function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?verify="+a+"&username="+username+"&code="+code
}