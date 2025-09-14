<?php
require_once __DIR__ . '/Conexion.php';

class Brand
{
  private $pdo;

  public function __construct()
  {
    $this->pdo = Conexion::conectar();
  }

  public function getAllBrands()
  {
    $stmt = $this->pdo->query("SELECT * FROM brands");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id)
  {
    $stmt = $this->pdo->prepare("SELECT *
        FROM brands
        WHERE brands.id = :id");

    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // fetchOne porque es un solo producto
  }

  public function createBrand($name)
  {
    $stmt = $this->pdo->prepare("INSERT INTO brands (name) VALUES (?)");
    $stmt->execute([$name]);
  }

  public function update($id, $name)
  {
    $stmt = $this->pdo->prepare("UPDATE brands SET name = ? WHERE id = ?");
    return $stmt->execute([$name, $id]);
  }

  public function delete($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM brands WHERE id = ?");
    $stmt->execute([$id]);
  }
}
