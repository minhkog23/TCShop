// Ngăn chặn nhập giá trị âm
document.querySelectorAll(".box-soLuong-sl").forEach((input) => {
    input.addEventListener("input", (e) => {
        let value = parseInt(e.target.value);
        if (value < 1) {
            e.target.value = 1; // Đặt lại giá trị về 1 nếu giá trị âm hoặc 0
        }
    });
});

