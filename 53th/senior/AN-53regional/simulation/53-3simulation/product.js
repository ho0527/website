let td=document.querySelectorAll(".ctable")
let val=1

td.forEach(function(e){
    e.style.backgroundColor=""
    e.addEventListener("click",function(){
        td.forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgb(255, 255, 175)"
        val=e.id
    })
})

function check(href){
    location.href=href+"?val="+val
}

function sub(){
    document.getElementById("form").submit.click()
}