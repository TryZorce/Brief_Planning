<?php
// Définition des paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'tasks';
$user = 'root';
$password = 'root';

// Connexion à la base de données avec PDO
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
  die("Erreur : " . $e->getMessage());
}