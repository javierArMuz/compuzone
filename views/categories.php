<html>
<?php include '../controllers/CategoryController.php'; ?>

<h2><?= isset($editing) && $editing ? 'Editar Categoría' : 'Registrar Categoría' ?></h2>
<form id="categoryForm" method="POST" action="../controllers/CategoryController.php">
  <?php if (!empty($editing) && $category): ?>
    <input type="hidden" name="id" value="<?= (int)$category['id'] ?>">
  <?php endif; ?>
  <input type="text" name="name" placeholder="Nombre de la categoría" minlength="1" maxlength="30" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" required
    value="<?= htmlspecialchars($category['name'] ?? '') ?>"><br>

  <button type="submit" name="<?= !empty($editing) ? 'update_category' : 'create_category' ?>">
    <?= !empty($editing) ? 'Actualizar' : 'Guardar' ?>
  </button>
</form>

<hr>

<h3>Listado de Categorías</h3>
<table border="1">
  <tr>
    <th>Nombre</th>
    <th>Acciones</th>
  </tr>
  <?php foreach ($categories as $c): ?>
    <tr>
      <td><?= $c['name'] ?></td>
      <td>
        <!-- Editar: navega a la misma vista con id= -->
        <a href="categories.php?id=<?= (int)$c['id'] ?>">Edit</a>

        <!-- Eliminar: por POST -->
        <form method="POST" action="../controllers/CategoryController.php" style="display:inline"
          onsubmit="return confirm('¿Seguro de eliminar esta categoría?');">
          <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
          <button type="submit" name="delete_category">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

</html>