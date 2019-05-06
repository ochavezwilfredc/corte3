<?php

class Conexion
{
    private $servername = "localhost";
    private $dbname = "dbcorte3adi";
    private $username = "root";
    private $password = "";
    private $dbencode = "utf8";
    private $conexion;

    /**
     * Conexion constructor.
     */
    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexion->exec("set names $this->dbencode");

//            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Fallo la conexión: " . $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * @param $sql
     * @return bool|mysqli_result
     */
    public function ejecutarConsulta($sql)
    {
        $rpt = $this->conexion->prepare($sql);
        $rpt->execute();
        return $rpt;
    }

    /**
     * @param $sql
     * @return array|null
     */
    public function ejecutarConsultaSimpleFila($sql)
    {
        $query = $this->conexion->prepare($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function ejecutarConsulta_retornarID($sql)
    {
        $query = $this->conexion->prepare($sql);
        return $this->conexion->insert_id;
    }

    public function limpiarCadena($str)
    {
        $str = mysqli_real_escape_string($this->conexion, trim($str));
        return htmlspecialchars($str);
    }

    public function cerrarConexion()
    {
        $this->conexion = null;
    }

}
