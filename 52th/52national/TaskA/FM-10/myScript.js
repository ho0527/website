const pages={
    a:{
        content:'<h1>This is page A</h1>'//A頁內容
    },
    b:{
        content:'<h1>This is page B</h1>'//B頁內容
    },
    c:{
        content:'<h1>This is page C</h1>'//C頁內容
    }
}

function switchPage(pageId){
    document.getElementById('content').innerHTML=pages[pageId].content//更換文字
}