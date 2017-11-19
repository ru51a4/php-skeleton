<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 19.11.17
 * Time: 9:49
 */

namespace App\Library;

use App\Config;
use PDO;

class Model
{
    /**
     * Options of the PDO connection
     */
    const DB_OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ];

    /**
     * @var PDO
     */
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->databaseConnection();
    }

    /**
     * Open the database connection with credentials from App\Config
     */
    private function databaseConnection()
    {
        $dsn = "mysql:host=" . Config::DB_HOSTNAME . ";" .
            "port=" . Config::DB_PORT . ";" .
            "dbname=" . Config::DB_DATABASE;

        $this->db = new PDO(
            $dsn,
            Config::DB_USERNAME,
            Config::DB_PASSWORD,
            self::DB_OPTIONS
        );
    }
}