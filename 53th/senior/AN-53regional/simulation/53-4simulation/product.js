let val="1"

document.querySelectorAll(".ctable").forEach(function(e){
    e.style.backgroundColor=""
    console.log("in")
    e.addEventListener("click",function(){
        console.log("inin")
        document.querySelectorAll(".ctable").forEach(function(e){
            e.style.backgroundColor=""
        })
        e.style.backgroundColor="rgb(255, 255, 153)"
        val=e.id
    })
})

function check(href){
    location.href=href+"?val="+val
}

function sub(){
    document.getElementById("form").submit.click()
}

function newproduct(){
    document.getElementById("newproduct").innerHTML=`
    <tr>
        <td>
            <table class="ctable" id="3">
                <tr>
                    <td class="ctd">商品名稱</td>
                    <td class="ctd">相關連結</td>
                </tr>
                <tr>
                    <td class="ctd">商品簡介</td>
                    <td class="ctd" rowspan="3">圖片</td>
                </tr>
                <tr>
                    <td class="ctd">發佈日期</td>
                </tr>
                <tr>
                    <td class="ctd">費用</td>
                </tr>
            </table>
        </td>
    </tr>
    `
}