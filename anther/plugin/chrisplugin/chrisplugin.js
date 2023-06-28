/*
    標題: 插件整合
    參考:
    作者: 小賀chris
    製作及log:
    2023/06/28  20:10:16 Bata 1.0.0 // 新增macosselection 以及 sort 以及 dget 以及 clog 函式

        |-------    -----    -                     -     -----  -----  -----   -------|
       |-------    -        -            - - -          -                     -------|
      |-------    -        -------    -          -     -----    --       --  -------|
     |-------    -        -     -    -          -         -      --     --  -------|
    |-------    -----    -     -    -          -     -----         -----  -------|
*/

let timer

setTimeout(function(){
    document.querySelectorAll(".macossectiondiv").forEach(function(event){
        event.addEventListener("scroll",function(){
            clearTimeout(timer)
            event.setAttribute("scroll","true")
            timer=setTimeout(function(){
                event.removeAttribute("scroll")
            },500)
        })
    })
    document.querySelectorAll(".macossectiondivx").forEach(function(event){
        event.addEventListener("scroll",function(){
            clearTimeout(timer)
            event.setAttribute("scroll","true")
            timer=setTimeout(function(){
                event.removeAttribute("scroll")
            },500)
        })
    })
    document.querySelectorAll(".macossectiondivall").forEach(function(event){
        event.addEventListener("scroll",function(){
            clearTimeout(timer)
            event.setAttribute("scroll","true")
            timer=setTimeout(function(){
                event.removeAttribute("scroll")
            },500)
        })
    })
},200)


function divsort(card,sortdiv){ // card 放要被拖的物件 cardclass(不加選擇器) sortdiv 放要放的物件(加選擇器)
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

function docget(key,selector){ // 傳入 id animation class name tag tagns qtor all 分別對應為 getElementById getAnimations getElementsByClassName getElementsByName getElementsByTagName getElementsByTagNameNS querySelector querySelectorAll 之後傳入要執行的selector
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
    clog("[ERROR]dget key not found"+key)
}

function conlog(data){ // consloe.log 值出來
    console.log(data)
}