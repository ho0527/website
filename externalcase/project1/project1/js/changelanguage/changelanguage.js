let language={
    zhtw:{
        index:"首頁", 
        product:"產品",
        updatelog:"更新日誌",
        log:"製作日誌",
        about:"關於我們",
        connection:"聯絡我們",
        ads:"廣告投放",
        setting:"設定",
        login:"登入",
    },
    en:{
        index:"home", 
        product:"product",
        updatelog:"updatelog",
        log:"log",
        about:"about",
        connection:"connection",
        ads:"ads",
        setting:"setting",
        login:"login",
    },
}


let defaultlanguage="zhtw"; // 預設語言為英文
// 語言切換功能
function switchlanguage(event){
    // 更改文本內容
    document.getElementById("navigationbarindex").value=event.index
    document.getElementById("navigationbarproduct").value=event.product
    document.getElementById("navigationbarupdatelog").value=event.updatelog
    document.getElementById("navigationbarlog").value=event.log
    document.getElementById("navigationbarabout").value=event.about
    document.getElementById("navigationbarconnection").value=event.connection
    document.getElementById("navigationbarads").value=event.ads
    document.getElementById("navigationbarsetting").value=event.setting
    document.getElementById("navigationbarlogin").value=event.login
    document.getElementById("footerindex").value=event.index
    document.getElementById("footerproduct").value=event.product
    document.getElementById("footerupdatelog").value=event.updatelog
    document.getElementById("footerabout").value=event.about
    document.getElementById("footerconnection").value=event.connection
    document.getElementById("footerads").value=event.ads
    document.getElementById("footersetting").value=event.setting
    document.getElementById("footerlogin").value=event.login
}

// 切換到預設語言
switchlanguage(language[defaultlanguage]);

// 語言切換按鈕事件
// document.getElementById("switchlanguagebutton").addEventListener("click",function(){
//     // 切換語言
//     if(defaultlanguage=="en"){
//         defaultlanguage="zn"
//     }else{
//         defaultlanguage="en"
//     }
//     switchlanguage(language[defaultlanguage])
// })