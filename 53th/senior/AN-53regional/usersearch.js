let numb=document.getElementById("numb")
let text=document.getElementById("text")
let radiotext=document.getElementById("radiosearchtext")

numb.onclick=function(){
    radiotext.innerHTML=`
        <div class="searchform">
            <input type="number" name="start" placeholder="最低價位">~
            <input type="number" name="end" placeholder="最高價位">
            <input type="submit" name="submit">
        </div>
    `
}

text.onclick=function(){
    radiotext.innerHTML=`
        <div class="searchform">
            <input type="text" name="maintext" placeholder="關鍵字">
            <input type="submit" name="submit">
        </div>
    `
}