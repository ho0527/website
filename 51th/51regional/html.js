function editformnavigationbar(output){
    output.innerHTML=`
    <div class="navigationbar">
        <div class="navigationbartitle">網路問卷管理系統-編輯問卷</div><br>
        <div class="navigationbarbuttondiv">
            id: <input type="text" class="formtext" id="id" style="width:50px" readonly>
            標題: <input type="text" class="formtext" id="title" style="width:120px">
            總數: <input type="text" class="formtext" id="count" style="width:35px" readonly>
            分頁題數: <input type="text" class="formtext" id="pagelen" style="width:35px">
            最大總數: <input type="text" class="formtext" id="maxcount" style="width:50px">
            <input type="button" class="button" onclick="location.href='questioncode.php'" value="問卷邀請碼">
            <input type="button" class="button" onclick="newquestion()" value="新增">
            <input type="button" class="button" onclick="location.href='api.php?cancel='" value="返回">
            <input type="button" class="button" onclick="save()" value="儲存">
            <input type="button" class="button" onclick="location.href='api.php?logout='" value="登出">
        </div>
    </div>
    `
}