let drags=document.querySelectorAll(".dragimg")
let drops=document.querySelectorAll(".dropbox")
let a=""

drags.forEach(function(e){
    e.addEventListener("dragstart",dragstart)
})

drops.forEach(function(e){
    e.addEventListener("dragover",drag)
    e.addEventListener("dragenter",drag)
    e.addEventListener("dragleave",drag)
    e.addEventListener("drop",drop)
})

function dragstart(e){
    e.dataTransfer.setData("text",e.target.id)
}

function drag(e){
    e.preventDefault()
}

function drop(e){
    let id=e.dataTransfer.getData("text")
    let g=document.getElementById(id)
    a+=id
    e.target.appendChild(g)
}

function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?code="+code+"&username="+username+"&verify="+a
}