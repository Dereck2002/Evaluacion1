<?php require_once('../html/head2.php') ?>




<div class="row">

    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Lista de Productos</h5>

                <div class="table-responsive">
                    <button type="button" onclick="cargaProducto()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal_productos">
                        Nuevo Producto
                    </button>
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">#</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nombre</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Precio</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Categoria</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Stock</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Opciones</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tabla_productos">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>







<div class="modal fade" id="Modal_productos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="frm_productos">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="ID_producto" id="ID_producto">                  
                    <div class="form-group">
                        <label for="nombre">Nombre del Producto</label>
                        <input type="text" required class="form-control" id="Nombre" name="Nombre" placeholder="Ingrese el nombre del producto">
                    </div>
                    <div class="form-group">
                        <label for="Precio">Precio</label>
                        <input type="decimal" required class="form-control" id="Precio" name="Precio" placeholder="Ingrese el precio del producto">
                    </div>
                    <div class="form-group">
                        <label for="ID_categoria">Categoria</label>
                      <select name="ID_categoria" id="ID_categoria" class="form-control">
                        <option value="0">Seleccione una categoria</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="Stock">Stock</label>
                        <input type="text" required class="form-control" id="Stock" name="Stock" placeholder="Ingrese el Stock">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Grabar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../html/script2.php') ?>

<script src="productos.js"></script>