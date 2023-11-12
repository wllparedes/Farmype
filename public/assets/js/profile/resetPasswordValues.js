export const resetPasswordValues = () => {
    $("#password-now").val("");
    $("#password-now").removeClass("valid");
    $("#password").val("");
    $("#password").removeClass("valid");
    $("#password-confirm").val("");
    $("#password-confirm").removeClass("valid");
    $("#password-strength").removeClass("password-strength-active");
    $("#password-strength").addClass("password-strength");
};
