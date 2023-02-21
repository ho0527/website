let alltd=document.querySelectorAll(".verifytd")

alltd.forEach(function(td){
    td.style.backgroundColor="white"
    td.addEventListener("click",function(){
        tdclick(td)
    })
})

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(){
    if((alltd[0].style.backgroundColor==alltd[1].style.backgroundColor)&&alltd[1].style.backgroundColor=="black"){
        pass()
    }else if((alltd[2].style.backgroundColor==alltd[3].style.backgroundColor)&&alltd[3].style.backgroundColor=="black"){
        pass()
    }else if((alltd[0].style.backgroundColor==alltd[2].style.backgroundColor)&&alltd[2].style.backgroundColor=="black"){
        pass()
    }else if((alltd[1].style.backgroundColor==alltd[3].style.backgroundColor)&&alltd[3].style.backgroundColor=="black"){
        pass()
    }else{
        alert("驗證碼輸入錯誤")
    }
}

function tdclick(id){
    if(id.style.backgroundColor=="black"){
        id.style.backgroundColor="white"
    }else{
        id.style.backgroundColor="black"
    }
}