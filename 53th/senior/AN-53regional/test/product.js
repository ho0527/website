let coffeetable=document.querySelectorAll(".coffeetable")
let val

coffeetable.forEach(function(e){
    e.style.backgroundColor=""
    e.addEventListener("click",function(){
        coffeetable.forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgb()"
        val=this.id
    })
})

function check(){
    if(val!=undefined){
        location.href="productinput.php?val="+val
    }else{
        location.href="productinput.php?val=no"
    }
}

function nono(){
    alert("請先填寫資料/預覽")
}

function sub(){
    document.getElementById("form").submit.click()
}