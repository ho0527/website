let verifytd=document.querySelectorAll(".verifytd")

all.forEach(function(td){
    td.addEventListener("click",function(){
        tdclick(this.id)
    })
})

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(){
    if((td1.style.backgroundColor==td2.style.backgroundColor)&&td2.style.backgroundColor=="black"){
        pass()
    }else if((td3.style.backgroundColor==td4.style.backgroundColor)&&td4.style.backgroundColor=="black"){
        pass()
    }else if((td1.style.backgroundColor==td3.style.backgroundColor)&&td1.style.backgroundColor=="black"){
        pass()
    }else if((td2.style.backgroundColor==td4.style.backgroundColor)&&td2.style.backgroundColor=="black"){
        pass()
    }else{
        alert("驗證碼輸入錯誤")
    }
}

function allshow(){
    
}

function tdclick(id){
    id=document.getElementById(id)
    if(id.style.backgroundColor==""||id.style.backgroundColor=="white"){
        id.style.backgroundColor="black"
    }else{
        id.style.backgroundColor="white"
    }
}
