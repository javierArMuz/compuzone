<?php

require_once __DIR__ . '/../models/Category.php';
$categoryModel = new Category();

// Modo edición (cargar data si viene id)
$editing = false;
$category = null;

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
  $category = $categoryModel->getById((int)$_GET['id']);
  if ($category) {
    $editing = true;
  }
}

// Accines (crear/update/delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['create_category'])) {
    $categoryModel->createCategory(
      $_POST['name'] ?? '',
    );
  } elseif (isset($_POST['update_category'])) {
    // Asegura id válido
    $id = isset($_POST['id']) && ctype_digit($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
      $categoryModel->update(
        $id,
        $_POST['name'] ?? '',
      );
    }
  } elseif (isset($_POST['delete_category'])) {
    $id = isset($_POST['id']) && ctype_digit($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id > 0) {
      $categoryModel->delete($id);
    }
  }

  // Redirección post/redirect/get
  header("Location: ../views/categories.php");
  exit();
}

// Listas para el formulario/listado
$categories = $categoryModel->getAllCategories();
