document.getElementById("submit").onclick=function(){
    let width=document.getElementById("width").value
    let height=document.getElementById("height").value
    if(/^[0-9]+$/.test(width)&&/^[0-9]+$/.test(height)){
        location.href="edit.html"
        localStorage.setItem("width",width)
        localStorage.setItem("height",height)
    }else{ alert("長寬要是整數") }
}