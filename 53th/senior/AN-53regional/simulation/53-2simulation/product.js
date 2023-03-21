let td=document.querySelectorAll(".coffeetable")
let val

td.forEach(function(e){
    e.style.backgroundColor=""
    e.addEventListener("click",function(){
        td.forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgb(255, 255, 172)"
        val=e.id
    })
})


document.querySelectorAll(".select").forEach(function(e){
    e.addEventListener("change",function(){
        document.querySelectorAll(".ntd")[(e.id)-1].innerHTML=`
            ${e.value}
        `
    })
})