<html>
<?php include '../controllers/ProductController.php'; ?>

<h2><?= isset($editing) && $editing ? 'Editar Producto' : 'Registrar Producto' ?></h2>
<form method="POST" action="../controllers/productController.php">
  <?php if (!empty($editing) && $product): ?>
    <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
  <?php endif; ?>
  <input type="text" name="name" placeholder="Nombre del producto" required
    value="<?= htmlspecialchars($product['name'] ?? '') ?>"><br>

  <input type="text" name="description" placeholder="Descripción"
    value="<?= htmlspecialchars($product['description'] ?? '') ?>"><br>

  <select name="brand_id" required>
    <option value="">-- Selecciona una marca --</option>
    <?php foreach ($brands as $brand): ?>
      <option value="<?= (int)$brand['id'] ?>"
        <?= (string)$brand['id'] === (string)($product['brand_id'] ?? '') ? 'selected' : '' ?>>
        <?= htmlspecialchars($brand['name']) ?>
      </option>
    <?php endforeach; ?>
  </select><br>

  <input type="text" name="model" placeholder="Modelo" required
    value="<?= htmlspecialchars($product['model'] ?? '') ?>"><br>

  <input type="number" step="0.01" name="price" placeholder="Precio" required
    value="<?= htmlspecialchars($product['price'] ?? '') ?>"><br>

  <input type="number" name="stock" placeholder="Stock inicial" min="0" required
    value="<?= htmlspecialchars($product['stock'] ?? '') ?>"><br>

  <select name="category_id" required>
    <option value="">-- Selecciona una categoria --</option>
    <?php foreach ($categories as $category): ?>
      <option value="<?= (int)$category['id'] ?>"
        <?= (string)$category['id'] === (string)($product['category_id'] ?? '') ? 'selected' : '' ?>>
        <?= htmlspecialchars($category['name']) ?>
      </option>
    <?php endforeach; ?>
  </select><br>
  <input type="text" name="image_url" placeholder="Image URL:"
    value="<?= htmlspecialchars($product['image_url'] ?? '') ?>"><br>
  <label>
    Activo:
    <input type="checkbox" name="is_active"
      <?= (!empty($product['is_active']) || (empty($editing))) ? 'checked' : '' ?>>
  </label><br>

  <button type="submit" name="<?= !empty($editing) ? 'update_product' : 'create_product' ?>">
    <?= !empty($editing) ? 'Actualizar' : 'Guardar' ?>
  </button>
</form>

<hr>

<h3>Listado de Productos</h3>
<table border="1">
  <tr>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Categoría</th>
    <th>Image URL</th>
    <th>Estado</th>
    <th>Acciones</th>
  </tr>
  <?php foreach ($products as $p): ?>
    <tr>
      <td><?= $p['name'] ?></td>
      <td><?= $p['description'] ?></td>
      <td><?= $p['brand_name'] ?? 'Sin marca' ?></td>
      <td><?= $p['model'] ?? 'Sin modelo' ?></td>
      <td><?= $p['price'] ?></td>
      <td><?= isset($p['stock']) ? $p['stock'] : 'N/A' ?></td>
      <td><?= $p['category_name'] ?></td>
      <td><?= $p['image_url'] ?? 'Sin Imagen' ?></td>
      <td><?= $p['is_active'] ? 'Activo' : 'Inactivo' ?></td>
      <td>
        <!-- Editar: navega a la misma vista con id= -->
        <a href="products.php?id=<?= (int)$p['id'] ?>">Edit</a>

        <!-- Eliminar: por POST -->
        <form method="POST" action="../controllers/productController.php" style="display:inline"
          onsubmit="return confirm('¿Seguro de eliminar este producto?');">
          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
          <button type="submit" name="delete_product">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

</html>