document.getElementById("file").addEventListener("change",function(event){
    const colorlist=document.getElementById("color")
    let sorted=[]
    sorted.splice(0,sorted.length)
    const reader=new FileReader()
    let image=document.getElementById("image")
    reader.onload=function(){
        image.src=reader.result
        const img=document.createElement("img")
        img.src=reader.result
        img.onload=function(){
            const canvas=document.createElement("canvas")
            canvas.width=img.width
            canvas.height=img.height
            const ctx=canvas.getContext("2d")
            ctx.drawImage(img,0,0)
            const colors={}
            for(let i=0;i<canvas.width;i=i+5){
                for(let j=0;j<canvas.height;j=j+5){
                    const pixel=ctx.getImageData(i,j,1,1).data
                    colors[`rgb(${pixel[0]},${pixel[1]},${pixel[2]})`]=(colors[`rgb(${pixel[0]},${pixel[1]},${pixel[2]})`]||0)+1
                }
            }
            sorted=Object.entries(colors).sort((a,b)=>b[1]-a[1])
            colorlist.innerHTML=""
            sorted.slice(0,3).forEach(function(sort){
                const color=sort[0]
                const p=document.createElement("p")
                p.textContent=color
                p.classList.add("colorname")
                const div=document.createElement("div")
                div.classList.add("colorbox")
                div.style.background=color
                div.appendChild(p)
                colorlist.appendChild(div)
            })
        }
    }
    reader.readAsDataURL(event.target.files[0])
})

document.getElementById("reflashbutton").onclick=function(){
    location.reload()
}