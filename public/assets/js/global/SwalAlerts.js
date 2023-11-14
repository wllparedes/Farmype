export const SwalDelete = Swal.mixin({
    title: "¿Estás seguro?",
    text: "¡Esta acción no podrá ser revertida!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "¡Sí!",
    confirmButtonColor: "#f5365c",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "##5e72e4",
    reverseButtons: true,
});
