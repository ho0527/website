let version=document.querySelectorAll(".product")
let val


version.forEach(function(event){
    event.style.backgroundColor="rgb(35, 35, 35)"
    event.addEventListener("click",function(){
        version.forEach(function(event){
            event.style.backgroundColor="rgb(35, 35, 35)"
        })
        this.style.backgroundColor="yellow"
        val=this.id
    })
})

function data(){
    if(val!=undefined){
        location.href="productinput.php?val="+val
    }else{
        location.href="productindex.php?val=no"
    }
}

function nono(){
    alert("請先填寫資料")
}

function nono2(){
    alert("請先預覽")
}

function sub(){
    document.getElementById("form").submit.click()
}