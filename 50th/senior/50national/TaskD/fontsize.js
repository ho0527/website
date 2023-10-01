// 調整字體大小

if(!isset(weblsget("fontsize"))){ weblsset("fontsize",30) } // 預設值
let fontsize=parseInt(weblsget("fontsize"))

// 縮小
document.getElementById("sizelow").onclick=function(){
    if(fontsize>=12){ // 字體不得小於12
        docgetall("body")[0].style.fontSize=(fontsize-1)+"px" // 調整字體
        docgetall("input").forEach(function(event){ // 將每個input一起調整
            event.style.fontSize=(fontsize-1)+"px"
        })
        fontsize=fontsize-1
    }
}

// 放大
document.getElementById("sizeup").onclick=function(){
    if(fontsize<=50){ // 字體不超過50
        docgetall("body")[0].style.fontSize=fontsize+1+"px" // 調整字體
        docgetall("input").forEach(function(event){ // 將每個input一起調整
            event.style.fontSize=fontsize+1+"px"
        })
        fontsize=fontsize+1
    }
}
