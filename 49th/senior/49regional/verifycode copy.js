let dragimg=document.querySelectorAll(".dragimg")
let drops=document.querySelectorAll("#dropbox")
let verifycode=""

dragimg.forEach(function(dragimgs){
    dragimgs.addEventListener("dragstart",dragstart)
})

drops.forEach(function(dropbox){
    dropbox.addEventListener("dragover",drag)
    dropbox.addEventListener("dragenter",drag)
    dropbox.addEventListener("dragleave",drag)
    dropbox.addEventListener("drop",drop)
})

function dragstart(e){
    e.dataTransfer.setData("text",e.target.id)
    e.dataTransfer.setData("src",e.target.src)
}

function drag(e){
    e.preventDefault()
}

function drop(e){
    let id=e.dataTransfer.getData("text")
    let draggable=document.getElementById(id)
    verifycode=verifycode+id
    let img=document.createElement("img")
    img.setAttribute("src",e.dataTransfer.getData("src"))
    drops[0].appendChild(img)
}

function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?verifycode="+verifycode+"&username="+username+"&code="+code
}