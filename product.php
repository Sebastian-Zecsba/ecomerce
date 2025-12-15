<?php 
    include 'includes/header.php';

    require 'classes/Category.php';
    require 'classes/database.php';

    $database = new Database();
    $db = $database->getConnection();

    $categoryModel = new Category($db); 
    $stmt = $categoryModel->read();    
    $categories = $stmt->fetchAll();
?>

        <section>
            <form action="actions/product/create.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre producto">
                    </div>
                    <div>
                        <label for="descripcion">Descripción: </label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion producto">
                    </div>
                    <div>
                        <label for="precio">Precio: </label>
                        <input type="number" name="precio" id="precio">
                    </div>
                    <div>
                        <label for="stock">Cantidad: </label>
                        <input type="text" name="stock" id="stock">
                    </div>
                    <div>
                        <label for="categoria_id">Categoría: </label>
                        <select name="categoria_id" id="categoria_id">
                            <option value="">-- Categoria --</option>

                            <?php foreach ($categories as $category): ?>

                                <option value="<?= $category['id'] ?>"> <?php echo $category['nombre'] ?> </option>

                            <?php endforeach ?>

                        </select>
                    </div>
                    <div>
                        <label for="imagen">Agrega una imagen del producto</label>
                        <input type="file" name="imagen" id="imagen">
                    </div>

                    <button type="submit">Guardar</button>
            </form>
        </section>

 <?php 
    include 'includes/footer.php'
 ?>