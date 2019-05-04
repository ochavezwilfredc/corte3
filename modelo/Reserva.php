<?php
require_once "../controlador/conexion/Conexion.php";

class Reserva
{
    private $idreserva, $fecha_inicio, $fecha_fin, $estado, $comentario, $idhabitacion, $idhuesped;

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
     * Reserva constructor.
     * @param $fecha_inicio
     * @param $fecha_fin
     * @param $comentario
     * @param $idhabitacion
     * @param $idhuesped
     */
    public function __construct5($fecha_inicio, $fecha_fin, $comentario, $idhabitacion, $idhuesped)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->estado = "1";
        $this->comentario = $comentario;
        $this->idhabitacion = $idhabitacion;
        $this->idhuesped = $idhuesped;
    }


    /**
     * Reserva constructor.
     * @param $fecha_inicio
     * @param $fecha_fin
     * @param $estado
     * @param $comentario
     * @param $idhabitacion
     * @param $idhuesped
     */
    public function __construct6($fecha_inicio, $fecha_fin, $estado, $comentario, $idhabitacion, $idhuesped)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->estado = $estado;
        $this->comentario = $comentario;
        $this->idhabitacion = $idhabitacion;
        $this->idhuesped = $idhuesped;
    }

    public function listar()
    {
        $sql = "select
                    r.idreserva,
                    DATE(r.fecha_inicio) as fecha_inicio,
                    DATE(r.fecha_fin) as fecha_fin,
                    h.numero as hab_num,
                    h.costo as hab_costo,
                    h2.nombre as hue_nombre,
                    h2.telefono as hue_telefono,
                    r.estado,
                    r.comentario
                    from reserva as r
                        inner join habitacion h on r.idhabitacion = h.idhabitacion
                        inner join huesped h2 on r.idhuesped = h2.idhuesped
                    order by r.idreserva";
        return ejecutarConsulta($sql);
    }

    public function insertar()
    {
        $sql = "INSERT INTO reserva(fecha_inicio, fecha_fin, estado, comentario, idhabitacion, idhuesped)
                VALUES ('$this->fecha_inicio','$this->fecha_fin','$this->estado','$this->comentario','$this->idhabitacion','$this->idhuesped')";
        return ejecutarConsulta($sql);
    }

    public function editar()
    {
        $sql = "UPDATE reserva 
                    SET fecha_inicio='$this->fecha_inicio',
                        fecha_fin='$this->fecha_fin',
                        estado='$this->estado',
                        comentario='$this->comentario',
                        idhabitacion='$this->idhabitacion',
                        idhuesped='$this->idhuesped'
                    WHERE idreserva=='$this->idreserva'";
        return ejecutarConsulta($sql);
    }

    public function anular($idreserva)
    {
        $sql = "UPDATE reserva
                    SET estado ='0' 
                    WHERE idreserva='$idreserva'";
        return ejecutarConsulta($sql);
    }

    public function activar($idreserva)
    {
        $sql = "UPDATE reserva 
                    SET condicion='1' 
                    WHERE idreserva='$idreserva'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idreserva)
    {
        $sql = "select
                        r.idreserva,
                        DATE(r.fecha_inicio) as fecha_inicio,
                        DATE(r.fecha_fin) as fecha_fin,
                        h.numero as hab_num,
                        h.costo as hab_costo,
                        h2.nombre as hue_nombre,
                        h2.telefono as hue_telefono,
                        r.estado,
                        r.comentario,
                        h.idhabitacion,
                        h2.idhuesped
                    from reserva as r
                             inner join habitacion h on r.idhabitacion = h.idhabitacion
                             inner join huesped h2 on r.idhuesped = h2.idhuesped
                    where r.idreserva = '$idreserva'";
        return ejecutarConsultaSimpleFila($sql);
    }


    public function select()
    {
        $sql = "SELECT * FROM reserva 
                    where condicion=1";
        return ejecutarConsulta($sql);
    }

    /**
     * @return mixed
     */
    public function getIdreserva()
    {
        return $this->idreserva;
    }

    /**
     * @param mixed $idreserva
     */
    public function setIdreserva($idreserva)
    {
        $this->idreserva = $idreserva;
    }

    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * @param mixed $fecha_inicio
     */
    public function setFechaInicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * @param mixed $fecha_fin
     */
    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        $aux = "
            idreserva: " . $this->getIdreserva() . "\n" .
            "fecha_inicio: " . $this->getFechaInicio() . "\n" .
            "fecha_fin: " . $this->getFechaFin() . "\n" .
            "estado: " . $this->getEstado() . "\n" .
            "comentario: " . $this->getComentario() . "\n" .
            "idhabitacion: " . $this->getIdhabitacion() . "\n" .
            "idhuesped: " . $this->getIdhuesped() . "\n";
        return $aux;
    }


}