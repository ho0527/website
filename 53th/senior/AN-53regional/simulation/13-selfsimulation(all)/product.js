let coffee=document.querySelectorAll(".coffeetable")
let val

coffee.forEach(function(e){
    e.style.backgroundColor=""
    e.addEventListener("click",function(){
        coffee.forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgb(255, 255, 171)"
        val=e.id
    })
})

function check(href){
    if(val==undefined){
        location.href=href+"?val=no"
    }else{
        location.href=href+"?val="+val
    }
}

function sub(){

}



let select=document.querySelectorAll("select")
select.forEach(function(e){
    e.addEventListener("change",function(){
        console.log(e)
        document.getElementById((e.id)[1]).innerHTML=`
            ${ e.value }
        `
    })
})