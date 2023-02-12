let version=document.querySelectorAll(".version")
let val

version.forEach(function(event){
    event.addEventListener("click",function(){
        version[0].style.backgroundColor="#ffa07a"
        version[1].style.backgroundColor="#ffa07a"
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


// let form=document.getElementById("form")
// const a = (e) => {
//     let a = e.target.result[0]

// }