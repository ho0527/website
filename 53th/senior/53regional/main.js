if(weblsget("53regionalpermission")=="管理者"){
    docgetid("navigationbarbuttondiv").innerHTML=`
        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="navigationbarbutton" onclick="location.href='productindex.php'" value="上架商品">
        <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
        <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
    `
}else{
    docgetid("navigationbarbuttondiv").innerHTML=`
        <input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='main.php'" value="首頁">
        <input type="button" class="navigationbarbutton" onclick="location.href='search.php'" value="查詢">
        <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='"value="登出">
    `
}

startmacossection()