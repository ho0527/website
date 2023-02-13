let dragimg=document.querySelectorAll(".dragimg")
let drops=document.querySelectorAll("#dropbox")
let a=""

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
}

function drag(e){
    e.preventDefault()
}

function drop(e){
    let id=e.dataTransfer.getData("text")
    let draggable=document.getElementById(id)
    a=a+id
    e.target.appendChild(draggable)
    console.log(a)
}

function loginclick(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?verifycode="+a+"&username="+username+"&code="+code
}