function init(){
    $("#frm_categorias").on("submit", function(e){
        guardaryeditar(e);
    });
}


$().ready(()=>{
    todos();
});

var todos = () =>{
    var html = "";
    $.get("../../Controllers/categorias.controller.php?op=todos", (res) => {
      res = JSON.parse(res);
      $.each(res, (index, valor) => {
       
        html += `<tr>
                <td>${index + 1}</td>
                <td>${valor.Nombre}</td>
                <td>${valor.Descripcion}</td>
            <td>
            <button class='btn btn-success' onclick='editar(${
              valor.ID_categoria
            })'>Editar</button>
            <button class='btn btn-danger' onclick='eliminar(${
              valor.ID_categoria
            })'>Eliminar</button>
            <button class='btn btn-info' onclick='ver(${
              valor.ID_categoria
            })'>Ver</button>
            </td></tr>
                `;
      });
      $("#tabla_categorias").html(html);
    });
  };

  var guardaryeditar=(e)=>{
    e.preventDefault();
    var dato = new FormData($("#frm_categorias")[0]);
    var ruta = '';
    var ID_categoria = document.getElementById("ID_categoria").value
    if(ID_categoria > 0){
     ruta = "../../Controllers/categorias.controller.php?op=actualizar"
    }else{
        ruta = "../../Controllers/categorias.controller.php?op=insertar"
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
            Swal.fire("categorias", "Registrado con éxito" , "success");
            todos();
            limpia_Cajas();
          } else {
            Swal.fire("usuarios", "Error al guardo, intente mas rtarde", "error");
          }
        },
      });
  }

  var editar = (ID_categoria)=>{
  
    $.post(
      "../../Controllers/categorias.controller.php?op=uno",
      { ID_categoria: ID_categoria },
      (res) => {
        res = JSON.parse(res);
        $("#ID_categoria").val(res.ID_categoria);
        $("#Nombre").val(res.Nombre);
        $("#Descripcion").val(res.Descripcion);
    
      }
    );
    $("#Modal_categorias").modal("show");
  }


  var eliminar = (ID_categoria)=>{
    Swal.fire({
        title: "categorias",
        text: "Esta seguro de eliminar la categoria",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.post(
            "../../Controllers/categorias.controller.php?op=eliminar",
            { ID_categoria: ID_categoria },
            (res) => {
              res = JSON.parse(res);
              if (res === "ok") {
                Swal.fire("categorias", "Categoria Eliminada", "success");
                todos();
              } else {
                Swal.fire("Error", res, "error");
              }
            }
          );
        }
      });
  
      impia_Cajas();
}
  
  var limpia_Cajas = ()=>{
    document.getElementById("ID_categoria").value = "";
    document.getElementById("Nombre").value = "";
    document.getElementById("Descripcion").value = "";
    $("#Modal_categorias").modal("hide");
  
  }
  init();