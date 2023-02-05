let but=document.getElementsByClassName("close")
let div=document.getElementById("div")
let addsut=document.getElementById("addsut")
let form=document.getElementById("addsutsubmit")

div.style.display="none"

addsut.onclick=function(){
    div.style.display="inline"
}

but.onclick=function(){
    div.style.display="none"
}

let signupdb=indexedDB.open("user",1)
signupdb.onupgradeneeded=function(){
    let db=signupdb.result
    let store=db.createObjectStore("name",{keyPath:"id"})
    store.createIndex("name",{unique:true})
}

form.onsubmit=function(event){
    event.preventDefault()
    let username=document.getElementById("stuname").value
    let user={id:Date.now(),name:username}
    let openDB=indexedDB.open("user",1)
    openDB.onsuccess=function(){
        let db=openDB.result
        let tx=db.transaction("name","readwrite")
        let store=tx.objectStore("name")
        let index=store.index("name")
        let checkRequest=index.get(username)
        checkRequest.onsuccess=function(){
            if(checkRequest.result){
                alert("用戶已存在")
            }else{
                store.put(user)
                alert("新增成功")
            }
        }
    }
}

let readDB=indexedDB.open("user",1)
readDB.onsuccess=function(){
    let db=readDB.result
    let tx=db.transaction("name","readonly")
    let store=tx.objectStore("name")
    let cursor=store.openCursor()
    cursor.onsuccess=function(){
        let result=cursor.result
        if(result){
            console.log(result.value)
            result.continue()
        }
    }
}

//Add student button function
document.querySelector("#addStudent").addEventListener("click", function(){
    //code for adding a student
});

//Add class button function
document.querySelector("#addClass").addEventListener("click", function(){
    //code for adding a class
    //display new class dialog
    var dialog = document.querySelector("#dialog");
    dialog.style.display = "block";
});

//Close button function for new class dialog
document.querySelector("#dialog .close").addEventListener("click", function(){
    //code for closing new class dialog
    var dialog = document.querySelector("#dialog");
    dialog.style.display = "none";
});

//Submit button function for new class dialog
document.querySelector("#dialog .submit").addEventListener("click", function(){
    //code for submitting new class
    //validate class name input
    var className = document.querySelector("#dialog input[name='name']").value;
    if(className === ""){
        //display error message
    } else {
        //create new class in system
        //update class list in sidebar
        //close dialog
        var dialog = document.querySelector("#dialog");
        dialog.style.display = "none";
    }
});

//Filter students by class function
document.querySelector("#classList").addEventListener("click", function(event){
    //code for filtering students by class
    if(event.target.matches("li.item")){
        //filter students by class and update main content
    }
});

//Edit student function
document.querySelector("#main .students").addEventListener("click", function(event){
  if(event.target.matches(".edit")){
    //code for editing student
  }
});

//Delete student function
document.querySelector("#main .students").addEventListener("click", function(event){
  if(event.target.matches(".delete")){
    //code for deleting student
    //move student to trash
  }
});

//Sort students by name, student id, or email function
document.querySelector("#main .sort").addEventListener("change", function(){
  //code for sorting students
});

window.onbeforeunload=null