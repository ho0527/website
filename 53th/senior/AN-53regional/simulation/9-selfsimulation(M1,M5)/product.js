let product=document.querySelectorAll(".coffeetable")
let val

product.forEach(function(e){
    e.style.backgroundColor="gray"
    e.addEventListener("click",function(){
        product.forEach(function(e){
            e.style.backgroundColor="gray"
        })
        e.style.backgroundColor="yellow"
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