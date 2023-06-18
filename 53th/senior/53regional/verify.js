let data=["水平線","垂直線","左上右下斜線","右上左下斜線"]
let count=Math.floor(Math.random()*4)
document.getElementById("context").innerHTML=data[count]

document.querySelectorAll(".td").forEach(function(event){
    event.onclick=function(){
        if(event.style.backgroundColor==""||event.style.backgroundColor=="white"){
            event.style.backgroundColor="black"
        }else{
            event.style.backgroundColor="white"
        }
    }
})

document.getElementById("change").onclick=function(){
    if(count==3){ count=-1 }
    count=count+1
    document.getElementById("context").innerHTML=data[count]
}

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(){
    let td=document.querySelectorAll(".td")
    if(count==0){
        if((td[0].style.backgroundColor==td[1].style.backgroundColor)&&td[2].style.backgroundColor=="black"){
            pass()
        }else if((td[3].style.backgroundColor==td[4].style.backgroundColor)&&td[5].style.backgroundColor=="black"){
            pass()
        }else if((td[6].style.backgroundColor==td[7].style.backgroundColor)&&td[8].style.backgroundColor=="black"){
            pass()
        }else{ alert("驗證碼輸入錯誤") }
    }else if(count==1){
        if((td[0].style.backgroundColor==td[3].style.backgroundColor)&&td[6].style.backgroundColor=="black"){
            pass()
        }else if((td[1].style.backgroundColor==td[4].style.backgroundColor)&&td[7].style.backgroundColor=="black"){
            pass()
        }else if((td[2].style.backgroundColor==td[5].style.backgroundColor)&&td[8].style.backgroundColor=="black"){
            pass()
        }else{ alert("驗證碼輸入錯誤") }
    }else if((td[0].style.backgroundColor==td[4].style.backgroundColor)&&td[8].style.backgroundColor=="black"&&count==2){
        pass()
    }else if((td[2].style.backgroundColor==td[4].style.backgroundColor)&&td[6].style.backgroundColor=="black"&&count==3){
        pass()
    }else{
        alert("驗證碼輸入錯誤")
    }
}