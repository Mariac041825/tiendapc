function eliminarProducto(id){
    if(confirm("Seguro que desea eliminar este producto")){
        window.location.href="index.php?accion=eliminarProducto&id="+id;
    }
}
function eliminarCategoria(id){
    if(confirm("Seguro que desea eliminar esta categoria")){
        window.location.href="index.php?accion=eliminarCategoria&id="+id;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const mensaje = document.body.dataset.mensaje;

    if (mensaje) {
        switch (mensaje) {
            case "creado":
                Swal.fire({
                    icon: "success",
                    title: "Producto creado",
                    text: "El producto se creo correctamente.",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "pedidoCreado":
                Swal.fire({
                    icon: "success",
                    title: "Pedido creado",
                    text: "El pedido se creo correctamente.",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "registro":
                Swal.fire({
                    icon: "success",
                    title: "Usuario creado",
                    text: "El usuario se creo correctamente.",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "editado":
                Swal.fire({
                    icon: "success",
                    title: "Producto editado",
                    text: "La información del producto fue actualizada correctamente",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "editCat":
                Swal.fire({
                    icon: "success",
                    title: "Categoria editada",
                    text: "La Categoria fue actualizada correctamente",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "eliminado":
                Swal.fire({
                    icon: "success",
                    title: "Producto eliminado",
                    text: "El producto fue eliminado correctamente.",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "eliminadoCat":
                Swal.fire({
                    icon: "success",
                    title: "Categoria eliminada",
                    text: "La categoria fue eliminada correctamente.",
                    timer: 2000,
                    showConfirmButton: false,
                });
                break;
            case "error":
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Ocurrió un error inesperado.",
                });
                break;
        }

        const url = new URL(window.location.href);
        url.searchParams.delete("mensaje");
        window.history.replaceState({}, document.title, url.toString());
    }
});
