document.getElementById("submit").onclick=function(){
    let search=document.getElementById("search").value; // 文字區域
    let input=document.getElementById("text").innerHTML; // 文字區域

    // 進行關鍵字高亮
    let randomcolor="rgb("+Math.floor(Math.random()*255)+","+Math.floor(Math.random()*255)+","+Math.floor(Math.random()*255)+")"
    let data=input.replace(new RegExp("("+search+")","g"),"<span style='background: "+randomcolor+";'>$1</span>"); // 將匹配的單詞用<span>標籤包裹並添加highlight類

    // 更新文字區域的內容
    document.getElementById("text").innerHTML=data
}