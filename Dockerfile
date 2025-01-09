# Sử dụng image Node.js chính thức làm base image
FROM node:latest

# Tạo thư mục làm việc trong container
WORKDIR /app

# Copy file package.json vào trong container
COPY package.json /app/

# Cài đặt các dependencies từ package.json
RUN npm install

# Copy tất cả mã nguồn còn lại vào trong container
COPY . /app/

# Mở cổng nếu cần thiết (ví dụ ứng dụng web chạy trên cổng 3000)
EXPOSE 3000

# Lệnh mặc định chạy khi container khởi động
CMD ["npm", "start"]
