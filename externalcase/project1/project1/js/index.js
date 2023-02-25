let path=location.pathname
let navigationbar=document.getElementById("navigationbarbuttondiv")
let footer=document.getElementById("footer")

try{
    let navigationbarbuttonandpath=[
        {id:"navigationbarindex",path:"index.php",value:"首頁"},
        {id:"navigationbarproduct",path:"product.php",value:"產品"},
        {id:"navigationbarupdatelog",path:"updatelog.php",value:"更新日誌"},
        {id:"navigationbarlog",path:"log.php",value:"製作日誌"},
        {id:"navigationbarabout",path:"about.php",value:"關於我們"},
        {id:"navigationbarconnection",path:"connection.php",value:"聯絡我們"},
        {id:"navigationbarads",path:"ads.php",value:"廣告投放"},
        {id:"navigationbarsetting",path:"setting.php",value:"設定"},
    ]

    let footerbuttonandpath=[
        {id:"footerindex",path:"index.php"},
        {id:"footerproduct",path:"product.php"},
        {id:"footerupdatelog",path:"updatelog.php"},
        {id:"footerabout",path:"about.php"},
        {id:"footerconnection",path:"connection.php"},
        {id:"footerads",path:"ads.php"},
        {id:"footersetting",path:"setting.php"},
        {id:"footerlogin",path:"login.php"},
    ]

    let url=(location.href).split("/")
    if(url[url.length-1]==""){
        location.href="index.php"
    }

    navigationbarbuttonandpath.forEach(function(button){
        let element=document.createElement("input")
        element.type="button"
        element.classList.add("navigationbarbutton")
        element.id=button.id
        element.onclick=function(){
            let url=(location.href).split("/")
            if(path==url[url.length-1]){
                location.reload()
            }else{
                location.href=button.path
            }
       }
        navigationbar.appendChild(element)
    })

    let loginbutton=document.createElement("input")
    loginbutton.type="submit"
    loginbutton.classList.add("navigationbarbuttonlogin")
    loginbutton.name="login"
    loginbutton.value="登入"
    loginbutton.id="navigationbarlogin"
    loginbutton.onclick=function(){
        location.href="login.php"
    }
    navigationbar.appendChild(loginbutton)

    footerbuttonandpath.forEach(function(button){
        let element=document.createElement("input")
        element.type="button"
        element.classList.add("footerbutton")
        element.id=button.id
        element.value=button.value
        element.onclick=function(){
            let url=(location.href).split("/")
            if(path==url[url.length-1]){
                location.reload()
            }else{
                location.href=button.path
            }
       }
        footer.appendChild(element)
    })

    try{
        document.getElementById(navigationbarbuttonandpath.find(function(button){ return path.endsWith(button.path) }).id).classList.add("selectbutton")
    }catch{
        document.getElementById("navigationbarlogin").classList.add("selectbutton")
    }

    document.getElementById(footerbuttonandpath.find(function(button){ return path.endsWith(button.path) }).id).classList.add("selectbutton2")
}catch(error){
    console.log( error.message)
}
