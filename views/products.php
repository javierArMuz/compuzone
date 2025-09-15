<html>
<?php include '../controllers/ProductController.php'; ?>

<h2><?= isset($editing) && $editing ? 'Editar Producto' : 'Registrar Producto' ?></h2>
<form id="productForm" method="POST" action="../controllers/productController.php" novalidate>
  <?php if (!empty($editing) && $product): ?>
    <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
  <?php endif; ?>
  <!-- Nombre -->
  <input type="text" id="name" name="name" placeholder="Nombre del producto" minlength="3" maxlength="50" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,50}" required
    value="<?= htmlspecialchars($product['name'] ?? '') ?>">
  <small id="error_name" style="color:red; display:none;"></small><br>

  <!-- Descripción -->
  <input type="text" id="description" name="description" placeholder="Descripción" minlength="10" maxlength="255"
    value="<?= htmlspecialchars($product['description'] ?? '') ?>" required>
  <small id="error_description" style="color:red; display:none;"></small><br>

  <!-- Marca -->
  <select name="brand_id" id="brand_id" required>
    <option value="">-- Selecciona una marca --</option>
    <?php foreach ($brands as $brand): ?>
      <option value="<?= (int)$brand['id'] ?>"
        <?= (string)$brand['id'] === (string)($product['brand_id'] ?? '') ? 'selected' : '' ?>>
        <?= htmlspecialchars($brand['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <small id="error_brand_id" style="color:red; display:none;"></small><br>

  <!-- Modelo -->
  <input type="text" id="model" name="model" placeholder="Modelo" pattern="[a-zA-Z0-9\-]{2,20}" required
    value="<?= htmlspecialchars($product['model'] ?? '') ?>">
  <small id="error_model" style="color:red; display:none;"></small><br>

  <!-- Precio -->
  <input type="number" id="price" step="0.01" name="price" placeholder="Precio" min="0.01" max="999999" required
    value="<?= htmlspecialchars($product['price'] ?? '') ?>">
  <small id="error_price" style="color:red; display:none;"></small><br>

  <!-- Stock -->
  <input type="number" id="stock" name="stock" placeholder="Stock inicial" min="0" max="9999" required
    value="<?= htmlspecialchars($product['stock'] ?? '') ?>">
  <small id="error_stock" style="color:red; display:none;"></small><br>

  <!-- Categoría -->
  <select name="category_id" id="category_id" required>
    <option value="">-- Selecciona una categoría --</option>
    <?php foreach ($categories as $category): ?>
      <option value="<?= (int)$category['id'] ?>"
        <?= (string)$category['id'] === (string)($product['category_id'] ?? '') ? 'selected' : '' ?>>
        <?= htmlspecialchars($category['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <small id="error_category_id" style="color:red; display:none;"></small><br>

  <!-- URL de imagen -->
  <input type="text" id="image_url" name="image_url" placeholder="Image URL:" pattern="https?://.+"
    value="<?= htmlspecialchars($product['image_url'] ?? '') ?>" required>
  <small id="error_image_url" style="color:red; display:none;"></small><br>

  <!-- Estado activo -->
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

<script>
  document.getElementById("productForm").addEventListener("submit", function(e) {
    let valid = true;

    // Limpiar errores previos
    const fields = ['name', 'description', 'brand_id', 'model', 'price', 'stock', 'category_id', 'image_url'];
    fields.forEach(field => {
      document.getElementById("error_" + field).style.display = "none";
      document.getElementById("error_" + field).textContent = "";
    });

    // Validaciones
    const name = document.getElementById("name").value.trim();
    if (name.length < 3 || name.length > 50) {
      document.getElementById("error_name").textContent = "El nombre debe tener entre 3 y 50 caracteres.";
      document.getElementById("error_name").style.display = "inline";
      valid = false;
    }

    const description = document.getElementById("description").value.trim();
    if (description.length < 10 || description.length > 255) {
      document.getElementById("error_description").textContent = "La descripción debe tener entre 10 y 255 caracteres.";
      document.getElementById("error_description").style.display = "inline";
      valid = false;
    }

    const brand = document.getElementById("brand_id").value;
    if (brand === "") {
      document.getElementById("error_brand_id").textContent = "Debe seleccionar una marca.";
      document.getElementById("error_brand_id").style.display = "inline";
      valid = false;
    }

    const model = document.getElementById("model").value.trim();
    if (!/^[a-zA-Z0-9\-]{2,20}$/.test(model)) {
      document.getElementById("error_model").textContent = "El modelo debe tener entre 2 y 20 caracteres alfanuméricos.";
      document.getElementById("error_model").style.display = "inline";
      valid = false;
    }

    const price = parseFloat(document.getElementById("price").value);
    if (isNaN(price) || price <= 0) {
      document.getElementById("error_price").textContent = "El precio debe ser un número mayor a cero.";
      document.getElementById("error_price").style.display = "inline";
      valid = false;
    }

    const stock = parseInt(document.getElementById("stock").value);
    if (isNaN(stock) || stock < 0) {
      document.getElementById("error_stock").textContent = "El stock debe ser un número igual o mayor a cero.";
      document.getElementById("error_stock").style.display = "inline";
      valid = false;
    }

    const category = document.getElementById("category_id").value;
    if (category === "") {
      document.getElementById("error_category_id").textContent = "Debe seleccionar una categoría.";
      document.getElementById("error_category_id").style.display = "inline";
      valid = false;
    }

    const imageUrl = document.getElementById("image_url").value.trim();
    if (!/^https?:\/\/.+/.test(imageUrl)) {
      document.getElementById("error_image_url").textContent = "La URL debe comenzar con http:// o https://";
      document.getElementById("error_image_url").style.display = "inline";
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });
</script>

</html>