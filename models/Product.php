<?php
require_once __DIR__ . '/Conexion.php';

class Product
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = Conexion::conectar();
  }

  public function getAll()
  {
    $stmt = $this->pdo->query("SELECT p.*, 
        b.name AS brand_name,
        c.name AS category_name
    FROM products p
    LEFT JOIN brands b ON p.brand_id = b.id
    LEFT JOIN categories c ON p.category_id = c.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $stmt = $this->pdo->prepare("SELECT p.*, 
            b.name AS brand_name,
            c.name AS category_name
        FROM products p
        LEFT JOIN brands b ON p.brand_id = b.id
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = :id");

    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // fetchOne porque es un solo producto
  }

  public function create($name, $description, $brand_id, $model, $price, $stock, $category_id, $image_url, $is_active)
  {
    $stmt = $this->pdo->prepare("INSERT INTO products (name, description, brand_id, model, price, stock, category_id, image_url, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $brand_id, $model, $price, $stock, $category_id, $image_url, $is_active]);
  }

  public function update($id, $name, $description, $brand_id, $model, $price, $stock, $category_id, $image_url, $is_active)
  {
    $stmt = $this->pdo->prepare("UPDATE products SET name = ?, description = ?, brand_id = ?, model = ?, price = ?, stock = ?, category_id = ?, image_url = ?, is_active = ? WHERE id = ?");
    $stmt->execute([$name, $description, $brand_id, $model, $price, $stock, $category_id, $image_url, $is_active, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
  }

  public function updateStock($productId, $quantity, $type)
  {
    $operator = $type === 'entrada' ? '+' : '-';
    $stmt = $this->pdo->prepare("UPDATE products SET stock = stock $operator ? WHERE id = ?");
    $stmt->execute([$quantity, $productId]);
  }

  public function getAllCategories()
  {
    $stmt = $this->pdo->query("SELECT * FROM categories");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
