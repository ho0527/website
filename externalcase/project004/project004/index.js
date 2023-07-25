// JavaScript代码
const postData = { name: 'John' }; // 可以传递需要的数据给Python

fetch('test.py', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify(postData),
})
.then(response => response.json())
.then(data => {
  // 在这里处理从Python返回的数据
  console.log(data.message);
})
.catch(error => {
  console.error('Error:', error);
});
