<?php

require_once "../controlador/conexion/Conexion.php";

class Huesped
{
    private $idhuesped, $nombre, $cedula, $telefono, $email, $direccion;

    //    Fuente: https://desarrolloweb.com/articulos/sobrecarga-constructores-php.html
    function __construct()
    {
        //obtengo un array con los parámetros enviados a la función
        $params = func_get_args();
        //saco el número de parámetros que estoy recibiendo
        $num_params = func_num_args();
        //cada constructor de un número dado de parámtros tendrá un nombre de función
        //atendiendo al siguiente modelo __construct1() __construct2()...
        $funcion_constructor = '__construct' . $num_params;
        //compruebo si hay un constructor con ese número de parámetros
        if (method_exists($this, $funcion_constructor)) {
            //si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    //ahora declaro una serie de métodos constructores que aceptan diversos números de parámetros
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

    public function alistar()
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