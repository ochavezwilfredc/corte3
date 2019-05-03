<?php

require_once "../controlador/conexion/Conexion.php";

class Huesped
{
    private $idhuesped, $nombre, $cedula, $telefono, $email, $direccion;

    /**
     * Huesped constructor.
     * @param $nombre
     * @param $cedula
     * @param $telefono
     * @param $email
     * @param $direccion
     */
    public function __construct($nombre, $cedula, $telefono, $email, $direccion)
    {
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
    }

    public function listar()
    {
        $sql = "SELECT * FROM huesped";
        return ejecutarConsulta($sql);
    }

    public function insertar()
    {
        $sql = "INSERT INTO huesped(nombre, cedula, telefono, email, direccion) 
                VALUES ('$this->nombre','$this->cedula','$this->telefono','$this->email','$this->direccion')";
        return ejecutarConsulta($sql);
    }

    public function editar()
    {
        $sql = "UPDATE huesped 
                SET nombre='$this->nombre',
                    cedula='$this->cedula',
                    telefono='$this->telefono',
                    email='$this->email',
                    direccion='$this->direccion' 
                WHERE idhuesped='$this->idhuesped'";
        return ejecutarConsulta($sql);
    }

    public function eliminar($idhuesped)
    {
        $sql = "DELETE 
                    FROM huesped 
                    WHERE idhuesped='$idhuesped'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idhuesped)
    {
        $sql = "SELECT * 
                    FROM huesped 
                    WHERE idhuesped='$idhuesped'";
        return ejecutarConsultaSimpleFila($sql);
    }

    /**
     * @return mixed
     */
    public function getIdhuesped()
    {
        return $this->idhuesped;
    }

    /**
     * @param mixed $idhuesped
     */
    public function setIdhuesped($idhuesped)
    {
        $this->idhuesped = $idhuesped;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param mixed $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $aux = "idhuesped: " . $this->getIdhuesped() . "\n" .
            "nombre: " . $this->getNombre() . "\n" .
            "cedula: " . $this->getCedula() . "\n" .
            "telefono: " . $this->getTelefono() . "\n" .
            "email: " . $this->getEmail() . "\n" .
            "direccion: " . $this->getDireccion();
        return $aux;
    }


}