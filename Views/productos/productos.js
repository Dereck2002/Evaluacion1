function init() {
  $("#frm_productos").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$().ready(() => {
  todos();
});

var todos = () => {
  var html = "";
  $.get("../../Controllers/productos.controller.php?op=todos", (res) => {
    console.log(res);
    res = JSON.parse(res);
    $.each(res, (index, valor) => {
      html += `<tr>
                <td>${index + 1}</td>
                <td>${valor.Nombre}</td>
                <td>${valor.Precio}</td>
                <td>${valor.categorias}</td>
                <td>${valor.Stock}</td>
            <td>
            <button class='btn btn-success' onclick='editar(${
              valor.ID_producto
            })'>Editar</button>
            <button class='btn btn-danger' onclick='eliminar(${
              valor.ID_producto
            })'>Eliminar</button>
            <button class='btn btn-info' onclick='ver(${
              valor.ID_producto
            })'>Ver</button>
            </td></tr>
                `;
    });
    $("#tabla_productos").html(html);
  });
};

var guardaryeditar = (e) => {
  e.preventDefault();
  var dato = new FormData($("#frm_productos")[0]);
  var ruta = "";
  var ID_producto = document.getElementById("ID_producto").value;
  if (ID_producto> 0) {
    ruta = "../../Controllers/productos.controller.php?op=actualizar";
  } else {
    ruta = "../../Controllers/productos.controller.php?op=insertar";
  }
  $.ajax({
    url: ruta,
    type: "POST",
    data: dato,
    contentType: false,
    processData: false,
    success: function (res) {
      res = JSON.parse(res);
      if (res == "ok") {
        Swal.fire("productos", "Registrado con éxito", "success");
        todos();
        limpia_Cajas();
      } else {
        Swal.fire("productos", "Error al guardo, intente mas tarde", "error");
      }
    },
  });
};

var cargaProducto = () => {
  return new Promise((resolve, reject) => {
    $.post("../../Controllers/categorias.controller.php?op=todos", (res) => {
      res = JSON.parse(res);
      var html = "";
      $.each(res, (index, val) => {
        html += `<option value="${val.ID_categoria}"> ${val.Nombre}</option>`;
      });
      $("#ID_categoria").html(html);
      resolve();
    }).fail((error) => {
      reject(error);
    });
  });
};

var editar = async (ID_producto) => {
  await cargaProducto();
  $.post(
    "../../Controllers/productos.controller.php?op=uno",
    { ID_producto: ID_producto },
    (res) => {
      res = JSON.parse(res);

      $("#ID_producto").val(res.ID_producto);
      $("#ID_categoria").val(res.ID_categoria);
      $("#Nombre").val(res.Nombre);
      $("#Precio").val(res.Precio);
      $("#Stock").val(res.Stock);
    }
  );
  $("#Modal_productos").modal("show");
};

var eliminar = (ID_producto) => {
  Swal.fire({
    title: "Producto",
    text: "Esta seguro de eliminar la provincia",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../Controllers/productos.controller.php?op=eliminar",
        { ID_producto: ID_producto },
        (res) => {
          res = JSON.parse(res);
          if (res === "ok") {
            Swal.fire("Productos", "Producto Eliminado", "success");
            todos();
          } else {
            Swal.fire("Error", res, "error");
          }
        }
      );
    }
  });

  limpia_Cajas();
};

var limpia_Cajas = () => {
  document.getElementById("ID_producto").value = "";
  document.getElementById("ID_categoria").value = "";
  document.getElementById("Nombre").value = "";
  document.getElementById("Precio").value = "";
  document.getElementById("Stock").value = "";
  $("#Modal_productos").modal("hide");
};
init();
