// JavaScript code for the image cropper
// const cropper = document.querySelector('.cropper');
// const image = cropper.querySelector('img');
// const fileInput = document.querySelector('input[type="file"]');
// const cropButton = document.querySelector('.crop-button');
// const downloadButton = document.querySelector('.download-button');
// const canvas = document.createElement('canvas');
// const ctx = canvas.getContext('2d');
// let isDragging = false;
// let startX, startY, currentX, currentY;
// let rect = { x: 0, y: 0, width: 0, height: 0 };

// // Handle file input change
// fileInput.addEventListener('change', (event) => {
//     const file = event.target.files[0];
//     const reader = new FileReader();
//     reader.onload = (event) => {
//         image.src = event.target.result;
//     };
//     reader.readAsDataURL(file);
// });

// // Handle dotted rectangle drag start
// cropper.addEventListener('mousedown', (event) => {
//     isDragging = true;
//     startX = event.clientX;
//     startY = event.clientY;
// });

// // Handle dotted rectangle drag
// cropper.addEventListener('mousemove', (event) => {
//     if (isDragging) {
//         currentX = event.clientX;
//         currentY = event.clientY;
//         rect.x = Math.min(startX, currentX);
//         rect.y = Math.min(startY, currentY);
//         rect.width = Math.abs(startX - currentX);
//         rect.height = Math.abs(startY - currentY);
//         drawDottedRectangle();
//     }
// });

// // Handle dotted rectangle drag end
// cropper.addEventListener('mouseup', (event) => {
//     isDragging = false;
// });

// // Handle crop button click
// cropButton.addEventListener('click', (event) => {
//     cropImage();
// });

// // Handle download button click
// downloadButton.addEventListener('click', (event) => {
//     downloadCroppedImage();
// });

// // Draw the dotted rectangle on the canvas
// function drawDottedRectangle() {
//     canvas.width = cropper.offsetWidth;
//     canvas.height = cropper.offsetHeight;
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     ctx.setLineDash([5, 5]);
//     ctx.strokeRect(rect.x, rect.y, rect.width, rect.height);
//     cropper.querySelector('.dotted-rectangle').innerHTML = '';
//     cropper.querySelector('.dotted-rectangle').appendChild(canvas);
// }

// // Crop the image using the selected rectangle
// function cropImage() {
// }

// // Download the cropped image
// 顯示上傳的圖像
function previewImage() {
    let input = document.getElementById('image-input');
    let imageContainer = document.getElementById('image-container');

    let image = new Image();
    image.src = URL.createObjectURL(input.files[0]);
    imageContainer.appendChild(image);
    
    // 初始化虛線矩形
    initRectangle();
}

// 繪製虛線矩形
function initRectangle() {
    let canvas = document.getElementById('image-canvas');
    let context = canvas.getContext('2d');
    
    // 寬高設為圖像區域的寬高
    canvas.width = imageContainer.clientWidth;
    canvas.height = imageContainer.clientHeight;

    context.setLineDash([5, 5]);
    context.strokeRect(0, 0, canvas.width, canvas.height);
}

// 點擊crop按鈕時執行裁剪
function cropImage() {
    const croppedImage = document.createElement('canvas');
    const croppedImageCtx = croppedImage.getContext('2d');
    croppedImage.width = rect.width;
    croppedImage.height = rect.height;
    croppedImageCtx.drawImage(image, rect.x, rect.y, rect.width, rect.height, 0, 0, rect.width, rect.height);
    image.src = croppedImage.toDataURL();
    cropButton.style.display = 'none';
    downloadButton.style.display = 'inline-block';
    downloadButton.removeAttribute('disabled');
  // 使用Canvas API來對圖像進行裁剪
  // 例如: context.drawImage(image, x, y, width, height, dx, dy, dWidth, dHeight);
  // 將裁剪後的圖像保存到伺服器上
  // 將按鈕文字更改為"Download"
}

function downloadCroppedImage() {
    const link = document.createElement('a');
    link.download = `crop_${fileInput.files[0].name}`;
    link.href = image.src;
    link.click();
}