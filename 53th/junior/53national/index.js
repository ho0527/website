let ajax=new XMLHttpRequest()

ajax.onreadystatechange=function(){
    if(ajax.readyState==4){
        if(ajax.status==200){
            let data=JSON.parse(ajax.responseText)
            let maindiv=document.getElementById("maindiv")
            console.log(data)
            for(let i=0;i<data[1].length;i=i+1){
                console.log(data[1][i])
                let div=document.createElement("div")
                div.id=i
                div.classList.add("div")
                if(i==0){
                }else if(i==data[1].length-1){

                }else{

                }
                maindiv.appendChild(div)
                document.getElementById(i).innerHTML=`
                    <div class="circle">
                        <div class="outcircle">
                            <div class="incircle"></div>
                        </div>
                    </div>
                `
            }
            for(let i=0;i<data[0].length;i=i+1){
                console.log(data[0][i])
            }
        }else{
            console.log("[ERROR] ajax error")
        }
    }
}

ajax.open("GET","apiindex.php",true)
ajax.send()