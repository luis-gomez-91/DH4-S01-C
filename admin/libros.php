<?php 
    include('../core/encabezadoAdmin.php');

    if ($_POST) {
        if($_POST['action']) {
            $action = $_POST['action'];

            if ($action == 'add') {
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $categoria = $_POST['categoria'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];
        
                $query = "INSERT INTO libro(titulo, autor_id, categoria_id, precio, stock) VALUES('$titulo', $autor, $categoria, $precio, $stock);";
                $result = mysqli_query($conexion, $query);
            }
            else if ($action == 'delete') {
                $id = $_POST['id'];
                $query = "DELETE FROM libro WHERE id = $id;";
                $result = mysqli_query($conexion, $query);
            }

            else if ($action == 'edit') {
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $categoria = $_POST['categoria'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];

                $query = "  UPDATE libro 
                            SET titulo = '$titulo', 
                            autor_id = $autor,
                            categoria_id = $categoria,
                            precio = $precio,
                            stock = $stock
                            WHERE id = $id;";

                $result = mysqli_query($conexion, $query);

            }
        }
        

    }

?>

    <main class="mt-5 px-5">
        <div class="row">
            <div class="col-4">
                <h1 class="text-center" id="nameFormAdd">Adicionar Libro</h1>

                <form class="mt-5" action="libros.php" method="POST">
                    <input type="text" name="action" value="add" id="actionFormAdd" hidden>
                    <input type="number" name="id" id="idFormAdd" hidden>
                    <div class="mb-3">
                        <label for="txtTitulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="txtTitulo" name="titulo">
                    </div>
                    <div class="mb-3">
                        <label for="txtAutor" class="form-label">Autor</label>
                        <select id="txtAutor" class="form-control" name="autor">
                            <option value="0">---</option>

                            <?php 
                                $consulta = "select * from autor;";
                                    if ($result = $conexion -> query($consulta)) {
                                        while($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $nombre = $row['nombre'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                            <?php
                                        }
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="txtCategoria" class="form-label">Categoria</label>
                        <select id="txtCategoria" class="form-control" name="categoria">
                            <option value="0">---</option>
                            <?php 
                                $consulta = "select * from categoria;";
                                    if ($result = $conexion -> query($consulta)) {
                                        while($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $nombre = $row['nombre'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                            <?php
                                        }
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="txtPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="txtPrecio" name="precio">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="txtStock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="txtStock" name="stock">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button onclick="limpiarFormAdd()" class="btn btn-warning">Limpiar datos</button>
                        <button type="submit" class="btn btn-primary" id="btnFormAdd">Adicionar libro</button>
                    </div>
                    
                </form>
            </div>
            <div class="col-8 ps-5">
                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>

                    <?php 
                        $consulta = "select libro.* , autor.nombre as autor, categoria.nombre as categoria
                                from libro
                                join autor on autor.id = libro.autor_id
                                join categoria on categoria.id = libro.categoria_id
                                ORDER BY id;";
                        
                        if ($result = $conexion -> query($consulta)) {
                            while($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $titulo = $row['titulo'];
                                $autor = $row['autor'];
                                $categoria = $row['categoria'];
                                $precio = $row['precio'];
                                $stock = $row['stock'];
                                $autor_id = $row['autor_id'];
                                $categoria_id = $row['categoria_id'];

                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $titulo; ?></td>
                                        <td class="text-center"><?php echo $autor; ?></td>
                                        <td class="text-center"><?php echo $categoria; ?></td>
                                        <td class="text-center">$<?php echo $precio; ?></td>
                                        <td class="text-center"><?php echo $stock; ?></td>
                                        <td class="text-center" style="display: flex; gap:5px; justify-content:center;">

                                            <button 
                                                class="btn btn-success" 
                                                onclick="editarLibro(
                                                    <?php echo $id; ?>,
                                                    '<?php echo $titulo; ?>',
                                                    <?php echo $autor_id; ?>,
                                                    <?php echo $categoria_id; ?>,
                                                    <?php echo $precio; ?>,
                                                    <?php echo $stock; ?>,

                                                )">
                                                Editar
                                            </button>

                                            <form action="libros.php" method="POST">
                                                <input type="number" value="<?php echo $id; ?>" name="id" hidden>
                                                <input type="text" name="action" value="delete" hidden>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                            }

                        }
                        
                    ?>
                </table>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const txtTitulo =document.querySelector('#txtTitulo')
            const txtAutor =document.querySelector('#txtAutor')
            const txtCategoria =document.querySelector('#txtCategoria')
            const txtPrecio =document.querySelector('#txtPrecio')
            const txtStock =document.querySelector('#txtStock')
            const actionFormAdd =document.querySelector('#actionFormAdd')
            const idFormAdd =document.querySelector('#idFormAdd')
            const btnFormAdd =document.querySelector('#btnFormAdd')
            const nameFormAdd =document.querySelector('#nameFormAdd')

            editarLibro = (id, titulo, autor, categoria, precio, stock) => {
                idFormAdd.value = id
                txtTitulo.value = titulo
                txtAutor.value = autor
                txtCategoria.value = categoria
                txtPrecio.value = precio
                txtStock.value = stock
                actionFormAdd.value = 'edit'
                btnFormAdd.innerHTML = 'Editar libro'
                nameFormAdd.innerHTML = 'Editar libro'
            }   

            limpiarFormAdd = () => {
                idFormAdd.value = 0
                txtTitulo.value = ''
                txtAutor.value = 0
                txtCategoria.value = 0
                txtPrecio.value = null
                txtStock.value = null
                actionFormAdd.value = 'add'
                btnFormAdd.innerHTML = 'Adicionar libro'
                nameFormAdd.innerHTML = 'Adicionar libro'

            }

        })
    </script>
</body>
</html>