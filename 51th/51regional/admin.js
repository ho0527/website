let newform=document.getElementById("newform")
let editform=document.getElementById("editform")
let check=document.getElementById("check")
let edit=document.getElementById("edit")

check.style.display="none"
edit.style.display="none"

newform.onclick=function(){
    check.style.display="inline"
    edit.style.display="none"
}

editform.onclick=function(){
    check.style.display="none"
    edit.style.display="inline"
}