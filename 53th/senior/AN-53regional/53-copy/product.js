let p=document.querySelectorAll(".coffeetable")
let val

p.forEach(function(e){
    e.style.backgroundColor="gray"
    e.addEventListener("click",function(){
        p.forEach(function(e){
            e.style.backgroundColor="gray"
        })
        e.style.backgroundColor="yellow"
        val=this.id
    })
})

function data(){
    if(val!=undefined){
        location.href="productindex.php?val="+val[1]
    }else{
        location.href="productindex.php?val=no"
    }
}

function nono(){
    alert("清先填寫資料/預覽")
}

function sub(){
    document.getElementById("form").submit.click()
}