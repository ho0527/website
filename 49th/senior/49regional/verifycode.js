let verifycode=""
let check=0

document.querySelectorAll(".dragimg").forEach(function(event){
    event.addEventListener("dragstart",function(addeventlistenerevent){
        addeventlistenerevent.dataTransfer.setData("imgid",addeventlistenerevent.target.id)
        addeventlistenerevent.dataTransfer.setData("src",addeventlistenerevent.target.src)
    })
})

document.querySelectorAll(".block").forEach(function(event){
    event.addEventListener("dragover",function(addeventlistenerevent){
        addeventlistenerevent.preventDefault()
    })
    event.addEventListener("drop",function(addeventlistenerevent){
        if(check<3){
            let img=document.createElement("img")
            img.setAttribute("src",addeventlistenerevent.dataTransfer.getData("src"))
            verifycode=verifycode+addeventlistenerevent.dataTransfer.getData("imgid")
            document.querySelectorAll(".dropbox")[0].appendChild(img)
            check=check+1
        }else{
            alert("超過長度請登入或重新產生驗證碼")
        }
    })
})

function login(){
    let username=document.getElementById("username").value
    let password=document.getElementById("password").value
    location.href="login.php?username="+username+"&password="+password+"&verifycode="+verifycode+"&enter="
}