import sys
import json

# 从标准输入读取数据
data = sys.stdin.read()

# 将JSON字符串转换为Python字典
input_data = json.loads(data)

# 在这里处理从JavaScript发送过来的请求，并执行您的Python代码
# 例如：假设JavaScript发送了一个包含"name"字段的请求，返回一个包含"message"字段的字典
response = {"message": f"Hello, {input_data['name']}!"}

# 将Python字典转换为JSON字符串并输出到标准输出
print(json.dumps(response))