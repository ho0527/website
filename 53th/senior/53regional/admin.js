let seconds
let asktimer=5

docgetid("changetimer").value=weblsget("53regionaltime")
seconds=docgetid("changetimer").value
docgetid("timer").value=seconds
let timer=setInterval(function(){
    seconds=seconds-1
    if(seconds==0){
        clearInterval(timer)
        setTimeout(function(){
            docgetid("timer").value=0
            lightbox(null,"lightbox",function(){
                return `
                    是否繼續操作?<br>
                    <input type="button" class="button" onclick="location.reload()" value="Yes">
                    <input type="button" class="button" onclick="logout()" value="否">
                `
            })
            setTimeout(function(){
                logout()
            },5000)
        },100)
    }
    docgetid("timer").value=seconds
},1000)

docgetid("resetbutton").onclick=function(){
    location.reload()
}

docgetid("changetimersubmit").onclick=function(){
    weblsset("53regionaltime",docgetid("changetimer").value)
    location.reload()
}