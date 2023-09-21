# Đồ án môn học: Lập trình web và ứng dụng nâng cao (Web 2 Project)

## Mô tả dự án

Dự án này là một trang web quản lý việc kinh doanh các sản phẩm đồng hồ cho một cửa hàng. Trang web được phát triển để cung cấp các chức năng cơ bản cho việc quản lý và bán hàng trực tuyến, bao gồm:

- Đăng nhập và quản lý tài khoản người dùng.
- Hiển thị danh sách các sản phẩm đồng hồ có sẵn để mua.
- Thực hiện các thao tác mua bán sản phẩm.
- Quản lý đơn hàng và theo dõi tình trạng giao hàng.
- Quản lý sản phẩm, bao gồm thêm, sửa, xóa sản phẩm.
- Thống kê dữ liệu về doanh số bán hàng và tổng hợp các thông tin quản lý.

## Công nghệ sử dụng

Dự án được xây dựng bằng sử dụng các công nghệ và ngôn ngữ sau:

- **Front-end**: Sử dụng HTML, CSS, và JavaScript để xây dựng giao diện người dùng thân thiện và tương tác.
- **Back-end**: Sử dụng PHP để xây dựng logic ứng dụng và kết nối cơ sở dữ liệu.
- **Cơ sở dữ liệu**: Sử dụng cơ sở dữ liệu MySQL (ví dụ: MySQL, PostgreSQL) để lưu trữ thông tin về sản phẩm, người dùng và đơn hàng.

## Cài đặt và chạy dự án

1. **Clone Repository**: Sao chép (clone) dự án từ kho chứa (repository) GitHub về máy tính của bạn.
   git clone [https://github.com/yourusername/your-project.git](https://github.com/thieuhoang2002/WEB2-PROJECT-VUTRUDONGHO.git)
2. **Truy cập server MySQL với XAMPP**
   Cài đặt XAMPP (hoặc tương tự) trên máy tính của bạn nếu bạn chưa có.
   Khởi động XAMPP và đảm bảo rằng MySQL Server đang hoạt động.
3. **Tạo cơ sở dữ liệu**
   Mở trình duyệt web và truy cập vào http://localhost/phpmyadmin.
   Tạo một cơ sở dữ liệu trống mới với tên là "vutrudongho".
4. **Import dữ liệu**
   Trong thư mục gốc của dự án, tìm thư mục "Database" và bạn sẽ thấy tệp "vutrudongho_version16052023_vovanhung.sql".
   Mở phpMyAdmin và chọn cơ sở dữ liệu "vutrudongho" mà bạn vừa tạo.
   Nhấp vào tab "Import" và chọn tệp "vutrudongho_version16052023_vovanhung.sql" để import dữ liệu vào cơ sở dữ liệu.
5. **Bật XAMPP và khởi chạy dự án**
   Khởi động lại XAMPP và đảm bảo rằng cả Apache và MySQL đều đang chạy.
   Mở trình duyệt và gõ http://localhost:3000 (hoặc URL tương ứng điều hướng tới project) để chạy dự án.

Chúc mừng, bạn đã cài đặt và chạy dự án thành công trên máy tính của mình!
