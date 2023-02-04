let but=document.querySelectorAll("#X")
let logindiv=document.getElementById("logindiv")
let signupdiv=document.getElementById("signupdiv")
let settingdiv=document.getElementById("settingdiv")
let index=document.getElementById("index")
let view=document.getElementById("view")
let signup=document.getElementById("signup")
let login=document.getElementById("login")
let setting=document.getElementById("setting-button")
let button=[index,view,signup,login,setting]

console.log(window.location.pathname);
logindiv.style.display="none"
signupdiv.style.display="none"
function check(){
    button.forEach(function(buttons){
        buttons.classList.remove("selectbut")
    })

    if(window.location.pathname=="/TaskD/"||window.location.pathname=="/TaskD/index.php"){
        index.classList.add("selectbut")
    }else if(window.location.pathname=="/TaskD/post.php"){
        view.classList.add("selectbut")
    }
}

check()

login.onclick=function(){
    logindiv.style.display="inline"
    login.classList.add("selectbut")
}
signup.onclick=function(){
    signupdiv.style.display="inline"
    signup.classList.add("selectbut")
}

but.forEach(function(buttons){
    buttons.onclick=function(){
        logindiv.style.display="none"
        signupdiv.style.display="none"
        check()
    }
})

window.onbeforeunload="none"