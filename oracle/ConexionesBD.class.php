<?php

Class ConexionesBD {
    private $host;
    private $port;
    private $user;
    private $password;
    private $service;
    private $conn;
    static $_instance;

    /*Metodo constructor privado, para evitar que el instanciamento de nuevos objetos Patrón Singleton */
    private function __construct($host, $port, $user, $password, $service) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->service = $service;        
    }
    /* Metodo no definido para evitar clones. Patrón Singleton */
    private function __clone() {
        
    }
    /* Método encargado de crear la instancia del objeto en caso de ser unica.     
     * Solo se puede utilizar para utilizar sus métodos
    */
    public static function instancia($host, $port, $user, $password, $service) {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($host, $port, $user, $password, $service);
        }
        return self::$_instance;
    }

    /* Método para establecer la Conexión a la base de datos. */
    public function conectar() {
        //$easyConnect = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $this->host)(PORT = $this->port)))(CONNECT_DATA=(SID=$this->service)))";
    $easyConnect = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $this->host)(PORT = $this->port)))(CONNECT_DATA=(SERVICE_NAME=$this->service)))";
        $this->conn = oci_connect($this->user, $this->password, $easyConnect);
        return $this->conn;
    }
    
    /* Método para ejecución de sentencias sin retorno */
    public function ejecuta($conn, $sentencia){
        $query = oci_parse($conn, $sentencia);
        if($query){            
            $resultado = oci_execute($query);
            if($resultado){                
                return $resultado;
            }
            else{
                return $error = oci_error($query);
            }
        }
        else{
            $error = oci_error($conn);                    
        }       
    }
    
    /* Método para ejecución de sentencias y retorno de arreglo Codigo - Nombre. */
    public function ejecutaCodigoNombre($conn, $sentencia, $recibo = NULL){
        $query = oci_parse($conn, $sentencia);
        if($query){
            if($recibo){
                oci_bind_by_name($query, ':un_identificacion', $recibo['IDENTIFICACION']);
                oci_bind_by_name($query, ':un_concepto', $recibo['CONCEPTO']);
                oci_bind_by_name($query, ':un_programa', $recibo['PROGRAMA']);
                oci_bind_by_name($query, ':un_cantidad', $recibo['CANTIDAD']);
                oci_bind_by_name($query, ':reciboCI', $numeroRecibo, 2000);
            }
            $resultado = oci_execute($query);
            if($resultado){
                unset($arrayResultado);           
                if($recibo){
                    $arrayResultado[] = array('CODIGO' => $numeroRecibo, 'NOMBRE' => $recibo['CODIGO_ORIGEN']);                                
                }
                else{
                    while($filaResultado = oci_fetch_row($query)){
                        $arrayResultado[] = array('CODIGO' => $filaResultado[0], 'NOMBRE' => $filaResultado[1]);
                    }
                } 
            }
            else {
                $error = oci_error($query);
            }
        }
        else{
            $error = oci_error($conn);                    
        }

        if($arrayResultado){
            return $arrayResultado;
        }
        else{
            return $error;
        }
    }
    
    /* Método para ejecución de sentencias y retorno de arreglo de resultados */ 
    public function ejecutaCompleto($conn, $sentencia){
        $query = oci_parse($conn, $sentencia);
        if($query){
            $resultado = oci_execute($query);
            if($resultado){              
                while($filaResultado = oci_fetch_assoc($query)){     
                    unset($arrayValores);                                       
                    foreach ($filaResultado as $campo => $valor) {    
                        $arrayValores[$campo] = $valor;
                    }                                            
                    $arrayResultado[] = $arrayValores;
                }                 
            }
            else {
                $error = oci_error($query);
            }
        }
        else{
            $error = oci_error($conn);                    
        }

        if($arrayResultado){
            return $arrayResultado;
        }
        else{
            return $error;
        }
    }
    
    /* Método para ejecución de sentencias sin retorno */
    public function ejecutaArray($conn, $sentencia){
        $query = oci_parse($conn, $sentencia);
        if($query){            
            $resultado = oci_execute($query);
            if($resultado){ 
                $row = oci_fetch_array($query, OCI_BOTH);               
                return $row;
            }
            else{
                return $error = oci_error($query);
            }
        }
        else{
            $error = oci_error($conn);                    
        }       
    }
    
    /* Método para ejecución de funciones o procedimientos parametrizadas */
    public function ejecutaFuncionProcedimiento($conn, $sentencia, $arregloBind, $retorno = NULL){  
        $query = oci_parse($conn, $sentencia);
        if($query){
            if($arregloBind){
                foreach ($arregloBind as $parametro => $valor) {
                    oci_bind_by_name($query, $parametro, $arregloBind[$parametro]);                                            
                }         
                $retorno ? oci_bind_by_name($query, $retorno, $retorno, 1000):NULL;                
            }
            $resultado = oci_execute($query);
            if($resultado){                
                unset($arrayResultado);                 
                $arrayResultado[] = $resultado;                                
            }
            else {
                $error = oci_error($query);
            }
        }
        else{
            $error = oci_error($conn);                    
        }       
        if($arrayResultado && !$error){
            if (isset($retorno)){
                unset($arrayResultado);
                $arrayResultado[] = $retorno;
            }            
            return $arrayResultado;            
        }
        else{
            return $error;
        }
    }    
    
    /* Método para ejecución de funciones o procedimientos parametrizadas que retornan cursores */
    public function ejecutaFuncionProcedimientoCursor($conn, $sentencia, $arregloBind, $retorno = NULL){  
        $query = oci_parse($conn, $sentencia);
        if($query){
            if($arregloBind){
                foreach ($arregloBind as $parametro => $valor) {
                    oci_bind_by_name($query, $parametro, $arregloBind[$parametro]);                                            
                }                     
            }
            $refCursor = oci_new_cursor($conn);
            oci_bind_by_name($query, $retorno, $refCursor, -1, OCI_B_CURSOR);                        
            oci_execute($query);
            $resultado = oci_execute($refCursor, OCI_DEFAULT);
            if($resultado){                
                unset($arrayResultado);                 
                $arrayResultado[] = $resultado;                                
            }
            else {
                $error = oci_error($query);
            }
        }
        else{
            $error = oci_error($conn);                    
        }       
        if($arrayResultado && !$error){
            if (isset($retorno)){
                unset($arrayResultado);                
                oci_fetch_all($refCursor, $arrayResultado, null, null, OCI_FETCHSTATEMENT_BY_ROW);                
            }            
            return $arrayResultado;            
        }
        else{
            return $error;
        }
    }
}
