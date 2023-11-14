import { Toast } from './../global/ToastSwal.js';

export const uploadImage = (input, form) => {
        var inputUserImageStore = $(input);
        inputUserImageStore.on("change", function () {
            if ($(this).val()) {
                var img_path = $(this)[0].value;
                var img_holder = $(this)
                    .closest(form)
                    .find(".img-holder");
                var currentImagePath = $(this).data("value");
                var img_extension = img_path
                    .substring(img_path.lastIndexOf(".") + 1)
                    .toLowerCase();

                if (
                    img_extension == "jpeg" ||
                    img_extension == "jpg" ||
                    img_extension == "png"
                ) {
                    if (typeof FileReader != "undefined") {
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("<img/>", {
                                src: e.target.result,
                                class: "img-fluid avatar_img",
                            }).appendTo(img_holder);
                        };
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    } else {
                        $(img_holder).html(
                            "Este navegador no soporta Lector de Archivos"
                        );
                    }
                } else {
                    $(img_holder).html(currentImagePath);
                    inputUserImageStore.val("");
                    Toast.fire({
                        icon: "warning",
                        title: "¡Selecciona una imagen!",
                    });
                }
            }
        });

}

