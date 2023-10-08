if(!weblsget("46nationalmoduleduserid")){
    alert("請先登入")
    location.href="login.html"
}

lightbox("#new","lightbox",function(){
    return `
        <form method="POST" action="api/newstation.php">
            路線名稱: <input type="text" class="lightboxinput" name="name"><br><br>
            路線英文名: <input type="text" class="lightboxinput" name="englishname"><br><br>
            <input type="button" class="button" id="close" value="返回">
            <input type="reset" class="button" value="清除">
            <input type="submit" class="button" name="submit" value="送出">
        </form>
    `
},"close")

newajax("GET","/backend/46nationalmoduled/mangerstation/").onload=function(){
    let data=JSON.parse(this.response)
    let row=data["data"]
    for(let i=0;i<row.length;i=i+1){
        let tr=doccreate("tr")
        tr.innerHTML=`
            <td class="admintd">${row[i][0]}</td>
            <td class="admintd">${row[i][2]}</td>
            <td class="admintd">
                <input type="button" class="bluebutton editbutton" data-id=${i} value="編輯">
                <input type="button" class="bluebutton" onclick="location.href='api.php?key=delstation&id=${row[i][0]}'" value="刪除">
            </td>
        `
        docappendchild("table",tr)
    }

    lightbox(".editbutton","lightbox",function(event){
        let id=event.dataset.id
        return `
            <form method="POST" action="api/editstation.php">
                路線id: <input type="text" class="lightboxinput" value="${row[id][0]}" readonly><br><br>
                路線英文名: <input type="text" class="lightboxinput" name="englishname" value="${row[id][1]}"><br><br>
                路線名稱: <input type="text" class="lightboxinput" name="name" value="${row[id][2]}"><br><br>
                <input type="hidden" class="lightboxinput" name="id" value="${row[id][0]}">
                <input type="button" class="button" id="close" value="返回">
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="送出">
            </form>
        `
    },"close")
}

startmacossection()