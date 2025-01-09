# Sử dụng image Ubuntu mới nhất làm base image
FROM ubuntu:latest

# Cập nhật và cài đặt các gói cần thiết
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y \
    curl \
    vim \
    git \
    sudo \
    lsb-release \
    ca-certificates

# Thiết lập user và môi trường
RUN useradd -ms /bin/bash myuser
USER myuser
WORKDIR /home/myuser

# Thiết lập các thông số môi trường (nếu cần)
ENV DEBIAN_FRONTEND=noninteractive

# Mở cổng nếu cần thiết (nếu có ứng dụng chạy trong container)
# EXPOSE 8080

# Command mặc định khi container chạy
CMD [ "bash" ]
