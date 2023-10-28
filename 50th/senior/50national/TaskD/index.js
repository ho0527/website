let difficulty="normal" // 預設難易度

// 難易度調整 START
document.getElementById("easy").onclick=function(){
    document.getElementById("easy").classList.add("selectbutton")
    document.getElementById("normal").classList.remove("selectbutton")
    document.getElementById("hard").classList.remove("selectbutton")
    difficulty="easy"
}

document.getElementById("normal").onclick=function(){
    document.getElementById("normal").classList.add("selectbutton")
    document.getElementById("easy").classList.remove("selectbutton")
    document.getElementById("hard").classList.remove("selectbutton")
    difficulty="normal"
}

document.getElementById("hard").onclick=function(){
    document.getElementById("hard").classList.add("selectbutton")
    document.getElementById("easy").classList.remove("selectbutton")
    document.getElementById("normal").classList.remove("selectbutton")
    difficulty="hard"
}
// 難易度調整 END

// 開始遊戲
document.getElementById("startgame").onclick=function(){
    localStorage.setItem("50nationalmoduleddifficulty",difficulty) // 上傳資料
    localStorage.setItem("50nationalmoduledname",document.getElementById("username").value) // 上傳資料
    location.href="main.html" // 導向
}

// 開始教學
docgetid("starttutorial").onclick=function(){

}