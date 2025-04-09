document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#formGasto");
  const formEditar = document.querySelector("#formEditarGasto");
  const modalEditarGasto = document.getElementById("modalEditarGasto");

  // Crear gasto
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const data = {
      descripcion: form.querySelector("#descripcion").value.trim(),
      categoria: parseInt(form.querySelector("#categoria").value),
      precio: parseFloat(form.querySelector("#precio").value),
    };

    fetch("php/modules/gastoController.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          Swal.fire("Éxito", data.message, "success").then(() => {
            location.reload();
          });
        } else if (data.status === "warning") {
          Swal.fire("¡Advertencia!", data.message, "warning").then(() => {
            location.reload();
          });
        } else {
          Swal.fire("Error", data.message, "error");
        }
      })
      .catch((error) => {
        console.error("Error al enviar:", error);
        Swal.fire("Error", "No se pudo registrar el gasto", "error");
      });
  });

  // Cargar datos al modal

  modalEditarGasto.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget;
    const id = button.getAttribute("data-id");

    fetch(`php/modules/gastoController.php?id=${id}`)
      .then((response) => response.json())
      .then((data) => {
        if (!data) {
          console.error("No se encontró el gasto.");
          return;
        }

        modalEditarGasto.querySelector("#id").value = data.ID;
        modalEditarGasto.querySelector("#descripcionEditar").value =
          data.Descripcion;
        modalEditarGasto.querySelector("#PrecioEditar").value = data.Precio;

        const selectCategoria =
          modalEditarGasto.querySelector("#categoriaEditar");
        for (let option of selectCategoria.options) {
          option.selected = option.value == data.Categoria;
        }
      })
      .catch((error) => {
        console.error("Error al cargar el gasto:", error);
      });
  });

  // Actualizar gasto
  if (formEditar) {
    formEditar.addEventListener("submit", function (event) {
      event.preventDefault();

      const data = new URLSearchParams();
      data.append("ID", formEditar.querySelector("#id").value);
      data.append(
        "descripcion",
        formEditar.querySelector("#descripcionEditar").value.trim()
      );
      data.append(
        "categoria",
        formEditar.querySelector("#categoriaEditar").value
      );
      data.append("Precio", formEditar.querySelector("#PrecioEditar").value);

      fetch("php/modules/gastoController.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: data.toString(),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            Swal.fire("Éxito", data.message, "success").then(() => {
              location.reload();
            });
          } else {
            Swal.fire("Error", data.message, "error");
          }
        })
        .catch((error) => {
          console.error("Error al actualizar:", error);
          Swal.fire("Error", "No se pudo actualizar el gasto", "error");
        });
    });
  }

  // aria


});
