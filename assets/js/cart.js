document.addEventListener('DOMContentLoaded', function() {
    // Xử lý nút tăng giảm số lượng
    let quantityInputs = document.querySelectorAll('.cart__body-quantity-total');
    quantityInputs.forEach(function(input) {
        let minusBtn = input.previousElementSibling;
        let plusBtn = input.nextElementSibling;

        minusBtn.addEventListener('click', function() {
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });

        plusBtn.addEventListener('click', function() {
            input.value = parseInt(input.value) + 1;
        });
    });

    // Xử lý nút cập nhật giỏ hàng
    let updateBtn = document.querySelector('.cart__foot-update-btn');
    updateBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('form').submit();
    });
});