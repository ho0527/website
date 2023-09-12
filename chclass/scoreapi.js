let ajax2=newajax("GET","api.php?scorelist=")

ajax2.onload=function(){
    let data=JSON.parse(ajax2.responseText)

    let titlelist=data[1]

    for(let i=1;i<=35;i=i+1){
        let id=i

        if(id<10){ id="0"+id }

        let tr=doccreate("tr")

        tr.classList.add("tr")
        tr.id="tr"+i
        tr.innerHTML=`
            <td class="td">1146${id}</td>
        `

        docappendchild("maintable",tr)
    }

    for(let i=0;i<titlelist.length;i=i+1){
        let title=titlelist[i]

        let td=doccreate("td")

        td.classList.add("td")
        td.innerHTML=`
            ${title}
        `

        docappendchild("tablehead",td)

        for(let j=1;j<=35;j=j+1){
            let id=j
            let color=""

            if(data[0][title][j][0]=="-1"){
                color="gray"
            }else if(data[0][title][j][0]<60){
                color="red"
            }

            if(id<10){ id="0"+id }

            let td=doccreate("td")

            td.classList.add("td")
            td.classList.add("score"+j)
            td.innerHTML=`
                <div style="color: ${color}">${data[0][title][j][0]}</div>
            `

            docappendchild("tr"+j,td)
        }
    }

    let td=doccreate("td")

    td.classList.add("td")
    td.innerHTML=`平均`

    docappendchild("tablehead",td)

    let td2=doccreate("td")

    td2.classList.add("td")
    td2.innerHTML=`功能`

    docappendchild("tablehead",td2)

    for(let i=1;i<=35;i=i+1){
        let total=0
        let testcount=0
        let color=""

        docgetall(".score"+i+">div").forEach(function(event){
            if(parseInt(event.innerHTML)!=-1){
                total=total+parseInt(event.innerHTML)
                testcount=testcount+1
            }
        })

        if(testcount==0){
            total="N/A"
        }else{
            total=total/testcount.toFixed(2)
        }

        if(total=="N/A"){
            color="gray"
        }else if(total<60){
            color="red"
        }

        let td=doccreate("td")

        td.classList.add("td")
        td.innerHTML=`
            <div style="color: ${color}">${total}</div>
        `

        docappendchild("tr"+i,td)
        let td2=doccreate("td")

        td2.classList.add("td")
        td2.innerHTML=`
            <input type="button" class="bluebutton" onclick="location.href='editscore.html?scoreid=${i}'" value="修改">
        `

        docappendchild("tr"+i,td2)
    }
}