document.getElementById("file").addEventListener("change",function(event){
    let colorlist=document.getElementById("color")
    let sorted=[]
    sorted.splice(0,sorted.length)
    let reader=new FileReader()
    let image=document.getElementById("image")
    reader.onload=function(){
        image.src=reader.result
        let img=document.createElement("img")
        img.src=reader.result
        img.onload=function(){
            let canvas=document.createElement("canvas")
            canvas.width=img.width
            canvas.height=img.height
            let ctx=canvas.getContext("2d")
            ctx.drawImage(img,0,0)
            let colors=[]
            for(let i=0;i<canvas.width;i=i+5){
                for(let j=0;j<canvas.height;j=j+5){
                    let pixel=ctx.getImageData(i,j,1,1).data
                    let rgb="rgb("+pixel[0]+","+pixel[1]+","+pixel[2]+")"
                    colors.push([rgb,(colors[rgb]||0)+1])
                    //colors[rgb]=(colors[rgb]||0)+1
                }
            }
            console.log(colors)
            colors[1]
            console.log(colors[0])
            sorted=Object.entries(colors).sort((a,b)=>b[1]-a[1])
            colorlist.innerHTML=""
            sorted.slice(0,3).forEach(function(sort){
                let color=sort[0]
                let p=document.createElement("p")
                p.textContent=color
                p.classList.add("colorname")
                let div=document.createElement("div")
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