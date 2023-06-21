sort("list",".newproduct")
let data="key=submit&"
let left=3
let right=3

document.getElementById("submit").onclick=function(){
    document.querySelectorAll(".list").forEach(function(event){
        if(event.parentNode.classList[0]=="newproductleft"){
            console.log(event)
            if(event.id=="name"){
                data=data+"name=grid-column: 1/50;grid-row: "+left+"/"+(left+2)+"&"
                left=left+3
            }else if(event.id=="cost"){
                data=data+"cost=grid-column: 1/50;grid-row: "+left+"/"+(left+2)+"&"
                left=left+3
            }else if(event.id=="date"){
                data=data+"date=grid-column: 1/50;grid-row: "+left+"/"+(left+2)+"&"
                left=left+3
            }else if(event.id=="link"){
                data=data+"link=grid-column: 1/50;grid-row: "+left+"/"+(left+2)+"&"
                left=left+3
            }else if(event.id=="introduction"){
                data=data+"introduction=grid-column: 1/50;grid-row: "+left+"/"+(left+6)+"&"
                left=left+7
            }else if(event.id=="picture"){
                data=data+"picture=grid-column: 1/50;grid-row: "+left+"/"+(left+12)+"&"
                left=left+12
            }
        }else{
            if(event.id=="name"){
                data=data+"name=grid-column: 50/100;grid-row: "+right+"/"+(right+2)+"&"
                right=right+3
            }else if(event.id=="cost"){
                data=data+"cost=grid-column: 50/100;grid-row: "+right+"/"+(right+2)+"&"
                right=right+3
            }else if(event.id=="date"){
                data=data+"date=grid-column: 50/100;grid-row: "+right+"/"+(right+2)+"&"
                right=right+3
            }else if(event.id=="link"){
                data=data+"link=grid-column: 50/100;grid-row: "+right+"/"+(right+2)+"&"
                right=right+3
            }else if(event.id=="introduction"){
                data=data+"introduction=grid-column: 50/100;grid-row: "+right+"/"+(right+6)+"&"
                right=right+7
            }else if(event.id=="picture"){
                data=data+"picture=grid-column: 50/100;grid-row: "+right+"/"+(right+12)+"&"
                right=right+12
            }
        }
    })
    location.href="newproduct.php?"+data
}