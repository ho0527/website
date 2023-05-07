let check=document.getElementById("check")

check.innerHTML=``

newform=document.getElementById("newform").onclick=function(){
    check.innerHTML=`
    <div class="mask"></div>
    <div class="main">
        <form>
            問卷名稱: <input type="text" class="input" name="title" placeholder="問卷名稱"><br><br>
            問卷題數: <input type="text" class="input" name="count" placeholder="問卷題數"><br><br>
            <input type="button" class="button" onclick="location.reload()" value="取消">
            <input type="submit" class="button" name="submit" value="確定">
        </form>
    </div>
    `
    document.addEventListener("keydown",function(event){
        if(event.key=="Escape"){
            location.reload()
        }
    })
}