<?php

require_once("Conectar.php");

class Huesped extends Conectar
{
    private $idhuesped, $nombre, $cedula, $telefono, $email, $direccion;

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
     * Huesped constructor.
     * @param $nombre
     * @param $cedula
     * @param $telefono
     * @param $email
     * @param $direccion
     */
    public function __construct5($nombre, $cedula, $telefono, $email, $direccion)
    {
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
    }

    public function listar()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM huesped";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insertar()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO huesped(nombre, cedula, telefono, email, direccion) 
                VALUES ('$this->nombre','$this->cedula','$this->telefono','$this->email','$this->direccion')";
        $sql = $conectar->prepare($sql);
        return $sql->execute();

    }


    public function editar()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE huesped 
                SET nombre='$this->nombre',
                    cedula='$this->cedula',
                    telefono='$this->telefono',
                    email='$this->email',
                    direccion='$this->direccion' 
                WHERE idhuesped='$this->idhuesped'";

        $sql = $conectar->prepare($sql);
        return $sql->execute();
    }

    public function eliminar($idhuesped)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE 
                    FROM huesped 
                    WHERE idhuesped='$idhuesped'";
        $sql = $conectar->prepare($sql);
        return $sql->execute();
    }

    public function mostrar($idhuesped)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * 
                    FROM huesped 
                    WHERE idhuesped='$idhuesped'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchALL(PDO::FETCH_ASSOC);
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

