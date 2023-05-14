let userkey
function user(key){
    if(key=="true"){
        document.getElementById("body").innerHTML=`
            <form method="POST">
                <div class="navigationbar">
                    <div class="navigationbartitle">網路問卷管理系統-填寫問卷</div><br>
                    <div class="navigationbarbuttondiv">
                        id: <input type="text" class="formtext" id="id" style="width:50px" readonly>
                        標題: <input type="text" class="formtext" id="title" style="width:120px">
                        總數: <input type="text" class="formtext" id="count" style="width:35px" readonly>
                        <input type="button" class="button" onclick="location.href='index.php'" value="返回">
                        <input type="button" class="button" onclick="save()" value="儲存">
                        <input type="submit" class="button" onclick="save()" value="送出">
                        <input type="button" class="button" onclick="location.href='api.php?logout='" value="登出">
                    </div>
                </div>
                <div class="macosmaindiv macossectiondiv">
                    <table id="maintable"></table>
                </div>
            </form>
        `
    }else{
        document.getElementById("body").innerHTML=`
            <div class="navigationbar">
                <div class="navigationbartitle">網路問卷管理系統-填寫問卷</div><br>
                <div class="navigationbarbuttondiv">
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