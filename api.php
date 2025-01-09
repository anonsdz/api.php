<?php
// Thêm đường dẫn vào PATH để đảm bảo PHP có thể tìm thấy các lệnh
putenv('PATH=' . getenv('PATH') . ':/usr/bin:/usr/local/bin');

// Kiểm tra và in ra giá trị của PATH để kiểm tra đường dẫn
echo "PATH: " . getenv('PATH') . "<br>";

// Thông tin về hệ điều hành
$os = php_uname();
echo "Hệ điều hành: " . $os . "<br>";

// Thông tin về RAM và CPU
$total_ram = shell_exec('free -h | grep Mem | awk \'{print $2}\'');
$total_cpu = shell_exec('nproc');
echo "Tổng RAM: " . trim($total_ram) . "<br>";
echo "Tổng CPU: " . trim($total_cpu) . " cores<br>";

// Thông tin về Node.js
$nodePath = shell_exec('which node');
if ($nodePath) {
    echo "Node.js được tìm thấy tại: " . $nodePath . "<br>";
    $nodeVersion = shell_exec('node -v');
    echo "Phiên bản Node.js: " . $nodeVersion . "<br>";
} else {
    echo "Node.js không được tìm thấy!<br>";
}

// Thông tin về Python
$pythonPath = shell_exec('which python3');
if ($pythonPath) {
    echo "Python được tìm thấy tại: " . $pythonPath . "<br>";
    $pythonVersion = shell_exec('python3 --version');
    echo "Phiên bản Python: " . $pythonVersion . "<br>";
} else {
    echo "Python không được tìm thấy!<br>";
}

// Thông tin về Web Server (nginx/apache)
$webServer = '';
if (file_exists('/etc/nginx/nginx.conf')) {
    $webServer = 'nginx';
} elseif (file_exists('/etc/apache2/apache2.conf')) {
    $webServer = 'apache';
} else {
    $webServer = 'Không xác định';
}
echo "Web Server: " . $webServer . "<br>";

// Đường dẫn chứa file api.php
$scriptPath = __FILE__;
echo "Đường dẫn đến api.php: " . $scriptPath . "<br>";

// Kiểm tra tham số 'pkill'
if (isset($_GET['pkill']) && $_GET['pkill'] === 'true') {
    echo "Đang thực hiện lệnh pkill -f -9 tlskill...<br>";
    $pids_before = shell_exec("pgrep -f tlskill");
    echo "Các PID của tiến trình tlskill trước khi pkill:<br><pre>" . $pids_before . "</pre><br>";
    $pkillOutput = shell_exec('pkill -f -9 tlskill');
    $pids_after = shell_exec("pgrep -f tlskill");
    if (empty($pids_after)) {
        echo "Các tiến trình tlskill đã bị tắt thành công.<br>";
    } else {
        echo "Các tiến trình tlskill vẫn còn chạy. Các PID còn lại: <br><pre>" . $pids_after . "</pre><br>";
    }
    exit;
}

// Thực thi lệnh Node.js
$command = "/usr/bin/node /var/www/html/tlskill.js $host $time $rate $threads $proxy $methods";
exec($command . ' 2>&1', $output, $return_var);

if ($return_var !== 0) {
    echo "Lỗi khi chạy lệnh Node.js:<br><pre>" . implode("\n", $output) . "</pre><br>";
    exit;
}

echo "Lệnh đã được gửi đi và đang chạy trong nền. Kết quả sẽ được ghi vào file log.<br>";
?>
