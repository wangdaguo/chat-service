##开发必备
- 添加protobuf类包,不需要php安装protobuf.so扩展
- 安装protoc编译器

##目录结构
- App //业务开发代码
- Protobuf/Proto  //proto文件
- Protobuf/Garuda  //proto文件产生的php文件
- GPBMetadata  //proto文件产生的php文件
- Workman //workman库文件

##开发流程
- protobuf/proto目录添加proto文件
- 修改proto文件的packet为Protobuf.Garuda
- protoc --php_out="/从根目录开始的绝对路径/chat-service/" *.proto
- 查看/Protobuf/Garuda 和 /GPBMetadata目录是否有对应php文件
# chat-service
