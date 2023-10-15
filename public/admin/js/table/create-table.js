document.addEventListener("DOMContentLoaded", function () {
    const createTableForm = document.getElementById('create_table');
    const createTableName = document.getElementById('create_table_name');
    const createTableType = document.getElementById('create_table_type');
    const createTableErName = document.getElementById('create_table_er_name');
    const createTableErType = document.getElementById('create_table_er_type');

    createTableForm.addEventListener('submit', function (e) {
        let valid = true;

        // Kiểm tra trường Tên bàn
        if (createTableName.value.trim() === '' || createTableName.value.length < 5 || createTableName.value.length > 100) {
            createTableErName.innerHTML = 'Tên bàn không hợp lệ (độ dài từ 5-100 ký tự)';
            valid = false;
        } else {
            createTableErName.innerHTML = '';
        }

        // Kiểm tra trường Loại bàn
        if (createTableType.value.trim() === '' || isNaN(createTableType.value) || createTableType.value < 1 || createTableType.value > 50) {
            createTableErType.innerHTML = 'Loại bàn không hợp lệ (số nguyên từ 1 đến 50)';
            valid = false;
        } else {
            createTableErType.innerHTML = '';
        }

        if (!valid) {
            e.preventDefault(); // Ngăn chặn gửi biểu mẫu nếu có lỗi
        }
    });
});

