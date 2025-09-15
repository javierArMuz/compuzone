<?php
require_once __DIR__ . '/Conexion.php';

class Category
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = Conexion::conectar();
  }

  public function getAllCategories()
  {
    $stmt = $this->pdo->query("SELECT * FROM categories");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $stmt = $this->pdo->prepare("SELECT *
        FROM categories
        WHERE categories.id = :id");

    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // fetchOne porque es un solo producto
  }

  public function createCategory($name)
  {
    $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);
  }

  public function update($id, $name)
  {
    $stmt = $this->pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
    return $stmt->execute([$name, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);
  }
}
