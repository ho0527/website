let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=ajax.response
    if(data=="false"){
        location.href="login.html"
    }
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

let ajax2=newajax("GET","api.php?stationlist=")

ajax2.onload=function(){
    let data=JSON.parse(ajax2.response)
    for(let i=0;i<data.length;i=i+1){
        let tr=doccreate("tr")
        tr.innerHTML=`
            <td class="admintd">${data[i][0]}</td>
            <td class="admintd">${data[i][2]}</td>
            <td class="admintd">
                <input type="button" class="bluebutton editbutton" data-id=${i} value="編輯">
                <input type="button" class="bluebutton" onclick="location.href='api.php?key=delstation&id=${data[i][0]}'" value="刪除">
            </td>
        `
        docappendchild("table",tr)
    }

    lightbox(".editbutton","lightbox",function(event){
        let id=event.dataset.id
        return `
            <form method="POST" action="api/editstation.php">
                路線id: <input type="text" class="lightboxinput" value="${data[id][0]}" readonly><br><br>
                路線英文名: <input type="text" class="lightboxinput" name="englishname" value="${data[id][1]}"><br><br>
                路線名稱: <input type="text" class="lightboxinput" name="name" value="${data[id][2]}"><br><br>
                <input type="hidden" class="lightboxinput" name="id" value="${data[id][0]}">
                <input type="button" class="button" id="close" value="返回">
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="送出">
            </form>
        `
    },"close")
}

startmacossection()