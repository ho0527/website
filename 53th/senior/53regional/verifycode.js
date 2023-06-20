let a=""

document.querySelectorAll(".dragimg").forEach(function(event){
    event.addEventListener("dragstart",function(addeventlistenerevent){
        addeventlistenerevent.dataTransfer.setData("text",addeventlistenerevent.target.id)
    })
})

document.querySelectorAll(".dropbox").forEach(function(event){
    event.addEventListener("dragover",function(addeventlistenerevent){
        addeventlistenerevent.preventDefault()
    })
    event.addEventListener("drop",function(addeventlistenerevent){
        let id=addeventlistenerevent.dataTransfer.getData("text")
        let data=document.getElementById(id)
        a=a+data.getAttribute("data-id")
        document.querySelectorAll(".dropbox")[0].appendChild(data)
    })
})

function loginclick(){
    let username=document.getElementById("username").value
    let code=document.getElementById("password").value
    location.href="login.php?verifycode="+a+"&username="+username+"&password="+code
}