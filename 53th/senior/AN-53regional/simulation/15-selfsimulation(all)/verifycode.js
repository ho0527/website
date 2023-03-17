let drag=document.querySelectorAll(".img")
let drop=document.querySelectorAll(".dropbox")
let a=""

drag.forEach(function(e){
    e.addEventListener("dragstart",function(e){
        e.dataTransfer.setData("text",e.target.id)
    })
})

drop.forEach(function(e){
    e.addEventListener("dragover",function(e){
        e.preventDefault()
    })
    e.addEventListener("drop",function(e){
        let id=e.dataTransfer.getData("text")
        let g=document.getElementById(id)
        a+=g.getAttribute("data-id")
        drop[0].appendChild(g)
    })
})

function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?username="+username+"&code="+code+"&verify="+a
}