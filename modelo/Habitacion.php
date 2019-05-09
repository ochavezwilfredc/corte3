<?php
require_once("Conectar.php");

class Habitacion extends Conectar
{
    private $idhabitacion, $numero, $piso, $max_personas, $costo, $tiene_cama_bebe, $descripcion;


//    Fuente: https://desarrolloweb.com/articulos/sobrecarga-constructores-php.html
    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct0()
    {
    }

    /**
     * Habitacion constructor.
     * @param $numero
     * @param $piso
     * @param $max_personas
     * @param $costo
     * @param $tiene_cama_bebe
     * @param $descripcion
     */
    public function __construct6($numero, $piso, $max_personas, $costo, $tiene_cama_bebe, $descripcion)
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
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM habitacion";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insertar()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO habitacion(numero, piso, max_personas, costo, tiene_cama_bebe, descripcion)
                VALUES ('$this->numero','$this->piso','$this->max_personas','$this->costo','$this->tiene_cama_bebe','$this->descripcion')";
        $sql = $conectar->prepare($sql);
        return $sql->execute();
    }

    public function editar()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE habitacion 
                SET numero='$this->numero',
                    piso='$this->piso',
                    max_personas='$this->max_personas',
                    costo='$this->costo',
                    tiene_cama_bebe='$this->tiene_cama_bebe',
                    descripcion='$this->descripcion' 
                WHERE idhabitacion='$this->idhabitacion'";
        $sql = $conectar->prepare($sql);
        return $sql->execute();
    }

    public function eliminar($idhabitacion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE 
                    FROM habitacion 
                    WHERE idhabitacion='$idhabitacion'";
        $sql = $conectar->prepare($sql);
        return $sql->execute();
    }

    public function mostrar($idhabitacion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * 
                    FROM habitacion 
                    WHERE idhabitacion='$idhabitacion'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchALL(PDO::FETCH_ASSOC);
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