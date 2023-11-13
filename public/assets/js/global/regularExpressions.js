export const Expressions = {
    isNumeric: /^[0-9]+$/,
    isPrice: /^[0-9]+(\.\d{0,2})?$/,
    isAlphaNumeric: /^[a-zA-Z0-9]+$/,
    weakPassword: /^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*|[a-zA-Z0-9]*)$/,
    mediumPassword: /^(((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9])).{8,12})$/,
    strongPassword: /^(((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9])).{13,})$/,
};


