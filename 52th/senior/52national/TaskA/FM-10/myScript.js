let page={
    "a.html":"This is page A",
    "b.html":"This is page B",
    "c.html":"This is page C",
}

function check(){
    let url=(location.href).split("/")
    let content
    if(page[url[url.length-1]]!=undefined){
        content=page[url[url.length-1]]
    }else{
        content="page not found"
    }
    document.getElementById("content").innerHTML=content
}

document.addEventListener("click",function(event){
    if(event.target.matches("[href]")){
        event.preventDefault()
        history.pushState(null,null,event.target.href)
        check()
    }
})

window.addEventListener("load",check())
window.addEventListener("popstate",check())