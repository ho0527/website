let drags=document.querySelectorAll(".drag")
let drops=document.querySelectorAll(".dropbox")
let a=""

drags.forEach(function(e){
    e.addEventListener("dragstart",function(e){
        e.dataTransfer.setData("text",e.target.id)
    })
})

drops.forEach(function(e){
    e.addEventListener("dragover",drag)
    e.addEventListener("dragenter",drag)
    e.addEventListener("dragleave",drag)
    e.addEventListener("drop",function(e){
        let id=e.dataTransfer.getData("text")
        let g=document.getElementById(id)
        a=a+id
        e.target.appendChild(g)
    })
})

function drag(e){
    e.preventDefault()
}


function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?username="+username+"&code="+code+"&verify="+a
}