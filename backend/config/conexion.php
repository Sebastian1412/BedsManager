<?php
/**
 * Archivo: config/conexion.php
 * Descripción: Gestiona la conexión a la base de datos mediante PDO.
 */

class Conexion
{
    private string $host = 'localhost';
    private string $db_name = 'bedsmanager';
    private string $username = 'root';
    private string $password = '';

    private ?PDO $conn = null;

    /**
     * Retorna una instancia de conexión PDO.
     *
     * @return PDO
     * @throws Exception si la conexión falla
     */
    public function conectar(): PDO
    {
        if ($this->conn !== null) {
            return $this->conn; // reutiliza conexión existente
        }

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Manejo de errores con excepciones
                PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa prepared statements reales
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC        // Retorna arrays asociativos
            ]);

        } catch (PDOException $e) {
            // En producción, no mostrar detalles sensibles
            throw new Exception('Error de conexión a la base de datos.');
        }

        return $this->conn;
    }
}