<html>
<?php include '../controllers/BrandController.php'; ?>

<h2><?= isset($editing) && $editing ? 'Editar Marca' : 'Registrar Marca' ?></h2>
<form id="brandForm" method="POST" action="../controllers/BrandController.php">
  <?php if (!empty($editing) && $brand): ?>
    <input type="hidden" name="id" value="<?= (int)$brand['id'] ?>">
  <?php endif; ?>
  <input type="text" name="name" placeholder="Nombre de la marca" minlength="2" maxlength="30" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{2,30}" required
    value="<?= htmlspecialchars($brand['name'] ?? '') ?>"><br>

  <button type="submit" name="<?= !empty($editing) ? 'update_brand' : 'create_brand' ?>">
    <?= !empty($editing) ? 'Actualizar' : 'Guardar' ?>
  </button>
</form>

<hr>

<h3>Listado de Marcas</h3>
<table border="1">
  <tr>
    <th>Nombre</th>
    <th>Acciones</th>
  </tr>
  <?php foreach ($brands as $b): ?>
    <tr>
      <td><?= $b['name'] ?></td>
      <td>
        <!-- Editar: navega a la misma vista con id= -->
        <a href="brands.php?id=<?= (int)$b['id'] ?>">Edit</a>

        <!-- Eliminar: por POST -->
        <form method="POST" action="../controllers/BrandController.php" style="display:inline"
          onsubmit="return confirm('¿Seguro de eliminar esta marca?');">
          <input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
          <button type="submit" name="delete_brand">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

</html>