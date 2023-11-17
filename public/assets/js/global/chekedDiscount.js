let checkbox = document.querySelector('input[type="checkbox"]');
let discountValue = document.getElementById("discount-value");

checkbox.addEventListener("click", function () {

    if (checkbox.checked) {
        discountValue.classList.remove("discount-value");
        discountValue.classList.add("discount-value-active");
    } else {
        discountValue.classList.add("discount-value");
        discountValue.classList.remove("discount-value-active");
    }
});
