

export const validateQuantity = () => {
    let spans = $(".valueQuantity");
    $.each(spans, function (i, v) {
        let number = Number(v.innerText);
        if (number === 1) {
            let target = v.previousElementSibling;
            target.setAttribute("disabled", true);
        }
        if (number === 10) {
            let target = v.nextElementSibling;
            target.setAttribute("disabled", true);
        }

    });
};
