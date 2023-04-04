// Lấy trạng thái hiện tại của chủ đề từ localStorage hoặc thiết lập chủ đề sáng mặc định
var currentTheme = localStorage.getItem('theme') || 'light';

// Cập nhật giao diện của trang web dựa trên chủ đề hiện tại
var updateTheme = function () {
    if (currentTheme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

// Đảo ngược chủ đề khi người dùng nhấn nút
var toggleTheme = function () {
    if (currentTheme === 'light') {
        localStorage.setItem('theme', 'dark');
        currentTheme = 'dark';
    } else {
        localStorage.setItem('theme', 'light');
        currentTheme = 'light';
    }
    updateTheme();
}

// Gán sự kiện click vào button
document.getElementById('theme-toggle').addEventListener('click', toggleTheme);

// Cập nhật giao diện lần đầu tiên khi trang web được tải
updateTheme();
