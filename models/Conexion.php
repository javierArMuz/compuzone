<?php
require_once __DIR__ . '/../config/db.php';

class Conexion
{
  public static function conectar()
  {
    global $pdo;
    return $pdo;
  }
}
