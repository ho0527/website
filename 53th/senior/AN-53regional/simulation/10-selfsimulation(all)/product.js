let table=document.querySelectorAll(".coffeetable")
let val

table.forEach(function(e){
    e.style.backgroundColor=""
    e.addEventListener("click",function(){
        table.forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgba(249, 249, 157, 0.921)"
        val=e.id
    })
})

function check(data){
    if(val!=undefined){
        location.href=data+"?val="+val
    }else
        location.href=data+"?val=no"
}

function sub(){
    document.getElementById("form").submit.click()
}