let carousel=document.querySelector(".carousel")
let carouselInner=document.querySelector(".carousel-inner")
let carouselItems=document.querySelectorAll(".carousel-item")
let carouselControlPrev=document.querySelector(".carousel-control-prev")
let carouselControlNext=document.querySelector(".carousel-control-next")
let currentIndex=0

// 切換圖片的函式
function changeSlide() {
    // 將目前的圖片移到最左邊
    carouselItems[currentIndex].style.display="none"
    // 將下一張圖片移到中間
    currentIndex=(currentIndex+1)%carouselItems.length
    carouselItems[currentIndex].style.display="block"
}

// 當使用者點擊控制按鈕時切換圖片
carouselControlPrev.addEventListener("click",function(){
    // 停止自動輪播
    clearInterval(carouselInterval)
    // 將目前的圖片移到最左邊
    carouselItems[currentIndex].style.display="none"
    // 將上一張圖片移到中間
    currentIndex=(currentIndex-1+carouselItems.length)%carouselItems.length
    carouselItems[currentIndex].style.display="block"
    setInterval(changeSlide,5000)
})

carouselControlNext.addEventListener("click",function(){
    // 停止自動輪播
    clearInterval(carouselInterval)
    // 切換圖片
    changeSlide()
    setInterval(changeSlide,5000)
})

changeSlide()
let carouselInterval=setInterval(changeSlide,2000) // 自動輪播的間隔時間