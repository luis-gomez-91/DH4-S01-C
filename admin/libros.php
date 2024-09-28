<?php 
    include('../core/encabezadoAdmin.php')
?>

    <main class="mt-5 px-5">
        <div class="row">
            <div class="col-4">
                <h1 class="text-center">Adicionar Libro</h1>

                <form class="mt-5" action="libros.php" method="GET">
                    <div class="mb-3">
                        <label for="txtTitulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="txtTitulo" name="titulo">
                    </div>
                    <div class="mb-3">
                        <label for="txtAutor" class="form-label">Autor</label>
                        <select name="" id="txtAutor" class="form-control" name="autor">
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
                        <select name="" id="txtCategoria" class="form-control" name="categoria">
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
                    <button type="submit" class="btn btn-primary form-control mt-3">Adicionar</button>
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
                    </tr>

                    <?php 
                        $consulta = "select libro.* , autor.nombre as autor, categoria.nombre as categoria
                                from libro
                                join autor on autor.id = libro.autor_id
                                join categoria on categoria.id = libro.categoria_id;";
                        
                        if ($result = $conexion -> query($consulta)) {
                            while($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $titulo = $row['titulo'];
                                $autor = $row['autor'];
                                $categoria = $row['categoria'];
                                $precio = $row['precio'];
                                $stock = $row['stock'];

                                ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $titulo; ?></td>
                                        <td class="text-center"><?php echo $autor; ?></td>
                                        <td class="text-center"><?php echo $categoria; ?></td>
                                        <td class="text-center">$<?php echo $precio; ?></td>
                                        <td class="text-center"><?php echo $stock; ?></td>
                                    </tr>
                                <?php
                            }

                        }
                        
                    ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>