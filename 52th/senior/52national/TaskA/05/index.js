const uploadForm = document.getElementById('upload-form');
const uploadInput = document.getElementById('upload-input');
const uploadBtn = document.getElementById('upload-btn');
const imageContainer = document.getElementById('image-container');
const cropContainer = document.getElementById('crop-container');
const cropBtn = document.getElementById('crop-btn');
const downloadBtn = document.getElementById('download-btn');
let img, canvas, ctx, startX, startY, endX, endY;

// 監聽上傳按鈕，上傳圖像
uploadForm.addEventListener('submit', (event) => {
	event.preventDefault();
	const file = uploadInput.files[0];
	if (!file) {
		return;
	}
	const reader = new FileReader();
	reader.onload = (event) => {
		img = new Image();
		img.onload = () => {
			imageContainer.innerHTML = '';
			cropContainer.innerHTML = '';
			cropBtn.disabled = true;
			downloadBtn.disabled = true;
			imageContainer.appendChild(img);
			cropContainer.appendChild(canvas);
			canvas.width = img.width;
			canvas.height = img.height;
			ctx.drawImage(img, 0, 0);
			canvas.addEventListener('mousedown', handleMouseDown);
			canvas.addEventListener('mousemove', handleMouseMove);
			canvas.addEventListener('mouseup', handleMouseUp);
		}
		img.src = event.target.result;
	}
	reader.readAsDataURL(file);
});

// 監聽裁剪按鈕，裁剪圖像
cropBtn.addEventListener('click', () => {
	const croppedCanvas = document.createElement('canvas');
	croppedCanvas.width = endX - startX;
	croppedCanvas.height = endY - startY;
	const croppedCtx = croppedCanvas.getContext('2d');
	croppedCtx.drawImage(img, startX, startY, endX - startX, endY - startY, 0, 0, endX - startX, endY - startY);
	const filename = 'crop_' + uploadInput.files[0].name;
	const link = document.createElement('a');
	link.download = filename;
	link.href = croppedCanvas.toDataURL();
	link.click();
});

// 監聽裁剪區域的滑鼠事件
function handleMouseDown(event) {
startX = event.offsetX;
startY = event.offsetY;
canvas.addEventListener('mousemove', handleMouseMove);
}

function handleMouseMove(event) {
endX = event.offsetX;
endY = event.offsetY;
drawRect(startX, startY, endX, endY);
}

function handleMouseUp(event) {
endX = event.offsetX;
endY = event.offsetY;
drawRect(startX, startY, endX, endY);
canvas.removeEventListener('mousemove', handleMouseMove);
cropBtn.disabled = false;
}

// 畫選框
function drawRect(startX, startY, endX, endY) {
ctx.clearRect(0, 0, canvas.width, canvas.height);
ctx.drawImage(img, 0, 0);
ctx.strokeStyle = '#FF0000';
ctx.setLineDash([5]);
ctx.strokeRect(startX, startY, endX - startX, endY - startY);
}

// 監聽下載按鈕，下載圖像
downloadBtn.addEventListener('click', () => {
    const filename = 'crop_' + uploadInput.files[0].name;
    const link = document.createElement('a');
    link.download = filename;
    link.href = canvas.toDataURL();
    link.click();
});