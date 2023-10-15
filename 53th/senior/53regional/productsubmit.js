docgetid("cancel").onclick=function(){
    location.href="main.php"
}

docgetid("productsubmit").onclick=function(){
    newajax("POST","/backend/53regional/newproduct",JSON.stringify({
        "submit":true,
        "description":weblsget("53regionalproductdescription"),
        "link":weblsget("53regionalproductlink"),
        "cost":weblsget("53regionalproductcost"),
        "name":weblsget("53regionalproductname"),
        "file":weblsget("53regionalproductfile"),
        "version":weblsget("53regionalproductid"),
        "edit":weblsget("53regionalproductedit"),
    })).onload=function(){
        let data=JSON.parse(this.responseText)
        if(data["success"]){
            alert("新增成功")
            weblsset("53regionalproductdescription",null)
            weblsset("53regionalproductlink",null)
            weblsset("53regionalproductname",null)
            weblsset("53regionalproductcost",null)
            weblsset("53regionalproductfile",null)
            weblsset("53regionalproductid",null)
            weblsset("53regionalproductedit",null)
            location.href="main.html"
        }
    }
}

docgetid("submit").classList.add("selectbut")

startmacossection()