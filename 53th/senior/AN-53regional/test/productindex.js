let version=document.querySelectorAll(".maintable")
let val

version.forEach(function(e){
    e.style.backgroundColor="rgba(130,130,130,0.7)"
    e.addEventListener("click",function(){
        version.forEach(function(e2){
            e2.style.backgroundColor="rgba(130,130,130,0.7)"
        })
        this.style.backgroundColor="yellow"
        val=this.id
    })
})

function data(){
    if(val!=undefined){
        location.href="productindex.php?val="+val[7]
    }else{
        location.href="productindex.php?val=no"
    }
}

function nono(){
    alert("請先填寫資料/預覽")
}

function sub(){
    document.getElementById("form").submit.click()
}