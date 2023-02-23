let product=document.querySelectorAll(".producttable")
let val

product.forEach(function(e){
    e.style.backgroundColor="rgba(130,130,130,0.7)"
    e.addEventListener("click",function(){
        product.forEach(function(e){
            e.style.backgroundColor="rgba(130,130,130,0.7)"
        })
        e.style.backgroundColor="yellow"
    })
})

function data(){
    if(val!=undefined){
        location.href="productindex.php?val="+val[2]
    }else{
        location.href="productindex.php?val=no"
    }
}

function nono(){
    alert("請先填寫資料/預覽")
}

function sub(){
    let form=document.getElementById("form")
    form.submit()
}