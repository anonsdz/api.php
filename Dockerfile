# Sử dụng Node.js image
FROM node:16

# Thiết lập thư mục làm việc trong container
WORKDIR /app

# Sao chép file package.json vào container
COPY package.json /app/

# Cài đặt các dependencies từ package.json
RUN npm install

# Sao chép toàn bộ mã nguồn vào container
COPY . /app/

# Chạy ứng dụng (nếu có)
CMD ["npm", "start"]
