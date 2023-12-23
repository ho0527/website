function editformnavigationbar(output){
    output.innerHTML=`
    <div class="navigationbar">
        <div class="navigationbarleft"><div class="navigationbartitle">網路問卷管理系統</div></div>
        <div class="navigationbarright">
            <div class="stinput basic forminput" style="width:75px">
                id: <input type="text" class="textcenter textunderline" id="id" style="width:50px" readonly>
            </div>
            <div class="stinput basic forminput" style="width:170px">
                標題: <input type="text" class="textcenter textunderline" id="title" style="width:120px">
            </div>
            <div class="stinput basic forminput" style="width:100px">
                總數: <input type="text" class="textcenter textunderline" id="count" style="width:50px" readonly>
            </div>
            <div class="stinput basic forminput" style="width:130px">
                分頁題數: <input type="text" class="textcenter textunderline" id="pagelen" style="width:50px">
            </div>
            <div class="stinput basic forminput" style="width:130px">
                最大總數: <input type="text" class="textcenter textunderline" id="maxcount" style="width:50px">
            </div>
            <input type="button" class="stbutton outline" onclick="location.href='questioncode.php'" value="問卷邀請碼">
            <input type="button" class="stbutton outline" onclick="newquestion()" value="新增">
            <input type="button" class="stbutton outline" onclick="location.href='api.php?cancel='" value="返回">
            <input type="button" class="stbutton outline" onclick="save()" value="儲存">
            <input type="button" class="stbutton outline" onclick="location.href='api.php?logout='" value="登出">
        </div>
    </div>
    `
}