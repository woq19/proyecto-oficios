<?php
class user{
    //propiedades principales del objeto
    public $nombre ='';
    public $apellido ='';
    public $dni ='';
    public $plan ='';
    public $mail ='';
    public $pass ='';
    public $id ='';

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setDni($dni){
        $this->dni=$dni;
    }
    public function setPlan($plan){
        $this->plan=$plan;
    }
    public function setMail($mail){
        $this->mail=$mail;
    }
    public function setPass($pass){
        $this->pass=$pass;
    }

    // public function setAll($datos){
    //     $this->nombre       =$datos['nombre'];
    //     $this->apellido     =$datos['apellido'];
    //     $this->dni          =$datos['dni'];
    //     $this->plan         =$datos['plan'];
    //     $this->mail         =$datos['mail'];
    //     $this->pass         =$datos['pass'];
    // }

    public function getNombre($nombre){
        return $this->nombre;
    }
    public function getApellido($apellido){
        return $this->apellido;
    }
    public function getMail($mail){
        return $this->mail;
    }
    public function getDni($dni){
        return $this->dni;
    }
    public function getPlan($plan){
        return $this->plan;
    }
    public function getPass($pass){
        return $this->pass;
    }
    public function getId($id){
        return $this->id;
    }

    //Metodo agregar
    public function Agregar(){
        $resultado['state'] = false;//si esta en false, hay error
        $resultado['msg'] = '';

        $sql ="INSERT INTO usuarios (nombre, apellido, dni, plan, mail, pass)
        VALUES ('$this->nombre', '$this->apellido',  '$this->dni',  '$this->plan', '$this->mail',' $this->pass')";
        $resultadoConsulta = DataBase::ejecutar($sql);

        if ($resultadoConsulta===true){
            $resultado['state'] = true;//registro agregado con exito
            $resultado['msg'] = 'Agregado con exito!';
        } else{
            $resultado['state'] = false;//error cargando el registro
            $resultado['msg'] = 'Error  :: cargando el registro (UC#76)';
        }
        
        return $resultado;
    }

    public function Buscar($buscar){
        $resultado['state'] = false;//si esta en false, hay error
        $resultado['msg'] = '';

        $sql ="SELECT al.nombre, al.apellido FROM alumno AS al WHERE al.nombre LIKE '%$buscar%'";
        $resultadoConsulta = DataBase::ejecutar($sql);
        
        
        return $resultado;
    }

    public static function validacionCampo($campo, $min, $max, $campoName) {
        /*
            $campo      :: string - referencia de nombre de campo en attr name del input
            $min        :: int - cantidad minima de caracteres de campo (determinado por la DB)
            $max        :: int - cantidad máxima de caracteres de campo (determinado por la DB)
            $campoName  :: string - Referencia de personalización de mensajes de campo
        */
        $msg = '';//Variable de mensaje de error (si existe)
        $estado = false; //Variable bool de estado de la validación (false:no hay error, True: hay error)
        $campo2 = ''; //Valor saneado de campo

        if (!isset($_POST[$campo])) {
            $msg = "No existe campo ".$campoName;
            $estado = true;
        } else {
            $campo2 = trim($_POST[$campo]);
            if (empty($campo2)) {
                $msg = $campoName.' no puede estar vacío';
                $estado = true;
            } else {
                if (strlen($campo2) < $min || strlen($campo2) > $max) {
                    $msg = 'Por favor ingrese entre '.$min.' y '.$max.' caracteres';
                    $estado = true;
                } 
            }
        }
        $resultado['msg'] =$msg;
        $resultado['state'] =$estado;
        $resultado['valor'] =$campo2;

        return $resultado;
    }

    public static function validarCampoNum($campo, $min, $max, $campoName,string $tipoNum){
        $msg = '';//Variable de mensaje de error (si existe)
        $estado = false; //Variable bool de estado de la validación (false:no hay error, True: hay error)
        $campo2 = ''; //Valor saneado de campo

        if (!isset($_POST[$campo])) {
            $msg = "No existe campo ".$campoName;
            $estado = true;
        } else {
            $campo2 = trim($_POST[$campo]);
            if (empty($campo2)) {
                $msg = $campoName.' no puede estar vacío';
                $estado = true;
            } else {
                if (!is_numeric($campo2)) {
                    $msg = $campoName.' debe ser un número';
                    $estado = true;
                }else{                
                    if (strtolower($tipoNum) === 'int') {
                        if ($campo2 < $min || $campo2 > $max) {
                            $msg = 'Por favor ingrese entre '.$min.' y '.$max.' caracteres';
                            $estado = true;
                        } 
                    }
                }
            }
        }
        $resultado['msg'] =$msg;
        $resultado['state'] =$estado;
        $resultado['valor'] =$campo2;

        return $resultado;
    }

    public static function validarCampoEmail($campo, $min, $max, $campoName, $checkDuplicacion = false)
     {
         /*
            $campo      :: string - referencia de nombre de campo en attr name del input
            $min        :: int - cantidad minima de caracteres de campo (determinado por la DB)
            $max        :: int - cantidad máxima de caracteres de campo (determinado por la DB)
            $campoName  :: string - Referencia de personalización de mensajes de campo
            $checkDuplicacion :: en false no comprueba duplicación.
        */

        /*Este método tiene que validar
            - exista el camo
            - que no esté vacio
            - cantidad de caracteres
            - formato correcto (email)
            - Validar duplicación de campo en la base de datosz
        */

        $msg = '';//Variable de mensaje de error (si existe)
        $estado = false; //Variable bool de estado de la validación (false:no hay error, True: hay error)
        $campo2 = ''; //Valor saneado de campo

        $validar = self::validacionCampo($campo, $min, $max, $campoName);

        $msg    = $validar['msg'];
        $estado = $validar['state'];
        $campo2 = $validar['valor'];

        if ($estado == false) {
            //Validar formato válido de email
            if (!filter_var($campo2, FILTER_VALIDATE_EMAIL)) {
                $msg = 'Formato de '. $campoName.' no válido';
                $estado = true;
            }else{
                //compruebo si existe el campo en la base de datos
                $sql = "SELECT mail FROM usuarios WHERE mail ='$campo2'";
                $resultadoConsulta = DataBase::getRecord($sql);
                //si $resultadoConsulta == FALSE, no hay registros

                if ($checkDuplicacion == true) {
                    if ($resultadoConsulta != false) {
                        //Login
                        $msg = 'El '.$campoName.' no se encuentra registrado';
                        $estado = true;
                    }
                }elseif ($checkDuplicacion == false) {
                    if ($resultadoConsulta !== false) {
                        //Registro
                        $msg = 'El '.$campoName.' '. $campo2.' ya se encuentra en uso';
                        $estado = true;
                    }
                }
            }
        }

        $resultado['msg'] =$msg;
        $resultado['state'] =$estado;
        $resultado['valor'] =$campo2;

        return $resultado;
     } 

    public function listado($buscar = null){
        $sql = "SELECT user.nombre, user.apellido, user.mail, user.id FROM usuarios user ";

        if (isset($buscar)) {
            # si existe
            $buscarSQL = "WHERE user.nombre LIKE '%$buscar%'";
        }else{
            # no existe
            $buscarSQL = '';
        }
        $sql = $sql.$buscarSQL;
        // echo $sql;

        $resultado = DataBase::getRecords($sql);
        return $resultado;
    }
    public function getById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $resultado = DataBase::getRecord($sql, ['id' => $id]);
        return $resultado;
    }
}