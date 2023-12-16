/*
    標題: 插件整合
    參考: 無
    作者: 小賀chris
    製作及log:
    2023/06/28  20:10:16 Bata 1.0.0 // 新增macosselection 以及 sort 以及 dget 以及 clog函式
    2023/06/30  14:35:45 Bata 1.0.1 // 新增isset函式
    2023/07/01  12:52:01 Bata 1.0.2 // 修改變數及小問題
    2023/07/01  12:56:24 Bata 1.0.3 // 新增docgetid 及 docgetall 及 weblsset 及 weblsget函式
    2023/07/02  23:39:12 Bata 1.0.4 // 新增doccreate函式
    2023/07/09  21:54:50 Bata 1.0.5 // 新增ajax函式
    2023/07/12  13:51:52 Bata 1.0.6 // 新增lightbox函式
    2023/07/13  19:08:05 Bata 1.0.7 // 新增docappendchild函式
    2023/07/15  20:22:11 Bata 1.0.8 // 新增regexp 及 regexpmatch 及 regexpreplace 函式
    2023/07/16  15:24:44 Bata 1.0.9 // 修改conlog函式
    2023/07/20  13:28:05 Bata 1.0.10 // 新增ajaxdata函式
    2023/07/21  18:38:23 Bata 1.0.11 // 修改ajaxdata函式
    2023/07/23  18:18:28 Bata 1.0.12 // 新增pagechanger函式
    2023/07/25  22:12:42 Bata 1.0.13 // 修改lightbox函式
    2023/07/25  10:50:11 Bata 1.0.14 // 修改lightbox函式
    2023/08/01  23:22:33 Bata 1.0.15 // 修改formdata函式
    2023/08/09  18:27:14 Bata 1.0.16 // 修改lightbox函式新增clickcolse變數
    2023/09/14  16:57:12 Bata 1.0.17 // 更新startmacossection函式
    2023/11/20  18:01:04 Bata 1.0.18 // 新增hintbox函式
    2023/12/04  14:23:29 Bata 1.0.19 // 新增tag函式

        |-------    -----    -                     -     -----  -----  -----   -------|
       |-------    -        -            - - -          -                     -------|
      |-------    -        -------    -          -     -----    --       --  -------|
     |-------    -        -     -    -          -         -      --     --  -------|
    |-------    -----    -     -    -          -     -----         -----  -------|
*/

function startmacossection(){
    let macostimer
    setInterval(function(){
        docget("qtor","body").onscroll=function(){
            clearTimeout(macostimer)
            docget("qtor","body").setAttribute("scroll","true")
            macostimer=setTimeout(function(){
                docget("qtor","body").removeAttribute("scroll")
            },500)
        }
        document.querySelectorAll(".macossectiondiv").forEach(function(event){
            event.addEventListener("scroll",function(){
                clearTimeout(macostimer)
                event.setAttribute("scroll","true")
                macostimer=setTimeout(function(){
                    event.removeAttribute("scroll")
                },500)
            })
        })
        document.querySelectorAll(".macossectiondivx").forEach(function(event){
            event.addEventListener("scroll",function(){
                clearTimeout(macostimer)
                event.setAttribute("scroll","true")
                macostimer=setTimeout(function(){
                    event.removeAttribute("scroll")
                },500)
            })
        })
        document.querySelectorAll(".macossectiondivy").forEach(function(event){
            event.addEventListener("scroll",function(){
                clearTimeout(macostimer)
                event.setAttribute("scroll","true")
                macostimer=setTimeout(function(){
                    event.removeAttribute("scroll")
                },500)
            })
        })
    },200)
}

function divsort(card,sortdiv,callback){
    document.querySelectorAll("."+card).forEach(function(event){
        event.draggable="true"
    })

    document.querySelectorAll(sortdiv).forEach(function(event){
        event.ondragstart=function(addeventlistenerevent){
            addeventlistenerevent.target.classList.add("divsortdragging")
        }

        event.ondragover=function(addeventlistenerevent){
            addeventlistenerevent.preventDefault()
            let sortableContainer=addeventlistenerevent.target.closest(sortdiv)
            if(sortableContainer){
                let draggableElements=Array.from(sortableContainer.children).filter(function(child){
                    return child.classList.contains(card)&&!child.classList.contains("divsortdragging")
                })

                let afterElement=draggableElements.reduce(function(closest,child){
                    let box=child.getBoundingClientRect()
                    let offset=addeventlistenerevent.clientY-box.top-box.height/2
                    if(offset<0&&offset>closest.offset){
                        return { offset:offset,element:child }
                    }else{
                        return closest
                    }
                },{ offset:Number.NEGATIVE_INFINITY }).element

                let draggable=document.querySelector(".divsortdragging")
                if(afterElement==null){
                    sortableContainer.appendChild(draggable)
                }else{
                    sortableContainer.insertBefore(draggable,afterElement)
                }
            }
        }

        event.ondragend=function(addeventlistenerevent){
            addeventlistenerevent.target.classList.remove("divsortdragging")
            callback()
        }
    })

}

function docget(key,selector){
    if(key=="id"){
        return document.getElementById(selector)
    }
    if(key=="animation"){
        return document.getAnimations(selector)
    }
    if(key=="class"){
        return document.getElementsByClassName(selector)
    }
    if(key=="name"){
        return document.getElementsByName(selector)
    }
    if(key=="tag"){
        return document.getElementsByTagName(selector)
    }
    if(key=="tagns"){
        return document.getElementsByTagNameNS(selector)
    }
    if(key=="qtor"){
        return document.querySelector(selector)
    }
    if(key=="all"){
        return document.querySelectorAll(selector)
    }
    conlog("[ERROR]dget key not found"+key)
}

function docgetid(selector){
    return document.getElementById(selector)
}

function docgetall(selector){
    return document.querySelectorAll(selector)
}

function conlog(data,color="white",size="12",weight="normal"){
    console.log(`%c${data}`,`color:${color};font-size:${size}px;font-weight:${weight}`)
}

function isset(data){
    if(data!=null&&data!=undefined){ return true }
    else{ return false }
}

function blank(data){
    if(data!=null&&data!=undefined&&data!=""){ return true }
    else{ return false }
}

function weblsset(data,value){
    if(value==null){
        return localStorage.removeItem(data)
    }else{
        return localStorage.setItem(data,value)
    }
}

function weblsget(data){
    return localStorage.getItem(data)
}

function doccreate(element){
    return document.createElement(element)
}

function oldajax(method,url,send=null,header=[["Content-type","multipart/form-data"]]){
    let xmlrequest=new XMLHttpRequest()
    xmlrequest.open(method,url)
    for(let i=0;i<header.length;i=i+1){
        xmlrequest.setRequestHeader(header[i][0],header[i][1])
    }
    xmlrequest.send(send)
    return xmlrequest
}

function ajax(method,url,onloadcallback,send=null,header=[["Content-type","multipart/form-data"]],callback=[]){
    let check=true
    if(method==null){
        conlog("function ajax method requset","red","12")
        check=false
    }
    if(url==null){
        conlog("function ajax method requset","red","12")
        check=false
    }
    if(onloadcallback==null){
        conlog("function ajax method requset","red","12")
        check=false
    }
    if(check){
        let xmlhttprequest=new XMLHttpRequest()
        xmlhttprequest.open(method,url)
        if(header.length==0&&send instanceof FormData){
            // Don't set Content-Type for FormData
        }else{
            for(let i=0;i<header.length;i=i+1){
                xmlhttprequest.setRequestHeader(header[i][0],header[i][1])
            }
        }
        xmlhttprequest.onload=function(){ onloadcallback(this) }
        xmlhttprequest.send(send)
        for(let i=0;i<callback.length;i=i+1){
            xmlhttprequest[callback[i][0]]=function(){ callback[i][1](this) }
        }
        return xmlhttprequest
    }
}

function lightbox(clickelement,element,lightboxhtml,closelement=null,islightboxclosewithkeyesc=true,clickcolse="mask"){
    docgetid(element).classList.add("lightboxmask")

    if(!isset(clickelement)){
        docgetid(element).innerHTML=``
        setTimeout(function(){
            docgetid(element).style.transform="translateY(0)"
        },300)
        docgetid(element).innerHTML=`
            <div class="lightboxmain macossectiondiv">
                ${lightboxhtml()}
            </div>
        `
        if(closelement){
            docgetid(closelement).onclick=function(){
                docgetid(element).style.transform="translateY(-100%)"

                setTimeout(function(){
                    docgetid(element).innerHTML=``
                },300)
            }
        }
    }else{
        docgetid(element).innerHTML=``
        docgetall(clickelement).forEach(function(event){
            event.onclick=function(){
                docgetid(element).style.display="block"
                setTimeout(function(){
                    docgetid(element).style.transform="translateY(0)"
                },300)
                docgetid(element).innerHTML=`
                    <div class="lightboxmain macossectiondiv">
                        `+lightboxhtml(event)+`
                    </div>
                `
                if(closelement!=null){
                    docgetid(closelement).onclick=function(){
                        docgetid(element).style.transform="translateY(-100%)"
                        setTimeout(function(){
                            docgetid(element).innerHTML=``
                        },300)
                    }
                }
            }
        })
    }

    if(islightboxclosewithkeyesc){
        document.addEventListener("keydown",function(event){
            if(event.key=="Escape"){
                event.preventDefault()
                docgetid(element).style.transform="translateY(-100%)"
                setTimeout(function(){
                    docgetid(element).innerHTML=``
                },300)
            }
        })
    }

    if(clickcolse=="body"){
        document.onclick=function(){
            docgetid(element).style.transform="translateY(-100%)"
            setTimeout(function(){
                docgetid(element).innerHTML=``
            },300)
        }
    }else if(clickcolse=="mask"){
        docgetid(element).onclick=function(event){
            if(event.target==docgetid(element)){
                docgetid(element).style.transform="translateY(-100%)"
                setTimeout(function(){
                    docgetid(element).innerHTML=``
                },300)
            }
        }
    }else if(clickcolse=="none"){
    }else{
        console.log("lightbox clickcolse變數 錯誤")
        return "lightbox clickcolse變數 錯誤"
    }
}

function docappendchild(element,chlidelement){
    return docgetid(element).appendChild(chlidelement)
}

function regexp(regexptext,regexpstring){
    return new RegExp.test(regexptext,regexpstring)
}

function regexpmatch(regexptext,data){
    return regexptext.exec(data)
}

function regexpreplace(data,regexpstring,replacetext){
    return data.replace(regexpstring,replacetext)
}

function formdata(data=[]){
    let formdata=new FormData()
    for(let i=0;i<data.length;i=i+1){
        formdata.append(data[i][0],data[i][1])
    }
    return formdata
}

function pagechanger(data,ipp,key,callback){
    if(!isset(weblsget("pagecount"))){ weblsset("pagecount",1) }
    let row=data
    let pagecount=parseInt(weblsget("pagecount"))
    let itemperpage=ipp
    let maxpagecount=Math.ceil(row.length/itemperpage)
    if(key=="first"){
        pagecount=1
    }else if(key=="prev"){
        pagecount=Math.max(1,pagecount-1)
    }else if(key=="next"){
        pagecount=Math.min(pagecount+1,maxpagecount)
    }else if(key=="end"){
        pagecount=maxpagecount
    }

    weblsset("pagecount",pagecount)
    let page=parseInt(weblsget("pagecount"))
    let start=(page-1)*itemperpage;
    let rowcount=Math.min(row.length-start,itemperpage);
    let end=start+rowcount;

    for(let i=start;i<end;i=i+1){
        callback(row[i])
    }
}

function hintbox(endcallback=function(){},hintname=".hintdiv"){
    let hintlist=[]
    let hintcount=0

    docgetall(hintname).forEach(function(event){
        event.style.position="relative"
        hintlist[parseInt(event.dataset.id)]=event
    })

    function clear(){
        for(let i=0;i<hintlist.length;i=i+1){
            if(docgetid("hintbox")){
                docgetid("hintbox").remove()
            }
        }
    }

    function main(){
        clear()
        hintlist[hintcount].innerHTML=`
            ${hintlist[hintcount].innerHTML}
            <div class="hintbox" id="hintbox">
                <div class="hiintboxclose" id="chrispluginhintboxclear">X</div>
                <div class="hiintboxbody">${hintlist[hintcount].dataset.body}</div>
                <div class="hiintboxbuttondiv">
                    <input type="button" class="hintboxbutton hintboxbuttonleft" id="chrispluginhintboxprev" value="prev">
                    <input type="button" class="hintboxbutton hintboxbuttonright" id="chrispluginhintboxnext" value="next">
                </div>
            </div>
        `

        docgetid("chrispluginhintboxclear").onclick=function(){
            clear()
            endcallback()
        }

        docgetid("chrispluginhintboxprev").onclick=function(){
            if(hintcount>0){
                hintcount=hintcount-1
                main()
            }
        }

        docgetid("chrispluginhintboxnext").onclick=function(){
            if(hintcount<hintlist.length-1){
                hintcount=hintcount+1
                main()
            }else{
                clear()
                endcallback()
            }
        }
    }
    main()
}

function login(
    submitfunction=function(){},
    navbar=`
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="/website/material/icon/mainicon.png" class="logo" draggable="false">
                <div class="maintitle">title</div>
            </div>
            <div class="navigationbarright">
            </div>
        </div>
    `,
    center=`
        <div class="main" id="loginmain">
            <div class="iconinputdiv">
                <div class="iconinputtext">帳號:</div>
                <input type="text" class="iconiinputinput input" id="username">
                <div class="iconinputicondiv"><img src="/website/material/icon/user.svg" class="iconinputicon" draggable="false"></div>
            </div>
            <div class="iconinputdiv">
                <div class="iconinputtext">密碼:</div>
                <input type="password" class="iconiinputinput input" id="password">
                <div class="iconinputicondiv"><img src="/website/material/icon/eyeclose.svg" class="iconinputicon cursor_pointer" id="passwordicon" draggable="false"></div>
            </div>
            <input type="button" class="button" id="signup" value="註冊">
            <input type="button" class="button" id="submit" value="登入"><br>
        </div>
    `,
    footer=``
){
    docgetall("body")[0].innerHTML=`
        ${navbar}
        ${center}
        ${footer}
    `

    docgetall(".iconinputdiv").forEach(function(event){
        event.onclick=function(){
            event.children[1].focus()
        }
    })

    if(docgetid("passwordicon")){
        if(weblsget("passwordshow")=="true"){
            docgetid("passwordicon").src="/website/material/icon/eyeopen.svg"
            docgetid("password").type="text"
        }else{
            docgetid("passwordicon").src="/website/material/icon/eyeclose.svg"
            docgetid("password").type="password"
        }

        docgetid("passwordicon").onclick=function(){
            if(weblsget("passwordshow")=="true"){
                docgetid("passwordicon").src="/website/material/icon/eyeclose.svg"
                docgetid("password").type="password"
                weblsset("passwordshow","false")
            }else{
                docgetid("passwordicon").src="/website/material/icon/eyeopen.svg"
                docgetid("password").type="text"
                weblsset("passwordshow","true")
            }
        }
    }

    docgetid("submit").onclick=submitfunction
}

function signin(
    submitfunction=function(){},
    navbar=`
        <div class="navigationbar">
            <div class="navigationbarleft">
                <img src="/website/material/icon/mainicon.png" class="logo" draggable="false">
                <div class="maintitle">title</div>
            </div>
            <div class="navigationbarright">
            </div>
        </div>
    `,
    center=`
        <div class="main" id="loginmain">
            <div class="iconinputdiv">
                <div class="iconinputtext">帳號:</div>
                <input type="text" class="iconiinputinput input" id="username">
                <div class="iconinputicondiv"><img src="/website/material/icon/user.svg" class="iconinputicon" draggable="false"></div>
            </div>
            <div class="iconinputdiv">
                <div class="iconinputtext">密碼:</div>
                <input type="password" class="iconiinputinput input" id="password">
                <div class="iconinputicondiv"><img src="/website/material/icon/eyeclose.svg" class="iconinputicon cursor_pointer" id="passwordicon" draggable="false"></div>
            </div>
            <input type="button" class="button" id="signup" value="註冊">
            <input type="button" class="button" id="submit" value="登入"><br>
        </div>
    `,
    footer=``
){
    docgetall("body")[0].innerHTML=`
        ${navbar}
        ${center}
        ${footer}
    `

    docgetall(".iconinputdiv").forEach(function(event){
        event.onclick=function(){
            event.children[1].focus()
        }
    })

    if(docgetid("passwordicon")){
        if(weblsget("passwordshow")=="true"){
            docgetid("passwordicon").src="/website/material/icon/eyeopen.svg"
            docgetid("password").type="text"
        }else{
            docgetid("passwordicon").src="/website/material/icon/eyeclose.svg"
            docgetid("password").type="password"
        }

        docgetid("passwordicon").onclick=function(){
            if(weblsget("passwordshow")=="true"){
                docgetid("passwordicon").src="/website/material/icon/eyeclose.svg"
                docgetid("password").type="password"
                weblsset("passwordshow","false")
            }else{
                docgetid("passwordicon").src="/website/material/icon/eyeopen.svg"
                docgetid("password").type="text"
                weblsset("passwordshow","true")
            }
        }
    }

    docgetid("submit").onclick=submitfunction
}

function smoothscroll(id){
    if(document.getElementById(id)){
        document.getElementById(id).scrollIntoView({ behavior: "smooth" })
    }else{
        conlog("[ERROR]function smoothscroll id not found","red","12")
    }
}

function closelightbox(){
    docgetall(".lightboxmask")[0].style.transform="translateY(-100%)"

    setTimeout(function(){
        docgetall(".lightboxmask")[0].innerHTML=``
    },300)
}

function tag(tagdiv,taglist){
    let tagset=new Set()

    function updatetaglist(){
        docgetid("taglist").innerHTML=``
        for(let i=0;i<taglist.length;i=i+1){
            docgetid("taglist").innerHTML=`
                ${docgetid("taglist").innerHTML}
                <div class="tag" data-name="${taglist[i]["name"]}" style="background: ${taglist[i]["color"]}">
                    ${taglist[i]["name"]}
                </div>
            `
        }

        // 觸發點擊事件
        docgetall("#taglist>.tag").forEach(function(event){
            event.onclick=function(){
                selecttag(event.dataset.name)
            }
        })
    }

    function selecttag(tagname){
        if(!tagset.has(tagname)){
            let color

            tagset.add(tagname)

            for(let i=0;i<taglist.length;i=i+1){
                if(taglist[i]["name"]==tagname){
                    color=taglist[i]["color"]
                    break
                }
            }

            docgetid("selecttag").innerHTML=`
                ${docgetid("selecttag").innerHTML}
                <div class="tag" data-name="${tagname}" style="background: ${color}">
                    ${tagname}
                    <div class="tagdelete">X</div>
                </div>
            `

            // 觸發點擊事件
            docgetall("#selecttag>.tag").forEach(function(event){
                event.querySelector(".tagdelete").onclick=function(){
                    tagset.delete(event.dataset.name)
                    event.remove()
                    updatetaglist()
                    filtertags()
                    docgetid("taglist").style.display="block"
                }
            })

            docgetid("taginput").value=""
            docgetid("taglist").style.display="block"
        }
    }

    function filtertags(){
        let value=docgetid("taginput").value.toLowerCase()

        docgetid("taglist").style.display="block"

        for(let i=0;i<taglist.length;i=i+1){
            let tagElement=docgetid("taglist").querySelector(`.tag:nth-child(${taglist[i]["id"]})`)
            if(taglist[i]["name"].toLowerCase().includes(value)){
                tagElement.style.display="block"
            }else{
                tagElement.style.display="none"
            }
        }
    }

    docgetid("tagdiv").classList.add("tagdiv")

    docgetid(tagdiv).innerHTML=`
        <div class="tagcontrol">
            <div class="tagwrapper">
                <div class="selecttag" id="selecttag"></div>
                <input type="text" class="taginput" id="taginput" placeholder="Add a tag...">
            </div>
        </div>
        <div class="taglist" id="taglist"></div>
    `

    updatetaglist()

    docgetid("taginput").oninput=filtertags

    docgetid("taginput").onkeydown=function(event){
        if(event.key=="Enter"){
            let value=event.target.value.trim()
            if(value&&!tagset.has(value)){
                // 查看是否有資料
                if(!taglist.find(function(tag){ tag.name.toLowerCase()==value.toLowerCase() })){
                    // 新增tag
                    taglist.push({ id: taglist.length+1,name: value,color: "" })
                    updatetaglist()
                    selecttag(value)
                }else{
                    selecttag(value)
                }
            }
            event.target.value=""
        }else if(event.key=="Backspace"&&event.target.value==""){
            let selectedtagsDiv=docgetid("selected-taglist")
            let lasttag=selectedtagsDiv.lastChild
            if(lasttag){
                tagset.delete(lasttag.textContent)
                selectedtagsDiv.removeChild(lasttag)
            }
        }
    }

    docgetid("taginput").onfocus=function(){
        docgetid("taglist").style.display="block"
        filtertags() // 確保在顯示時更新標籤列表
    }

    document.onclick=function(event){
        if(event.target.id!="taginput"&&event.target.id!="taglist"){
            docgetid("taglist").style.display="none"
        }
    }

    divsort("tag","#selecttag")
}

window.onload=function(){
    if(docgetid("lightbox")){
        docgetid("lightbox").classList.add("lightboxmask")
    }
}

function passwordshowhide(url="/website/",id="passwordicon"){
    if(docgetid(id)){
        if(weblsget("passwordshow")=="true"){
            docgetid(id).src=url+"material/icon/eyeopen.svg"
            docgetid("password").type="text"
        }else{
            docgetid(id).src=url+"material/icon/eyeclose.svg"
            docgetid("password").type="password"
        }

        docgetid(id).onclick=function(){
            if(weblsget("passwordshow")=="true"){
                docgetid(id).src=url+"material/icon/eyeclose.svg"
                docgetid("password").type="password"
                weblsset("passwordshow","false")
            }else{
                docgetid(id).src=url+"material/icon/eyeopen.svg"
                docgetid("password").type="text"
                weblsset("passwordshow","true")
            }
        }
    }

}