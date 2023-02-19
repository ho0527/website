let version=document.querySelectorAll(".maintable")
let val


version.forEach(function(event){
    event.style.backgroundColor="gray"
    event.addEventListener("click",function(){
        version.forEach(function(event){
            event.style.backgroundColor="gray"
        })
        this.style.backgroundColor="yellow"
        val=this.id
    })
})

function data(){
    if(val!=undefined){
        location.href="productinput.php?val="+val[7]
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