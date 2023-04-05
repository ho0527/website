let page={
    "a.html":"This is page A",
    "b.html":"This is page B",
    "c.html":"This is page C",
}

function check(){
    let url=location.href.split("/")
    document.getElementById("content").innerHTML=page[url[url.length-1]]
}

document.addEventListener("click",function(addeventlistenerevent){
    console.log(addeventlistenerevent)
    addeventlistenerevent.preventDefault()
    history.pushState(null,null,addeventlistenerevent.target.href)
    check()
})

check()