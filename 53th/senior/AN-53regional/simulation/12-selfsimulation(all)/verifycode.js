let drags=document.querySelectorAll(".drag")
let drops=document.querySelectorAll(".dropbox")
let a=""

drags.forEach(function(e){
    e.addEventListener("dragstart",function(e){
        e.dataTransfer.setData("text",e.target.id)
    })
})

drops.forEach(function(e){
    e.addEventListener("dragover",function(e){
        e.preventDefault()
    })
    e.addEventListener("drop",function(e){
        let id=e.dataTransfer.getData("text")
        let g=document.getElementById(id)
        a+=id
        drops[0].appendChild(g)
    })
})

function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?username="+username+"&code="+code+"&verify="+a
}