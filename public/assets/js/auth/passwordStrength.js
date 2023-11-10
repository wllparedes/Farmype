import { Expressions } from "./../global/regularExpressions.js";

/**
 *
 * @param {InputPassword} inputPassword Elemento input del contraseña para obtener el valor
 * @param {HTMLDivElement} alertPassword Div contenedor de la alerta de la fuerza de la contraseña
 * @param {HTMLElement} spanPassword Span del mensaje de la fuerza de la contraseña
 */
export function passwordStrength(inputPassword, alertPassword, spanPassword) {

    let passwordVal = inputPassword.value.trim();

    const weakPassword = Expressions.weakPassword.test(passwordVal);

    const mediumPassword = Expressions.mediumPassword.test(passwordVal);

    const strongPassword = Expressions.strongPassword.test(passwordVal);


    if (passwordVal.length === 0) {

        alertPassword.classList.add("password-strength");
        alertPassword.classList.remove("password-strength-active");

    } else {

        if (weakPassword) {
            alertPassword.classList.remove("password-strength");
            alertPassword.classList.add("password-strength-active");

            spanPassword.textContent = "Débil";
            spanPassword.classList.add("text-danger");
            spanPassword.classList.remove("text-success");
            spanPassword.classList.remove("text-yellow");
        }

        if (mediumPassword) {
            alertPassword.classList.remove("password-strength");
            alertPassword.classList.add("password-strength-active");

            spanPassword.textContent = "Mediano";
            spanPassword.classList.add("text-yellow");
            spanPassword.classList.remove("text-success");
            spanPassword.classList.remove("text-danger");
        }

        if (strongPassword) {
            alertPassword.classList.remove("password-strength");
            alertPassword.classList.add("password-strength-active");

            spanPassword.textContent = "Fuerte";
            spanPassword.classList.add("text-success");
            spanPassword.classList.remove("text-yellow");
            spanPassword.classList.remove("text-danger");
        }

    }




}
