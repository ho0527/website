let data=[]


function sort(card,sortdiv){ // card 放要被拖的物件 sortdiv 放要放的物件
    document.querySelectorAll(card).forEach(function(event){
        event.draggable="true"
    })
    
    document.querySelectorAll(sortdiv).forEach(function(event){
        event.ondragstart=function(addeventlistenerevent){
            addeventlistenerevent.target.classList.add("dragging")
        }
    
        event.ondragover=function(addeventlistenerevent){
            addeventlistenerevent.preventDefault()
            const sortableContainer=addeventlistenerevent.target.closest(".sort")
            if(sortableContainer){
                let draggableElements=Array.from(sortableContainer.children).filter(function(child){
                    return child.classList.contains("card")&&!child.classList.contains("dragging")
                })
    
                let afterElement=draggableElements.reduce(function(closest,child){
                    const box=child.getBoundingClientRect()
                    const offset=addeventlistenerevent.clientY-box.top-box.height/2
                    if(offset<0&&offset>closest.offset){
                        return { offset:offset,element:child }
                    }else{
                        return closest
                    }
                },{ offset:Number.NEGATIVE_INFINITY }).element
    
                let draggable=document.querySelector(".dragging")
                if(afterElement==null){
                    sortableContainer.appendChild(draggable)
                }else{
                    sortableContainer.insertBefore(draggable,afterElement)
                }
            }
        }
    
        event.ondragend=function(addeventlistenerevent){
            addeventlistenerevent.target.classList.remove("dragging")
        }
    })
}

sort(".card",".sort")