let editstu=document.querySelectorAll(".edit")
let dialog=document.getElementById("dialog")
let addsut=document.getElementById("addStudent")
let newstudent=document.getElementById("newStudent")
// let lastname=document.getElementById("last_name")
// let firstname=document.getElementById("first_name")
// let email=document.getElementById("email")
let lessmoreclass=document.getElementById("allclass")
let allclass=document.getElementById("class")
let newclass=document.getElementById("addClass")
let allstu=document.getElementById("allstu")
let delstu=document.getElementById("delete")
let main=document.getElementById("main")
let trashcan=document.getElementById("trashcan")
// let trashcan=document.getElementById("trashcan")

// function allclassdef(){
//     let text=`
//         <div id="class">
//             <span class="num"></span>
//         </div>
//     `
//     return text
// }

let db=indexedDB.open("students",1)
//creat a indexedDB
db.onupgradeneeded=function(event){
    let db=event.target.result
    let objectStore=db.createObjectStore("students",{keyPath:"student_id"})
}

db.onsuccess=function(event){
    let db=event.target.result
    let objectStore=db.transaction("students").objectStore("students")
    let request=objectStore.getAll()
    // request.onsuccess=function(event){
    //     let students=event.target.result
    //     for(let i=0;i<students.length;i++){
    //         dialog.innerHTML+=`
    //             <div class="student">
    //                 <img class="avatar" src="">
    //                 <div class="info">
    //                     <span class="fullname"></span>
    //                     <span class="student_id"></span>
    //                     <span class="email"></span>
    //                     <span class="phone"></span>
    //                     <span class="class"></span>
    //                     <span class="address"></span>
    //                 </div>
    //                 <div class="actions">
    //                     <button class="edit">編輯</button>
    //                     <button class="delete">刪除</button>
    //                 </div>
    //         `
    //     }
    // }
}

function claerselect(){
    allstu.classList.remove("current")
    trashcan.classList.remove("current")
}

function reload(){
    claerselect()
    dialog.innerHTML=``
    location.reload()
}

window.onload=function(){
    dialog.innerHTML=``
    // allclass.innerHTML=`${allclassdef()}`
    main.innerHTML=`
        <div class="students">
            <div class="student">
                <img class="avatar" src="">
                <div class="info">
                    <span class="fullname"></span>
                    <span class="student_id"></span>
                    <span class="email"></span>
                    <span class="phone"></span>
                    <span class="class"></span>
                    <span class="address"></span>
                </div>
                <div class="actions">
                    <button class="edit">編輯</button>
                    <button class="delete" id="delete">刪除</button>
                </div>
            </div>
            <div class="message">目前還沒有任何學生</div>
        </div>
    `
    allstu.classList.add("current")
}

allstu.addEventListener("click",function(){
    location.reload()
})

lessmoreclass.addEventListener("click",function(){
    if(lessmoreclass.innerHTML=="班級(顯示更多)"){
        // allclass.innerHTML=`${allclass()}`
        lessmoreclass.innerHTML=`班級(顯示更少)`
    }else{
        // allclass.innerHTML=``
        lessmoreclass.innerHTML=`班級(顯示更多)`
    }
})

addsut.onclick=function(){
    dialog.innerHTML=`
        <div class="div">
            <div class="mask"></div>
            <div class="body">
                <h2 class="title">建立學生</h2><hr>
                <form class="newStudent" id="newStudent" method="post">
                    <div class="left">
                        <div class="avater">
                            <img src="default.jpeg" class="avater_preview"></img>
                            <input type="file" class="avatar" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>
                    <div class="right">
                        <input type="text" name="last_name" id="last_name" class="name" placeholder="姓氏">
                        <input type="text" name="first_name" id="first_name" class="name" placeholder="名字"><br>
                        <input type="email" name="email[]" class="input" placeholder="email"><br>
                        <input type="tel" name="phone[]" class="input" placeholder="手機"><br>
                        <input type="text" name="address" class="input" placeholder="住址"><br>
                        <select name="class" id="class"></select><br>
                        <textarea name="note" id="" cols="20" rows="1" class="note"></textarea><br>
                        <div class="button">
                            <button type="button" id="close" class="close">取消</button>
                            <button id="submit" name="enter" class="submit">確定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `
    addsut.classList.add("current")
    let close=document.getElementById("close")
    close.onclick=function(){
        reload()
    }
    addsut.onsubmit=function(event){
        let studentid=document.getElementById("student_id").value
        let lastname=document.getElementById("last_name").value
        let firstname=document.getElementById("first_name").value
        let email=document.getElementById("email").value
        let phone=document.getElementById("phone").value
        let class_id=document.getElementById("class").value
        let address=document.getElementById("address").value
        let student={studentid,lastname,firstname,email,phone,class_id,address}
        if(lastname.value==""||firstname.value==""){
            alert("請輸入姓名!")
        }else{
            alert("註冊成功")
        }
        let request=objectStore.add(student)
        // event.preventDefault()
        // let username=document.getElementById("stuname").value
        // let user={id:Date.now(),name:username}
        // let openDB=indexedDB.open("user",1)
        // openDB.onsuccess=function(){
        //     let db=openDB.result
        //     let tx=db.transaction("name","readwrite")
        //     let store=tx.objectStore("name")
        //     let index=store.index("name")
        //     let checkRequest=index.get(username)
        //     checkRequest.onsuccess=function(){
        //         if(checkRequest.result){
        //             alert("用戶已存在")
        //         }else{
        //             store.put(user)
        //             alert("新增成功")
        //         }
        //     }
        // }
    }
}

editstu.onclick=function(){
    dialog.innerHTML=`
        <div class="div">
            <div class="mask"></div>
            <div class="body">
                <h2 class="title">編輯學生</h2><hr>
                <form class="newStudent" id="newStudent" method="post">
                    <div class="left">
                        <div class="avater">
                            <img src="default.jpeg" class="avater_preview"></img>
                            <input type="file" class="avatar">
                        </div>
                    </div>
                    <div class="right">
                        <input type="text" name="last_name" id="last_name" class="name" placeholder="姓氏">
                        <input type="text" name="first_name" id="first_name" class="name" placeholder="名字"><br>
                        <input type="email" name="email[]" class="input" placeholder="email"><br>
                        <input type="tel" name="phone[]" class="input" placeholder="手機"><br>
                        <input type="text" name="address" class="input" placeholder="住址"><br>
                        <select name="class" id="class"></select><br>
                        <textarea name="note" id="" cols="20" rows="1" class="note"></textarea><br>
                        <div class="button">
                            <button type="button" id="close" class="close">取消</button>
                            <button id="submit" name="enter" class="submit">確定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `
    addsut.classList.add("current")
    let close=document.getElementById("close")
    close.onclick=function(){
        reload()
    }
    newstudent.onsubmit=function(event){
        let studentid=document.getElementById("student_id").value
        let lastname=document.getElementById("last_name").value
        let firstname=document.getElementById("first_name").value
        let email=document.getElementById("email").value
        let phone=document.getElementById("phone").value
        let class_id=document.getElementById("class").value
        let address=document.getElementById("address").value
        let student={studentid,lastname,firstname,email,phone,class_id,address}
        if(lastname.value==""||firstname.value==""){
            alert("請輸入姓名!")
        }else{
            let request=objectStore.put(student)
            alert("註冊成功")
        }
        // event.preventDefault()
        // let username=document.getElementById("stuname").value
        // let user={id:Date.now(),name:username}
        // let openDB=indexedDB.open("user",1)
        // openDB.onsuccess=function(){
        //     let db=openDB.result
        //     let tx=db.transaction("name","readwrite")
        //     let store=tx.objectStore("name")
        //     let index=store.index("name")
        //     let checkRequest=index.get(username)
        //     checkRequest.onsuccess=function(){
        //         if(checkRequest.result){
        //             alert("用戶已存在")
        //         }else{
        //             store.put(user)
        //             alert("新增成功")
        //         }
        //     }
        // }
    }
}


// delstu.onclick=function(){
//     let student_id=document.getElementById("student_id").value
//     let request=objectStore.delete(student_id)
// }

newclass.addEventListener("click",function(){
    dialog.innerHTML=`
        <div class="div">
            <div class="mask"></div>
            <div class="addclassbody">
                <h2 class="title">建立班級</h2><hr>
                <form class="newClass" method="post">
                    <input type="text" name="name" placeholder="班級名稱" id="classname" class="addclass"><br>
                    <div class="button">
                        <button type="button" id="close" class="close">取消</button>
                        <button id="submit" name="enter" class="submit">確定</button>
                    </div>
                </form>
            </div>
        </div>
    `
    let classname=document.getElementById("classname")
    newclass.classList.add("current")
    let close=document.getElementById("close")
    close.onclick=function(){
        reload()
    }
    // newstudent.onsubmit=function(event){
    //     if(classname.value==""){
    //         alert("請輸入班級!")
    //     }else{
    //         alert("註冊成功")
    //     }
    //     // event.preventDefault()
    //     // let username=document.getElementById("stuname").value
    //     // let user={id:Date.now(),name:username}
    //     // let openDB=indexedDB.open("user",1)
    //     // openDB.onsuccess=function(){
    //     //     let db=openDB.result
    //     //     let tx=db.transaction("name","readwrite")
    //     //     let store=tx.objectStore("name")
    //     //     let index=store.index("name")
    //     //     let checkRequest=index.get(username)
    //     //     checkRequest.onsuccess=function(){
    //     //         if(checkRequest.result){
    //     //             alert("用戶已存在")
    //     //         }else{
    //     //             store.put(user)
    //     //             alert("新增成功")
    //     //         }
    //     //     }
    //     // }
    // }
})

trashcan.addEventListener("click",function(){
    main.innerHTML=``
    claerselect()
    trashcan.classList.add("current")
    main.innerHTML=`

    `
})


// let signupdb=indexedDB.open("user",1)
// signupdb.onupgradeneeded=function(){
//     let db=signupdb.result
//     let store=db.createObjectStore("name",{keyPath:"id"})
//     store.createIndex("name",{unique:true})
// }


// let readDB=indexedDB.open("user",1)
// readDB.onsuccess=function(){
//     let db=readDB.result
//     let tx=db.transaction("name","readonly")
//     let store=tx.objectStore("name")
//     let cursor=store.openCursor()
//     cursor.onsuccess=function(){
//         let result=cursor.result
//         if(result){
//             console.log(result.value)
//             result.continue()
//         }
//     }
// }

// //Sort students function
// document.querySelector("#main .sort").addEventListener("change", function(){
//     //code for sorting students by selected option
//     //options: name, student_id, email
//     var sortBy = this.value;
//     //sort students and update main content
// });

// //Empty trash function
// document.querySelector("#trash .empty").addEventListener("click", function(){
//     //code for emptying trash
//     //confirm action
//     //delete all students in trash
// });

// //Restore student function
// document.querySelector("#trash .students").addEventListener("click", function(event){
//     if(event.target.matches(".restore")){
//         //code for restoring student from trash
//         //move student back to main student list
//     }
// });

// //Permanently delete student function
// document.querySelector("#trash .students").addEventListener("click", function(event){
//     if(event.target.matches(".delete")){
//         //code for permanently deleting student
//         //confirm action
//         //delete student from system
//     }
// });

// //Function for handling when there are no students in the system
// if(students.length === 0){
//     //display message: "No students to display."
// }

// //Function for limiting number of students displayed to 20
// if(students.length > 20){
//     //display only the first 20 students
// }

// //Function for displaying scrollbar when necessary
// if(students.length > 20){
//     //display scrollbar
// }

// //Function for displaying student's address when mouse is hovered over student list item
// document.querySelector("#main .students").addEventListener("mouseover", function(event){
//     if(event.target.matches(".student")){
//         //display student's address
//     }
// });

// //Function for hiding student's address when mouse is not hovered over student list item
// document.querySelector("#main .students").addEventListener("mouseout", function(event){
//     if(event.target.matches(".student")){
//         //hide student's address
//     }
// });

window.onbeforeunload=null