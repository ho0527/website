let none=document.querySelectorAll(".none")
let yesno=document.querySelectorAll(".yesno")
let single=document.querySelectorAll(".single")
let multi=document.querySelectorAll(".multi")
let qa=document.querySelectorAll(".qa")
let all=[none,yesno,single,multi,qa]

all.forEach(function(event){
    event.forEach(function(event){
        event.onclick=function onchange(){
            let id=this.id
            let data=id.split(" ")
            output=document.getElementById("output"+data[1])
            if(data[0]=="yesno"){
                output.innerHTML=`
                    <div class="yesnodiv">
                        <div class="formcenter">
                            必填<input type="checkbox" name="required${data[1]}"><br>
                            題目說明:<input type="text" class="directions" name="direction${data[1]}"><br>
                            是<input type="radio" name="yesno" value="yes">
                            否<input type="radio" name="yesno" value="no">
                        </div>
                    </div>
                `
            }else if(data[0]=="single"){
                output.innerHTML=`
                    <div class="singlediv">
                        <div class="formcenter">
                            必填<input type="checkbox" name="required${data[1]}"><br>
                            題目說明:<input type="text" class="directions"><br>
                            1.<input type="text" name="single1" class="forminputtext" value="">
                            2.<input type="text" name="single2" class="forminputtext" value="">
                            3.<input type="text" name="single3" class="forminputtext" value="">
                            4.<input type="text" name="single4" class="forminputtext" value="">
                            5.<input type="text" name="single5" class="forminputtext" value="">
                            6.<input type="text" name="single6" class="forminputtext" value="">
                        </div>
                    </div>
                `
            }else if(data[0]=="multi"){
                output.innerHTML=`
                    <div class="multidiv">
                        <div class="formcenter">
                            必填<input type="checkbox" name="required${data[1]}"><br>
                            題目說明:<input type="text" class="directions"><br>
                            1.<input type="text" name="multi1" class="forminputtext" value="">
                            2.<input type="text" name="multi2" class="forminputtext" value="">
                            3.<input type="text" name="multi3" class="forminputtext" value="">
                            4.<input type="text" name="multi4" class="forminputtext" value="">
                            5.<input type="text" name="multi5" class="forminputtext" value="">
                            6.<input type="text" name="multi6" class="forminputtext" value=""><br>
                            其他:<input type="text" name="multiauther" class="forminputlongtext" value="">
                        </div>
                    </div>
                `
            }else if(data[0]=="qa"){
                output.innerHTML=`
                    <div class="questiondiv">
                        <div class="formcenter">
                            <br>
                            必填<input type="checkbox" name="required${data[1]}"><br>
                            題目說明:<input type="text" class="directions"><br><br>
                            <textarea cols="30" rows="5" placeholder="問答題"></textarea>
                        </div>
                    </div>
                `
            }else{
                output.innerHTML=``
            }
        }
    })
})