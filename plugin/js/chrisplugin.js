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
    2023/07/09  21:54:50 Bata 1.0.5 // 新增newajax函式
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

function divsort(card,sortdiv){
    let data=[]

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
        }
    })

    document.querySelectorAll(card).forEach(function(event){
        data.push(event)
    })

    return data
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
    if(data!=null||data!=undefined){ return true }
    else{ return false }
}

function blank(data){
    if(data!=null||data!=undefined||data!=""){ return true }
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

function newajax(method,url,send=null,header=["Content-type","multipart/form-data"]){
    let ajax=new XMLHttpRequest()
    ajax.open(method,url)
    for(let i=0;i<header.length;i=i+1){
        ajax.setRequestHeader(header[i][0],header[i][1])
    }
    ajax.send(send)

    return ajax
}

function lightbox(clickelement,element,lightboxhtml,closelement=null,islightboxclosewithkeyesc=true,clickcolse="mask"){
    docgetid(element).classList.add("lightboxmask")

    setTimeout(function(){
        if(clickelement==null){
            docgetid(element).innerHTML=``
            docgetid(element).style.display="block"
            setTimeout(function(){
                docgetid(element).style.transform="translateY(0)"
            },10)
            html=`
                <div class="lightboxmain macossectiondiv">
                    ${lightboxhtml()}
                </div>
            `
            docgetid(element).innerHTML=html
            if(closelement!=null){
                docgetid(closelement).onclick=function(){
                    docgetid(element).style.transform="translateY(-100%)"

                    setTimeout(function(){
                        docgetid(element).style.display="none"
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
                    },10)
                    html=`
                        <div class="lightboxmain macossectiondiv">
                            `+lightboxhtml(event)+`
                        </div>
                    `
                    docgetid(element).innerHTML=html
                    if(closelement!=null){
                        docgetid(closelement).onclick=function(){
                            docgetid(element).style.transform="translateY(-100%)"
                            setTimeout(function(){
                                docgetid(element).style.display="none"
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
                    setTimeout(function() {
                        docgetid(element).style.display="none"
                        docgetid(element).innerHTML=``
                    },300)
                }
            })
        }

        if(clickcolse=="body"){
            document.onclick=function(){
                docgetid(element).style.transform="translateY(-100%)"
                setTimeout(function(){
                    docgetid(element).style.display="none"
                    docgetid(element).innerHTML=``
                },300)
            }
        }else if(clickcolse=="mask"){
            docgetid(element).onclick=function(event){
                if(event.target==docgetid(element)){
                    docgetid(element).style.transform="translateY(-100%)"
                    setTimeout(function(){
                        docgetid(element).style.display="none"
                        docgetid(element).innerHTML=``
                    },300)
                }
            }
        }else if(clickcolse=="none"){
        }else{
            console.log("lightbox clickcolse變數 錯誤")
            return "lightbox clickcolse變數 錯誤"
        }
    },70)
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

function regexpreplace(data,replacetext,regexptext,regexpstring=""){
    return data.replace(new RegExp.replace(regexptext,regexpstring),replacetext)
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