<?php

require_once __DIR__ . '/../models/Brand.php';
$brandModel = new Brand();

// Modo edición (cargar data si viene id)
$editing = false;
$brand = null;

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
  $brand = $brandModel->getById((int)$_GET['id']);
  if ($brand) {
    $editing = true;
  }
}

// Accines (crear/update/delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['create_brand'])) {
    $brandModel->createBrand(
      $_POST['name'] ?? '',
    );
  } elseif (isset($_POST['update_brand'])) {
    // Asegura id válido
    $id = isset($_POST['id']) && ctype_digit($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
      $brandModel->update(
        $id,
        $_POST['name'] ?? '',
      );
    }
  } elseif (isset($_POST['delete_brand'])) {
    $id = isset($_POST['id']) && ctype_digit($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
      $brandModel->delete($id);
    }
  }

  // Redirección post/redirect/get
  header("Location: ../views/brands.php");
  exit();
}

// Listas para el formulario/listado
$brands = $brandModel->getAllBrands();
