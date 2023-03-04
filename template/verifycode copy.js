let drags=document.querySelectorAll(".drag")
let drops=document.querySelectorAll(".dropbox")
let a=""

drags.forEach(function(e){
    e.addEventListener("dragstart",function(e){
        e.dataTransfer.setData("text",e.target.id)
        console.log(e.target.src)
        e.dataTransfer.setData('src',e.target.src)
    })
})

drops.forEach(function(e){
    e.addEventListener("dragover",function(e){
        e.preventDefault()
    })
    e.addEventListener("drop",function(e){
        let id=e.dataTransfer.getData("text")
        let g=document.getElementById(id)
        a=a+id

        let dom=document.createElement("img")
            dom.setAttribute('src',e.dataTransfer.getData('src'))
            console.log(e.dataTransfer.getData('src'))
        document.getElementsByClassName("dropbox")[0].appendChild(dom)
        //document.getElementsByClassName("dropbox")[0].appendChild(g)
    })
})

function login(){
    let username=document.getElementById("username").value
    let code=document.getElementById("code").value
    location.href="login.php?username="+username+"&code="+code+"&verify="+a
}