let verifycodeans
let bigorsmall

function main(){
    if(isset(weblsget("53regionalusername"))){ docgetid("username").value=weblsget("53regionalusername") }
    if(isset(weblsget("53regionalpassword"))){ docgetid("password").value=weblsget("53regionalpassword") }

    bigorsmall=0
    docgetid("key").innerHTML=`'由大排到小'`
    if(Math.floor(Math.random()*2)){
        docgetid("key").innerHTML=`'由小排到大'`
        bigorsmall=1
    }

    verifycodeans=[]
    docgetid("verifycode").innerHTML=``
    docgetid("dropbox").innerHTML=``
    for(let i=0;i<4;i=i+1){
        let small="abcdefghijklmnopqrstuvwxvz"
        let big=small.toUpperCase()
        let number="0123456789"
        let wordlist=small+big+number
        let radom=Math.floor(Math.random()*62)
        let word=wordlist[radom]

        docgetid("verifycode").innerHTML=`
            ${docgetid("verifycode").innerHTML}
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

if(!isset(weblsget("53regionalerrortime"))){ weblsset("53regionalerrortime",0) }
main()

docgetid("reflash").onclick=function(){
    main()
}

docgetid("clear").onclick=function(){
    weblsset("53regionalusername",null)
    weblsset("53regionalpassword",null)
    main()
}

docgetid("login").onclick=function(){
    let verifycodeuserans=""
    docgetall("#dropbox>.dragimage").forEach(function(event){
        verifycodeuserans=verifycodeuserans+event.dataset.id
    })
    newajax("POST","api/login.php",formdata([
        ["submit",true],
        ["username",docgetid("username").value],
        ["password",docgetid("password").value],
        ["verifycodeans",verifycodeans],
        ["verifycodeuserans",verifycodeuserans],
    ])).onload=function(){
        let data=JSON.parse(this.responseText)
        if(data["success"]){
            alert("登入成功")
            weblsset("53regionalerrortime",null)
            weblsset("53regionaluserid",data["data"]["id"])
            weblsset("53regionalpermission",data["data"]["permission"])
            weblsset("53regionaltime",30)
            newajax("GET","api/logindb.php?key=success&number="+data["usernumber"]).onload=function(){
                let data=JSON.parse(this.responseText)
                if(data["success"]){
                    location.href="verify.php"
                }
            }
        }else{
            alert(data["data"])
            if(data["data"]!="未知錯誤請重新登入"){
                weblsset("53regionalerrortime",parseInt(weblsget("53regionalerrortime"))+1)
                if(weblsget("53regionalerrortime")>=3){
                    newajax("GET","api/logindb.php?key=error&number="+data["usernumber"]).onload=function(){
                        let data=JSON.parse(this.responseText)
                        if(data["success"]){
                            weblsset("53regionalerrortime",null)
                            location.href="usererror.html"
                        }
                    }
                }
            }
            main()
        }
    }
}