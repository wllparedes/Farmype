
export const resetInputsForm = () => {

    const form = document.querySelector(".form-inputs");
    let inputs = form.querySelectorAll(".input-reset");
    inputs.forEach(input => {
        input.value = "";
    });

    let imgHolder = document.getElementById("img-holder");
    if (imgHolder) {
        imgHolder.innerHTML = "";
    }


}


