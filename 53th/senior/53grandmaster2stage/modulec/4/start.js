// 開始遊戲
docgetid("startgame").onclick=function(){
    if(docgetid("nickname").value!=""){
        docgetid("start").style.display="none"
        docgetid("game").style.display="block"
        weblsset("53grandmaster2stagemodulecnickname",docgetid("nickname").value)
    }else{
        alert("pls type nickname!")
    }
}