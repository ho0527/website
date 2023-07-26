let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=ajax.response
    if(data=="false"){
        location.href="login.html"
    }
}

lightbox("#new","lightbox",function(){
    return `
        <form method="POST" action="api/newtraintype.php">
            車種名稱: <input type="text" class="lightboxinput" name="name"><br><br>
            乘客乘載量: <input type="text" class="lightboxinput" name="passenger"><br><br>
            <input type="button" class="button" id="close" value="返回">
            <input type="reset" class="button" value="清除">
            <input type="submit" class="button" name="submit" value="送出">
        </form>
    `
},"close")

let ajax2=newajax("GET","api.php?traintypelist=")

ajax2.onload=function(){
    let data=JSON.parse(ajax2.response)
    for(let i=0;i<data.length;i=i+1){
        let tr=doccreate("tr")
        tr.innerHTML=`
            <td class="admintd">${data[i][0]}</td>
            <td class="admintd">${data[i][1]}</td>
            <td class="admintd">${data[i][2]}</td>
            <td class="admintd">
                <input type="button" class="bluebutton editbutton" data-id=${i} value="編輯">
                <input type="button" class="bluebutton" onclick="location.href='api.php?key=deltraintype&id=${data[i][0]}'" value="刪除">
            </td>
        `
        docappendchild("table",tr)
    }

    lightbox(".editbutton","lightbox",function(event){
        let id=event.dataset.id
        return `
            <form method="POST" action="api/edittraintype.php">
                車種id: <input type="text" class="lightboxinput" value="${data[id][0]}" readonly><br><br>
                車種名稱: <input type="text" class="lightboxinput" name="name" value="${data[id][1]}"><br><br>
                乘客乘載量: <input type="text" class="lightboxinput" name="passenger" value="${data[id][2]}"><br><br>
                <input type="hidden" class="lightboxinput" name="id" value="${data[id][0]}">
                <input type="button" class="button" id="close" value="返回">
                <input type="reset" class="button" value="清除">
                <input type="submit" class="button" name="submit" value="送出">
            </form>
        `
    },"close")
}

startmacossection()