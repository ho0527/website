document.querySelectorAll(".card").forEach(function(event){
    let isdrag=false
    let x
    let y
    let offsetx=0
    let offsety=0

    event.addEventListener("pointerdown",function(){
        isdrag=true
        x=event.clientX-offsetx
        y=event.clientY-offsety
        event.style.transform="rotate(15deg)"
    })

    event.addEventListener("pointermove",function(event){
        if(isdrag){
            event.preventDefault()
            offsetx=event.clientX-x
            offsety=event.clientY-y
            event.style.transform="translate("+offsetx+"px,"+offsety+"px)"
        }
    })

    document.addEventListener("pointerup",function(){
        if(isdrag){
            isdrag=false
            event.style.transform="rotate(0deg)"
        }
    })
})

// document.querySelectorAll("group-sortable").forEach(function(event){
//     event.ondragover=function(){
//         event.preventDefault()
//     }
// })

// document.querySelectorAll(".group-sortable").forEach(function(event){
//     event.addEventListener("dragstart",function(event){
//         event.target.classList.add("dragging")
//     })

//     event.addEventListener("dragover",function(addeventlistenerevent){
//         addeventlistenerevent.preventDefault()
//         const sortableContainer=addeventlistenerevent.target.closest(".group-sortable")
//         if(sortableContainer){
//             let draggableElements=Array.from(sortableContainer.children).filter(function(child){
//                 return child.classList.contains("card")&&!child.classList.contains("dragging")
//             })

//             let afterElement=draggableElements.reduce(function(closest,child){
//                 const box=child.getBoundingClientRect()
//                 const offset=addeventlistenerevent.clientY-box.top-box.height/2
//                 if(offset<0&&offset>closest.offset){
//                     return { offset:offset,element:child }
//                 }else{
//                     return closest
//                 }
//             },{ offset:Number.NEGATIVE_INFINITY }).element

//             let draggable=document.querySelector(".dragging")
//             if(afterElement==null){
//                 sortableContainer.appendChild(draggable)
//             }else{
//                 sortableContainer.insertBefore(draggable,afterElement)
//             }
//         }
//     })

//     event.addEventListener("dragend",function(event){
//         event.target.classList.remove("dragging")
//         isdrag=false
//         document.querySelectorAll(".card").forEach(function(event){
//             event.style.transform="rotate(0deg)"
//         })
//     })
// })

// document.addEventListener("DOMContentLoaded", function(){
//     document.querySelectorAll(".group-sortable").forEach(function(event){
//         event.setAttribute("ondragover", "event.preventDefault()")
//     })
// })





document.querySelectorAll(".group-sortable").forEach(function(container){
    container.addEventListener("pointerover", function(event){
        event.preventDefault()
    })

    container.addEventListener("pointermove", function(event){
        event.preventDefault()
        const sortableContainer=event.target.closest(".group-sortable")
        if (sortableContainer){
            let draggableElements=Array.from(sortableContainer.children).filter(function(child){
                return child.classList.contains("card")
            })

            let afterElement=draggableElements.reduce(function(closest, child){
                const box=child.getBoundingClientRect()
                const offset=event.clientY-box.top-box.height/2
                if (offset < 0 && offset > closest.offset){
                    return { offset: offset, element: child }
                } else {
                    return closest
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element

            let draggable=document.querySelector(".dragging")
            if (afterElement == null){
                sortableContainer.appendChild(draggable)
            } else {
                sortableContainer.insertBefore(draggable, afterElement)
            }
        }
    })
})
