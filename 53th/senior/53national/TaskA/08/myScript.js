let page={
    "a.html":"This is page A",
    "b.html":"This is page B",
    "c.html":"This is page C",
}
let url=location.href.split("/")

document.addEventListener("click",function(event){
    let url=location.href.split("/")
    event.preventDefault()
    history.pushState(null,null,event.target.href)
    document.getElementById("content").innerHTML=page[url[url.length-1]]
})

document.getElementById("content").innerHTML=page[url[url.length-1]]