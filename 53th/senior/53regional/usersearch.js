let numb=document.getElementById("numb")
let text=document.getElementById("text")
let radiotext=document.getElementById("radiosearchtext")

numb.onclick=function(){
    radiotext.innerHTML=`
        <div class="searchform">
            <input type="number" name="start" placeholder="最低價位">~
            <input type="number" name="end" placeholder="最高價位">
            <input type="submit" name="submit"><br>
            <input type="button" onclick="location.href='?key=num&start=1000&end=2000'" value="1000~2000">
            <input type="button" onclick="location.href='?key=num&start=2000&end=5000'" value="2000~5000">
            <input type="button" onclick="location.href='?key=num&start=5000&end=10000'" value="5000~10000">
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