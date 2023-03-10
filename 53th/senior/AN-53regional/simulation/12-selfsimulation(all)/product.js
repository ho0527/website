let td=document.querySelectorAll(".coffeetable")
let val

td.forEach(function(e){
    e.style.backgroundColor=""
    e.addEventListener("click",function(){
        td.forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgb(255, 255, 147)"
        val=e.id
    })
})

function check(href){
    if(val==undefined) location.href=href+"?val=no"
    else location.href=href+"?val="+val
}

function sub(){
    document.getElementById("form").submit.click()
}