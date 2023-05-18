setTimeout(function(){
    let image=document.querySelectorAll("img")
    let count
    for(let i=0;i<image.length;i=i+1){
        console.log(image[i])
        image[i].onclick=function(){
            count=i
            console.log("hi22")
            document.querySelectorAll("body")[0].innerHTML=document.querySelectorAll("body")[0].innerHTML+`
                <div class="div">
                    <div class="mask" id="mask"></div>
                    <div class="body">
                        <div id="X" style="position: absolute;right: -10px;top: -10px;cursor: pointer;">X</div>
                        <img src="${this.src}" id="wtfpluginmainimage" style="width: 100px">
                        <input type="button" class="submit left" id="left" value="<">
                        <input type="button" class="submit right" id="right" value=">">
                    </div>
                </div>
            `
            document.getElementById("left").onclick=function(){
                count=count-1
                if(count==0){ document.getElementById("left").disabled=true }
                document.getElementById("wtfpluginmainimage").src=document.querySelectorAll("img")[count].src
            }
            document.getElementById("right").onclick=function(){
                count=count+1
                if(count==image.length-1){ document.getElementById("right`").disabled=true }
                document.getElementById("wtfpluginmainimage").src=document.querySelectorAll("img")[count].src
            }
            document.getElementById("X").onclick=function(){
                location.reload()
            }
            document.getElementById("mask").onclick=function(){
                location.reload()
            }
        }
    }
},100)