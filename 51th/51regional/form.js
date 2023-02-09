let none=document.querySelectorAll(".none")
let yesno=document.querySelectorAll(".yesno")
let single=document.querySelectorAll(".single")
let multi=document.querySelectorAll(".multi")
let question=document.querySelectorAll(".question")
let output=document.querySelectorAll("#output")
let all=[none,yesno,single,multi,question]

all.forEach(function(event){
    event.forEach(function(event){
        event.onclick=function onchange(){
            let id=this.id
            let data=id.split(" ")
            console.log("data="+data)
            if(data[0]=="yesno"){
                console.log("aduihnoi")
                output[0].innerHTML=`
                    <div class="yesnodiv">
                        <div class="center">
                            必填<input type="checkbox" name="required"><br>
                            題目說明:<input type="text" class="directions"><br>
                            是<input type="radio" name="yesno" value="yes">
                            否<input type="radio" name="yesno" value="no">
                        </div>
                    </div>
                `
            }else if(data[0]=="single"){
                output[0].innerHTML=`
                    <div class="singlediv">
                        <div class="center">
                            必填<input type="checkbox" name="required"><br>
                            題目說明:<input type="text" class="directions"><br>
                            1.<input type="text" name="single1" value="">
                            2.<input type="text" name="single2" value="">
                            3.<input type="radio" name="single3" value="">
                        </div>
                    </div>
                `
            }else if(data[0]=="multi"){

            }else if(data[0]=="question"){

            }else{
                output[0].innerHTML=``
            }
        }
    })
})