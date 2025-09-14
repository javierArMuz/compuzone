<?php

require_once __DIR__ . '/../models/Product.php';
$productModel = new Product();
require_once __DIR__ . '/../models/Brand.php';
$brandModel = new Brand();

// Modo edición (cargar data si viene id)
$editing = false;
$product = null;

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
  $product = $productModel->getById((int)$_GET['id']);
  if ($product) {
    $editing = true;
  }
}

// Accines (crear/update/delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Normaliza checkbox
  $isActive = isset($_POST['is_active']) ? 1 : 0;

  if (isset($_POST['create_product'])) {
    $productModel->create(
      $_POST['name'] ?? '',
      $_POST['description'] ?? '',
      (int)($_POST['brand_id'] ?? 0),
      $_POST['model'] ?? '',
      (float)($_POST['price'] ?? 0),
      (int)($_POST['stock'] ?? 0),
      (int)($_POST['category_id'] ?? 0),
      $_POST['image_url'] ?? '',
      $isActive
    );
  } elseif (isset($_POST['update_product'])) {
    // Asegura id válido
    $id = isset($_POST['id']) && ctype_digit($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
      $productModel->update(
        $id,
        $_POST['name'] ?? '',
        $_POST['description'] ?? '',
        (int)($_POST['brand_id'] ?? 0),
        $_POST['model'] ?? '',
        (float)($_POST['price'] ?? 0),
        (int)($_POST['stock'] ?? 0),
        (int)($_POST['category_id'] ?? 0),
        $_POST['image_url'] ?? '',
        $isActive
      );
    }
  } elseif (isset($_POST['delete_product'])) {
    $id = isset($_POST['id']) && ctype_digit($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
      $productModel->delete($id);
    }
  }

  // Redirección post/redirect/get
  header("Location: ../views/products.php");
  exit();
}

// Listas para el formulario/listado
$products   = $productModel->getAll();
$brands     = $brandModel->getAllBrands();
$categories = $productModel->getAllCategories();
