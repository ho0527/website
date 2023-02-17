let adsimage=document.querySelectorAll(".adsimage")
let adsbutton=document.querySelectorAll(".adsbutton")
let lightbox=document.getElementById("lightbox")

adsbutton.forEach(function(adsbut){
    adsbut.onclick=function(){
        let td = this.parentNode;
        let img = td.querySelector('.adsimage');
        lightbox.innerHTML=`
            <div class="lightbox">
                <div class="mask"></div>
                <div class="body">
                    <div class="title"></div>
                    <img src="${img}" alt="" class="adsimage">
                    <input type="button" class="close" id="close" value="完成">
                </div>
            </div>
        `
        document.getElementById("close").onclick=function(){
            location.reload()
        }
    }
})
console.log(adsimage)
console.log(adsbutton)