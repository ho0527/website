let facingcount=0

sort("user",".sort")

docgetid("newfacing").onclick=function(){
    let div=doccreate("div")
    div.classList.add("facingdiv")
    div.innerHTML=`
        <div class="facing grid">
            <input type="text" class="input2 facingname" placeholder="面向名稱">
            <input type="text" class="input2 facingdesciption" placeholder="面向說明">
            <input type="button" class="noborderbutton facingdelect" value="X">
        </div>
    `
    docgetid("productfacing").appendChild(div)
    facingcount=facingcount+1
}