let userkey
function user(key){
    if(key=="true"){
        document.getElementById("body").innerHTML=`
            <div class="navigationbar">
                <div class="navigationbarleft"><div class="navigationbartitle">網路問卷管理系統</div></div>
                <div class="navigationbarright">
                    id: <input type="text" class="formtext" id="id" style="width:50px" readonly>
                    標題: <input type="text" class="formtext" id="title" style="width:120px">
                    總數: <input type="text" class="formtext" id="count" style="width:35px" readonly>
                    <input type="button" class="button" onclick="location.href='index.php'" value="返回">
                    <input type="button" class="button" onclick="tempsave()" value="送出">
                    <input type="button" class="button" onclick="location.href='api.php?logout='" value="登出">
                </div>
            </div>
            <div class="macosmaindiv macossectiondiv" id="maindiv"></div>
        `
    }else{
        document.getElementById("body").innerHTML=`
            <div class="navigationbar">
                <div class="navigationbarleft"><div class="navigationbartitle">網路問卷管理系統</div></div>
                <div class="navigationbarright">
                    id: <input type="text" class="formtext" id="id" style="width:50px" readonly>
                    標題: <input type="text" class="formtext" id="title" style="width:120px">
                    <input type="button" class="button" onclick="location.href='index.php'" value="返回">
                </div>
            </div>
            <div class="warning center">
                ${key}
            </div>
        `
    }
    userkey=key
}