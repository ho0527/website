let verifycodeans
let bigorsmall

function verifycode(){
    bigorsmall=0
    docgetid("key").innerHTML=`請拖動驗證碼'由大排到小'`
    if(Math.floor(Math.random()*2)){
        docgetid("key").innerHTML=`請拖動驗證碼'由小排到大'`
        bigorsmall=1
    }

    verifycodeans=[]
    docgetid("verifycodediv").innerHTML=``
    docgetid("dropbox").innerHTML=``
    for(let i=0;i<4;i=i+1){
        let small="abcdefghijklmnopqrstuvwxvz"
        let big=small.toUpperCase()
        let number="0123456789"
        let wordlist=small+big+number
        let radom=Math.floor(Math.random()*62)
        let word=wordlist[radom]

        docgetid("verifycodediv").innerHTML=`
            ${docgetid("verifycodediv").innerHTML}
            <div class="dragbox">
                <img src="api/verifycode.php?str=${word}" class="dragimage" id="${i}" data-id="${word}" draggable="true">
            </div>
        `

        verifycodeans.push(word)
    }

    if(bigorsmall){
        verifycodeans.sort()
    }else{
        verifycodeans.sort().reverse()
    }

    verifycodeans=verifycodeans.join("")

    docgetall(".dragimage").forEach(function(event){
        event.ondragstart=function(listenerevent){
            listenerevent.dataTransfer.setData("text",listenerevent.target.id)
        }
    })

    docgetid("dropbox").ondragover=function(event){
        event.preventDefault()
    }

    docgetid("dropbox").ondrop=function(event){
        let id=event.dataTransfer.getData("text")
        let data=docgetid(id)
        event.draggable=false
        docgetid("dropbox").appendChild(data)
    }
    console.log("verifycodeans="+verifycodeans)
}

if(!weblsget("45regionalerrortime")){ weblsset("45regionalerrortime",0) }

login(
    function(){
        let verifycodeuserans=""
        docgetall("#dropbox>.dragimage").forEach(function(event){
            verifycodeuserans=verifycodeuserans+event.dataset.id
        })
        if(docgetid("username").value=="admin"&&docgetid("password").value=="1234"){
            alert("登入成功")
        }
        ajax("POST","/backend/45regional/login",function(event){
            let data=JSON.parse(event.responseText)
            if(data["success"]){
                alert("登入成功")
                weblsset("45regionalerrortime",null)
                weblsset("45regionaluserid",data["data"]["id"])
                weblsset("45regionalpermission",data["data"]["permission"])
                if(data["data"]["permission"]=="1"){
                    location.href="admin.html"
                }else{
                    location.href="user.html"
                }
            }else{
                alert(data["data"]["message"])
                weblsset("45regionalerrortime",parseInt(weblsget("45regionalerrortime"))+1)
                if(weblsget("45regionalerrortime")>=3){
                    weblsset("45regionalerrortime",null)
                    location.href="usererror.html"
                }
                verifycode()
            }
        },JSON.stringify({
            "username": docgetid("username").value,
            "password": docgetid("password").value,
            "verifycodeans": verifycodeans,
            "verifycodeuserans": verifycodeuserans
        }),[
            ["Content-Type","application/json"]
        ])
    },
    `
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="/website/material/icon/mainicon.png" class="logo" draggable="false">
            </div>
            <div class="navigationbartitle">TODO工作管理系統</div>
        </div>
    `,
    `
        <div class="main" id="loginmain">
            <div class="iconinputdiv">
                <div class="iconinputtext">帳號:</div>
                <input type="text" class="iconiinputinput input" id="username">
                <div class="iconinputicondiv"><img src="/website/material/icon/user.svg" class="iconinputicon" draggable="false"></div>
            </div>
            <div class="iconinputdiv">
                <div class="iconinputtext">密碼:</div>
                <input type="text" class="iconiinputinput input" id="password">
                <div class="iconinputicondiv"><img src="/website/material/icon/lock.svg" class="iconinputicon" draggable="false"></div>
            </div>
            驗證碼:<br>
            <div id="verifycodediv"></div><br>
            <div id="key"></div>
            <div class="dropbox" id="dropbox"></div><br><br>
            <input type="button" class="button" id="reflashverifycode" value="重新產生">
            <input type="button" class="button" id="clear" value="清除">
            <input type="button" class="button" id="submit" value="登入"><br>
        </div>
    `
)

if(isset(weblsget("45regionalusername"))){ docgetid("username").value=weblsget("45regionalusername") }
if(isset(weblsget("45regionalpassword"))){ docgetid("password").value=weblsget("45regionalpassword") }
verifycode()

docgetid("reflashverifycode").onclick=function(){
    verifycode()
}

docgetid("clear").onclick=function(){
    docgetid("username").value=""
    docgetid("password").value=""
    verifycode()
}

document.onkeydown=function(event){
    if(event.key=="Enter"){
        docgetid("submit").click()
    }
}