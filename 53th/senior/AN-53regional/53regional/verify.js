let td1=document.getElementById("td1")
let td2=document.getElementById("td2")
let td3=document.getElementById("td3")
let td4=document.getElementById("td4")
let tds=document.querySelectorAll(".td")
let mask=document.getElementById("maskdiv")
let permission=document.getElementById("permission").value

// window.onload=function(){
//     let rand1=Math.floor(Math.random()*4)+1
//     console.log(rand1)
//     document.getElementById("td"+rand1).style.backgroundColor="black"
// }

tds.forEach(function(td){
    td.addEventListener("click",function(){
        tdclick(td.id)
    })
})

function pass(){
    alert("登入成功")
    if(permission=="管理者"){
        location.href="adminWelcome.php"
    }else{
        location.href="userWelcome.php"
    }
}

function check(id){
    console.log(td1.style.backgroundColor)
    console.log(td2.style.backgroundColor)
    console.log(td3.style.backgroundColor)
    console.log(td4.style.backgroundColor)
    if((td1.style.backgroundColor==td2.style.backgroundColor)&&td2.style.backgroundColor=="black"){
        pass()
    }else if((td3.style.backgroundColor==td4.style.backgroundColor)&&td4.style.backgroundColor=="black"){
        console.log("2")
        pass()
    }else if((td1.style.backgroundColor==td3.style.backgroundColor)&&td1.style.backgroundColor=="black"){
        console.log("3")
        pass()
    }else if((td2.style.backgroundColor==td4.style.backgroundColor)&&td2.style.backgroundColor=="black"){
        console.log("4")
        pass()
    }else{
        alert("驗證碼輸入錯誤")
    }
}

function tdclick(id){
    console.log(id)
    id=document.getElementById(id)
    console.log(id.style.backgroundColor)
    if(id.style.backgroundColor==""||id.style.backgroundColor=="white"){
        id.style.backgroundColor="black"
    }else{
        id.style.backgroundColor="white"
    }
}