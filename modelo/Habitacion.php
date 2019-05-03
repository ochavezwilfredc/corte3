<?php
require_once "../controlador/conexion/Conexion.php";

class Habitacion
{
    private $idhabitacion, $numero, $piso, $max_personas, $costo, $tiene_cama_bebe, $descripcion;

    /**
     * Habitacion constructor.
     * @param $numero
     * @param $piso
     * @param $max_personas
     * @param $costo
     * @param $tiene_cama_bebe
     * @param $descripcion
     */
    public function __construct($numero, $piso, $max_personas, $costo, $tiene_cama_bebe, $descripcion)
    {
        $this->numero = $numero;
        $this->piso = $piso;
        $this->max_personas = $max_personas;
        $this->costo = $costo;
        $this->tiene_cama_bebe = $tiene_cama_bebe;
        $this->descripcion = $descripcion;
    }


    public function listar()
    {
        $sql = "SELECT * FROM habitacion";
        return ejecutarConsulta($sql);
    }

    public function insertar()
    {
        $sql = "INSERT INTO habitacion(numero, piso, max_personas, costo, tiene_cama_bebe, descripcion)
                VALUES ('$this->numero','$this->piso','$this->max_personas','$this->costo','$this->tiene_cama_bebe','$this->descripcion')";
        return ejecutarConsulta($sql);
    }

    public function editar()
    {
        $sql = "UPDATE habitacion 
                SET numero='$this->numero',
                    piso='$this->piso',
                    max_personas='$this->max_personas',
                    costo='$this->costo',
                    tiene_cama_bebe='$this->tiene_cama_bebe',
                    descripcion='$this->descripcion' 
                WHERE idhabitacion='$this->idhabitacion'";
        return ejecutarConsulta($sql);
    }

    public function eliminar($idhabitacion)
    {
        $sql = "DELETE 
                    FROM habitacion 
                    WHERE idhabitacion='$idhabitacion'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idhabitacion)
    {
        $sql = "SELECT * 
                    FROM habitacion 
                    WHERE idhabitacion='$idhabitacion'";
        return ejecutarConsultaSimpleFila($sql);
    }

    /**
     * @return mixed
     */
    public function getIdhabitacion()
    {
        return $this->idhabitacion;
    }

    /**
     * @param mixed $idhabitacion
     */
    public function setIdhabitacion($idhabitacion)
    {
        $this->idhabitacion = $idhabitacion;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param mixed $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     * @return mixed
     */
    public function getMaxPersonas()
    {
        return $this->max_personas;
    }

    /**
     * @param mixed $max_personas
     */
    public function setMaxPersonas($max_personas)
    {
        $this->max_personas = $max_personas;
    }

    /**
     * @return mixed
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    /**
     * @return mixed
     */
    public function getTieneCamaBebe()
    {
        return $this->tiene_cama_bebe;
    }

    /**
     * @param mixed $tiene_cama_bebe
     */
    public function setTieneCamaBebe($tiene_cama_bebe)
    {
        $this->tiene_cama_bebe = $tiene_cama_bebe;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return Conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * @param Conexion $conexion
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }


    public function __toString()
    {
        // TODO: Implement __toString() method.
        $aux = "num: " . $this->getNumero() . "\n" .
            "piso: " . $this->getPiso() . "\n" .
            "max_per: " . $this->getMaxPersonas() . "\n" .
            "costo: " . $this->getCosto() .
            "bebe: " . $this->getTieneCamaBebe() . "\n" .
            "desc: " . $this->getDescripcion() . "\n" .
            "id: " . $this->getIdhabitacion();
        return $aux;


    }


}