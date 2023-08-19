let a=""

document.querySelectorAll(".dragimg").forEach(function(event){
    event.addEventListener("dragstart",function(addeventlistenerevent){
        addeventlistenerevent.dataTransfer.setData("text",addeventlistenerevent.target.id)
    })
})

document.getElementById("dropbox").addEventListener("dragover",function(event){
    event.preventDefault()
})

document.getElementById("dropbox").addEventListener("drop",function(event){
    let id=event.dataTransfer.getData("text")
    let data=document.getElementById(id)
    a=a+data.getAttribute("data-id")
    document.getElementById("dropbox").appendChild(data)
})

function loginclick(){
    let username=document.getElementById("username").value
    let code=document.getElementById("password").value
    location.href="login.php?verifycode="+a+"&username="+username+"&password="+code
}