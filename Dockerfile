# Sử dụng image Deno chính thức
FROM denoland/deno:alpine

# Tạo thư mục làm việc trong container
WORKDIR /app

# Sao chép mã nguồn vào container
COPY . /app

# Cài đặt các quyền truy cập cần thiết
RUN deno cache index.ts

# Chạy ứng dụng Deno
CMD ["deno", "run", "--allow-net", "index.ts"]
