let coffeetable=document.querySelectorAll(".coffeetable")
let val

coffeetable.forEach(function(e){
    e.style.backgroundColor="gray"
    e.addEventListener("click",function(){
        coffeetable.forEach(function(e){
            e.style.backgroundColor="gray"
        })
        e.style.backgroundColor="yellow"
        val=this.id
    })
})

function check(){
    if(val!=undefined){ location.href="productinput.php?val="+val }else{ location.href="productinput.php?val=no" }
}

function sub(){
    document.getElementById("form").submit.click()
}

function nono(){
    alert("請先填寫資料/預覽")
}