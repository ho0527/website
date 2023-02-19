let path=location.pathname
let navigationbar=document.getElementById("navigationbarbuttondiv")

let buttonandpath=[
    {id:"index",path:"index.php",value:"首頁"},
    {id:"chatcom",path:"chat/index.php",value:"chatcom"},
    {id:"product",path:"product.php",value:"產品"},
    {id:"log",path:"log.php",value:"製作日誌"},
    {id:"about",path:"about.php",value:"關於我們"},
    {id:"connection",path:"connection.php",value:"聯絡我們"},
    {id:"ads",path:"ads.php",value:"廣告投放"},
]

buttonandpath.forEach(function(button){
    let element=document.createElement("input")
    element.type="button"
    element.classList.add("navigationbarbutton")
    element.id=button.id
    element.value=button.value
    element.onclick=function(){
        if(path.endsWith(button.path)){
            location.reload()
        }else{
            location.href=button.path
        }
   }
    navigationbar.appendChild(element)
})

let loginButton=document.createElement("input")
loginButton.type="submit"
loginButton.classList.add("navigationbarbuttonlogin")
loginButton.name="login"
loginButton.value="登入"
navigationbar.appendChild(loginButton)


document.getElementById(buttonandpath.find(function(button){ return path.endsWith(button.path) }).id).classList.add("selectbut")
