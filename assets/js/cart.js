
    document.addEventListener("DOMContentLoaded", () => {
        // Hàm cập nhật tổng tiền
        const updateTotal = () => {
            let total = 0;
            document.querySelectorAll("#cart-items tr").forEach((row) => {
                const price = parseInt(row.children[2].textContent.replace(/[^\d]/g, ""));
                const quantity = parseInt(row.querySelector(".quantity-input").value);
                const rowTotal = price * quantity;
                console.log("Price:", price); // Debugging log
                console.log("Quantity:", quantity); // Debugging log
                console.log("Row total:", rowTotal); // Debugging log
                total += rowTotal;
                
                // Cập nhật cột tổng
                const totalElement = row.children[4]; // Cột tổng
                if (totalElement) {
                    totalElement.textContent = rowTotal.toLocaleString("vi-VN") + " VNĐ";
                }
            });
            // document.getElementById("cart-total").textContent = total.toLocaleString("vi-VN") + " VNĐ";
            const cartTotalElement = document.getElementById("cart-total");
        if (cartTotalElement) {
            cartTotalElement.textContent = total.toLocaleString("vi-VN") + " VNĐ";
        }
        };
    
        // Gọi hàm cập nhật tổng tiền khi trang được tải
        updateTotal();
    
        // Xử lý tăng giảm số lượng
        document.querySelectorAll(".quantity-decrease, .quantity-increase").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const id = e.target.getAttribute("data-id"); // Lấy ID của sản phẩm
                const input = document.querySelector(`input[name="cart[${id}][quantity]"]`); // Tìm input theo name
                const change = e.target.classList.contains("quantity-decrease") ? "decrease" : "increase";
                if (input) {
                    const currentValue = parseInt(input.value);
                    if (change === "increase" && currentValue < 20) {
                        input.value = currentValue + 1;
                    } else if (change === "decrease" && currentValue > 1) {
                        input.value = currentValue - 1;
                    }
    
                    // Cập nhật tổng tiền sau khi thay đổi
                    updateTotal();
    
                    // Gửi yêu cầu cập nhật số lượng sản phẩm lên server
                    fetch("update_cart.php", {
                        method: "POST",
                        body: new URLSearchParams({
                            action: "update",
                            product_id: id,
                            change: change
                        })
                    }).then(response => {
                        if (response.ok) {
                            console.log("Giỏ hàng đã được cập nhật.");
                        }
                    });
                }
            });
        });
    
        // Ngăn chặn nhập giá trị âm
        document.querySelectorAll(".quantity-input").forEach((input) => {
            input.addEventListener("input", (e) => {
                let value = parseInt(e.target.value);
                if (value < 1) {
                    e.target.value = 1; // Đặt lại giá trị về 1 nếu giá trị âm hoặc 0
                }
                updateTotal(); // Cập nhật tổng tiền sau khi thay đổi số lượng
            });
        });
    
        // Xử lý xóa sản phẩm
        document.querySelectorAll(".remove-item").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                const productId = e.target.dataset.id;
                // Gửi yêu cầu xóa sản phẩm
                fetch("cart.php", {
                    method: "POST",
                    body: new URLSearchParams({
                        action: 'delete',
                        product_id: productId
                    })
                }).then(() => {
                    // Tải lại trang để cập nhật giỏ hàng
                    window.location.reload();
                });
            });
        });
    
        // Cập nhật lại tổng tiền khi trang tải
        updateTotal();
    });
    