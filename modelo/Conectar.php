<?php


class Conectar
{
    private $db_host = "localhost";
    private $db_name = "dbcorte3adi";
    private $db_username = "root";
    private $db_password = "";
    private $db_encode = "utf8";
    protected $conexion;

    protected function conexion()
    {
        try {
            $conectar = $this->conexion = new PDO("mysql:local=$this->db_host;
                dbname=$this->db_name",
                $this->db_username,
                $this->db_password);
            return $conectar;
        } catch (Exception $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names()
    {
        return $this->conexion->query("SET NAMES '$this->db_encode'");
    }
}
