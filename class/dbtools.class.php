<?php

/**

 *
 * Description: Clase Generica para el manejo de las sentencias sql
 *
 * @author Javier Mijares
 * @version 1.0  2010/10/21
 */
class cls_dbtools extends cls_logs {
    /******************************************************************
    /*******  VARIABLES
    /******************************************************************/
    var $return_id='';
    var $time='';
    var $genera_log=true;
    static $arr_codigosLogNoRewrite=array('INSERT'=>201,'UPDATE'=>202,'DELETE'=>203);
    private $codigos=array('INSERT'=>201,'UPDATE'=>202,'DELETE'=>203);
    private $add_myoptime_errors=true;
    public static $dbDebug =array();
    var $var_trans = '0';
    var $INSERT = 'INSERT';
    var $UPDATE = 'UPDATE';
    var $DELETE = 'DELETE';
    var $SELECT = 'SELECT';
    var $SELECT_SINGLE = 'SELECT_SINGLE';
    var $_DIE = 'DIE';
    var $_ECHO = 'ECHO';
    public static $DBParameters = array();
    private $DBconnection = array();
    private $resultDB = false;
    public static $DBsession = '';
    private $tablas_soap = array(
        'beneficiaries',
        'benefit',
        'benefit_type',
        'benefit_detail',
        'benefit_plan',
        'broker',
        'orders', 
        'order_comision',
        'orders_raider',
        'plans',
        'plan_category',
        'plan_categoria_detail',
        'plan_detail',
        'plan_raider',
        'plans_wording',
        'plans_wording_type',
        'policies_parameter',
        'raiders',
        'raiders_detail',
        'revocation_parameter',
        'territory',
        'usoweb_parameter',
        'wording_parameter');
    /******************************************************************
    /*******  CONSTRUCTOR
    /******************************************************************/
    function __construct(){
            $this->setCodigosLog(array(),true);

    }
    /******************************************************************
    /*******  FUNCIONES
    /******************************************************************/
    /**
     * Guarda de forma estatica los paramteros de conexion de la base de datos
     * @param array $arrDB
     */
    public static function assignDBParameters($arrDB){
        
		self::$DBParameters = $arrDB;
    }
    /**
     * Guarda el objeto del manejo de sessiones en el dbtools
     * @param $varSession
     */
    public static function assignSession($varSession){
        self::$DBsession = $varSession;
    }
    /**
     * Conecta con la base de datos permitiendo que sean multiples conexiones a distintas bases de datos
     * @param string $app
     * @return boolean
     */
    function _connectDB($app){
	$arrDBP = self::$DBParameters[$app];
	
	
	
        $this->DBconnection[$app] = mysql_connect($arrDBP['host'], $arrDBP['user'], $arrDBP['pass'], true);
	mysql_select_db($arrDBP['db'], $this->DBconnection[$app]);
        if(!is_object($this->DBconnection[$app]))
        {
            //echo ' => NO conecto';
			return false;
        }
        else
        {
           //echo ' => SI conecto';
		    return true;
        }
    }
    /**
     * Verifica la conexion a la base de datos
     * @param string $app
     */
    function check_connect($app){
    	$arr_config = '';
    	if (!isset($this->DBconnection[$app]) && !is_object($this->DBconnection[$app])){
            if (!isset($this->DBconnection[$app]) && !is_object($this->DBconnection[$app])){
                    $this->_connectDB($app);
            }
	}
    }
    /**
     * Begin Transaction
     * @param  $app
     */
    function _begin_tool($app='_DEFAULT') {
            mysql_query ( "BEGIN WORK" ) or die ( mysql_error ($this->DBconnection[$app]) );
            $this->var_trans = '1';
    }
    /**
     * Commit Transaction
     * @param  $app
     */
    function _commit_tool($app='_DEFAULT') {
            mysql_query ( "COMMIT" ) or die ( mysql_error ($this->DBconnection[$app]) );
            $this->var_trans = '0';
    }
    /**
     * Rollback Transaction
     * @param  $app
     */
    function _rollback_tool($app='_DEFAULT') {
            mysql_query ( "ROLLBACK" ) or die ( mysql_error ($this->DBconnection[$app]) );
    }

    /**
     * Construir una consulta de insert o update con los datos de un array
     *
     * @param $table nombre de la tabla
     * @param $data arreglo de campos y valores
     * @param $action tipo de consulta a ejecutar
     * @param $parameters filtros where de consulta update
     * @return string query generado
     */
    function build_query($table, $data, $action = 'insert', $parameters = ''){
            reset($data);
            if ($action == 'insert') {
                    $query = 'INSERT INTO ' . $table . ' (';
                            while (list($columns, ) = each($data)) {
                            $query .= $columns . ', ';
                    }
                    $query = substr($query, 0, -2) . ') VALUES (';
                    reset($data);
                    while (list(, $value) = each($data)) {
                    switch ((string)$value) {
                            case ('now()' || 'NOW()'):
                                    $query .= 'now(), ';
                            break;
                            case ('null' || 'NULL'):
                                    $query .= 'null, ';
                            break;
                            default:
                                    $query .= '\''.$value.'\', ';
                            break;
                            }
                    }
                    $query = substr($query, 0, -2) . ')';
            } elseif ($action == 'update') {
                    $query = 'update ' . $table . ' set ';
                    while (list($columns, $value) = each($data)) {
                            switch ((string)$value) {
                            case ('now()' || 'NOW()'):
                                    $query .= $columns . ' = now(), ';
                            break;
                            case ('null' || 'NULL'):
                                    $query .= $columns .= ' = null, ';
                            break;
                            default:
                                    $query .= $columns . ' = \''.$value.'\', ';
                            break;
                            }
                    }
                    $query = substr($query, 0, -2) . ' WHERE ' . $parameters;
            }
            return $query;
    }

    /**
     * Funcion general para hacer los queries
     * @param $tipo
     * @param $funct_call
     * @param $query
     * @param $comentario
     * @param $calcrows
     * @param $viewQ
     * @param $app
     * @return array
     */
    function _SQL_tool($tipo, $funct_call, $query, $comentario='',  $calcrows=1, $viewQ='', $app='_DEFAULT'){
            cls_dbtools::$dbDebug[] = array('class'=>get_class($this),'method'=>$funct_call,'query'=>$query,'time'=>  $this->time);
            if ($viewQ == _ECHO || $tipo == 'ECHO'){
                Debug::pr($query);
            }
            if ($viewQ == _DIE || $tipo == 'ECHO'){
                Debug::pr($query, true);
            }
            $tipo=strtoupper($tipo);
            $this->return_id = '';
            $query = trim($query);
            // Chequeo de conexion
            $this->check_connect($app);
            switch($tipo){
                    case 'SELECT':
                            if( stripos($query,'GROUP_CONCAT') !== false ){ $this->alterar_group_concat_max_len($app); }
                            set_time_limit(0);
                            ini_set('memory_limit',-1);
                            if($calcrows){ $query = substr($query,0,6)." SQL_CALC_FOUND_ROWS ".substr($query,6); }
                            $inicio = microtime();
                            $result = mysql_query("set names 'utf8'"); 
                            $result = mysql_query($query, $this->DBconnection[$app]);
                            $fin = microtime();
                            $this->time = $fin - $inicio;
                            $res_array = array ();
                            $i = 0;
                            //Consulta general
                            if ($result) {
                                    while($rows=mysql_fetch_assoc($result)){
                                            foreach($rows as $columna => $valor){
                                                    $res_array[$i][$columna] = $valor;
                                            }
                                            $i++;
                                    }
									//$rows2=mysql_fetch_assoc($result);
									print_r($rows=mysql_fetch_assoc($result));
									//var_dump($result);
									//echo 'acaa'.$rows;
								 //die();
									//print_r($res_array);
                                    //Para retornar el total de registros si no existiera el limite
                                    $result = mysql_query('SELECT FOUND_ROWS() as total', $this->DBconnection[$app]);
                                    if($row=mysql_fetch_assoc($result)){
                                            $this->total_verdadero = $row['total'];
                                    } else {
                                            $this->total_verdadero = 0;
                                    }

                                    return $res_array;
                            } else {
                                    $this->print_log_error(debug_backtrace(), $query, $app);
                            }
                            break;
                    case 'SELECT_SINGLE':
                            if( stripos($query,'GROUP_CONCAT') !== false ){ $this->alterar_group_concat_max_len($app); }
                            $inicio = microtime();
                            //~ $result = mysql_query("set names 'utf8'"); 
                            $result = mysql_query($query, $this->DBconnection[$app]);
							
                            $fin = microtime();
                            $this->time = $fin - $inicio;
                            $res_array=array();
                            if ($result) {
                                    if($rows=mysql_fetch_assoc($result)){
                                            foreach($rows as $columna => $valor){
                                                    $res_array[$columna] = $valor;
                                            }
                                    }
                                    return $res_array;
                            } else {
                                    $this->print_log_error(debug_backtrace(), $query, $app);
                            }
                            break;
                    case 'INSERT':
                    case 'UPDATE':
                    case 'DELETE':
							//$query=addslashes($query);
							//$query=stripslashes($query);
                            $query_valido = $this->process_query($query,$tipo);
                            if($query_valido){
                                    $inicio = microtime();
									//~ $result = mysql_query("set names 'utf8'"); 
                                    $result = mysql_query($query, $this->DBconnection[$app]);
                                    $fin = microtime();
                                    $this->time = $fin - $inicio;
                                    if($result){
                                            $return_value = true;
                                            if($tipo=='INSERT'){
                                                    $this->return_id = mysql_insert_id($this->DBconnection[$app]);
                                                    $return_value = $this->return_id;
                                            }
                                           
                                        
                                            return $return_value;
                                    } else {
                                            $this->print_log_error(debug_backtrace(), $query, $app);
                                    }
                            } else {
                                    die("Sentencia no corresponde con el primer parametro de la funcion _SQL_tool. Debe ser corregido para continuar");
                            }
                            break;
            }
    }

    /**
     * Propiedad para alargar el resultado de la lista al ejecutar
     * el comando GROUP_CONCAT de mysql al hacer un select
     */
    private function alterar_group_concat_max_len(){
            //Hay que quitar el limite de la funcion para poder mostrar todos los posibles valores
            $prequery="SET @@group_concat_max_len = 9999999";
            mysql_query($prequery, $this->DBconnection[$app]);
    }

    /**
     * Cambia el nro de codigo estandar para la sentencias
     * Ejemplo:
     * ...
     * $LogCodigoNew=array('INSERT'=>101);
     * $this->setCodigosLog($array_log);
     * $this->_SQL_tool('INSERT', __METHOD__, $query, 'User Login');
     * ...
     *
     * El ejemplo generara en el logo el codigo 101 con el comentario 'User Login'
     * en vez de generar el codigo 201 que hace referencia a un registro de datos nuevo
     *
     * NOTA: por defecto luego de ejecutar la sentencia se resetean los codigos a su estado original,
     * si se desea generar otra sentencia con otro codigo se debe realizar los pasos previos antes de la funcion _SQL_tool
     *
     */
    function setCodigosLog($arrValues=array(), $autoSet=false){
            if($autoSet){
                    $this->codigos=cls_dbtools::$arr_codigosLogNoRewrite;
            }else{
                    $this->codigos=array_merge($this->codigos,$arrValues);
            }
    }
    /**
     * Imprime un mensaje de error en la aplicacion cuando se ejecuta una sentencia SQL invalida
     * @param  $back_trace
     * @param  $query
     * @param  $app
     */
    function print_log_error($back_trace, $query, $app){
            if(!$this->add_myoptime_errors) return;
            if($this->error_ocurred) return;

            $back_trace =array_reverse($back_trace);

            $var_approot=str_replace("/","\\",APPROOT);
            $arr_vars=array('file','line','class','function');
            for($i=0,$max=count($back_trace); $i<$max; $i++){
                    foreach($arr_vars as $key=>$value){
                            if($value=='file'){
                                    $arr_tree[$i][$value]=str_replace(array($var_approot,"\\"),array(DOMAIN_ROOT,"/"),$back_trace[$i][$value])."<br>";
                                    continue;
                            }
                            $arr_tree[$i][$value]=$back_trace[$i][$value];
                    }
            }
            $arr_tree[0]['mysql_errno']=mysql_errno($this->DBconnection[$app]);
            $arr_tree[0]['mysql_error']=str_replace('\'','"',mysql_error($this->DBconnection[$app]));
            $arr_tree[0]['query']=nl2br($query);
            $arr_tree[0]['user_name']=self::$DBsession->read('s_first_name')." ".self::$DBsession->read('s_last_name');
            $arr_tree[0]['date'] = date("Y-m-d h:i:s");
            $id_error = $this->register_SQL_error(serialize($arr_tree), $app);
            $arr_tree[0]['id_error'] = $id_error;

            if(defined("SEND_SQL_ERRORS_EMAIL") && SEND_SQL_ERRORS_EMAIL==1){
                $vars=$this->contruct_body_error($arr_tree);
                if(defined("SEND_SQL_ERRORS_MYOPT") && SEND_SQL_ERRORS_MYOPT==1){
                    $obj_myoptime = new cls_myoptime;
                    $vars['##myoptime_id##'] = $obj_myoptime->ins_myoptime('',"Bug Track # ".$id_error, $vars['##message##']."<br />".$vars['##error_detail##'],'','');
                }
                $arr_email=$this->get_list_notif_error($app);
                /* Instaciación del nuevo objeto Email */
				$objemail = new Email(array('smtpServer'=>EMAIL_SERVER_HOST,'smtpUser'=>EMAIL_SERVER_USER,'smtpPassword'=>EMAIL_SERVER_PASS,'appDomainRoot'=>DOMAIN_ROOT,'skeletonFile'=>APPROOT.'lib/common/email_skeleton.php','emailEngine'=>EMAIL_ENGINE,'transGroupID'=>EMAIL_TRANSACTIONAL_GROUP_ID),array('debug'=>0,'emailDebug'=>EMAIL_DEBUG));
				foreach($vars as $varstr => $varvalue){
					$objemail->setVariable($varstr, $varvalue);
				}
				$objemail->send($from=array('name'=>EMAIL_FROM_NAME,'email'=>EMAIL_FROM), $to=/* $notify_email */$arr_email, "BUG_TRACK", 1);
            }
            $this->error_ocurred=true;

            if(!headers_sent()){
                    header("location: ".DOMAIN_ROOT."pages/app_error.php?code=".$id_error);
                    exit;
            } else {
                    include(COREROOT."lib/common/app_mysql_error.php");
            }
    }
    /**
     * Registra un error de SQL en la base de datos
     * @param $apperror_text
     * @param $app
     * @return int
     */
    function register_SQL_error($apperror_text='', $app){
        if ($this->var_trans == '1') {
            $this->_rollback_tool();
        }
        $id=substr(md5(microtime()),0,18);
        $query="INSERT app_error (apperror_id, apperror_time, apperror_text, ip, user_id) VALUES
        ('$id',NOW(),'".mysql_real_escape_string($apperror_text, $this->DBconnection[$app])."', '".$_SERVER['REMOTE_ADDR']."', '".self::$DBsession->read('s_id')."')";
        mysql_query($query, $this->DBconnection[$app]) or die("Error: ".mysql_error($this->DBconnection[$app])."<br /><br />Function: ".__METHOD__."<br /><br />Query: ".$query);
        return $id;
    }
    /**
     * Busca un error especifico en la base de datos
     * @param $apperror_id
     */
    function get_SQL_error($apperror_id){
        $query="SELECT * FROM app_error WHERE apperror_id='$apperror_id' ";
        $this->SQL_error = $this->_SQL_tool('SELECT_SINGLE', __METHOD__, $query);
    }
    /**
     * Cosntruye el cuerpo del error para enviarlo por correo
     * @param $arr_detail
     * @return string
     */
    function contruct_body_error($arr_detail){
            $tab=0;
            $html_detail="<table style=\"font-size:12px; color:#666\" width=\"100%\">";
            for($i=0,$max=count($arr_detail); $i<$max; $i++){
                    $html_detail.="<tr><td style=\"padding-left:".$tab."px\">
                            <table style=\"font-size:12px; color:#666\" width=\"100%\">
                            <tr><td width=\"5%\"><strong>File:</strong></td><td nowrap>"
                             .$arr_detail[$i]['file'].
                             "<strong> in Line"
                             .$arr_detail[$i]['line'].
                             "</strong></td></tr><tr><td><strong>Class:</strong></td><td>"
                             .$arr_detail[$i]['class'].
                             "</td></tr><tr><td><strong>Function:</strong></td><td>".
                             $arr_detail[$i]['function'].
                             "</td></tr></table><hr /></td></tr>";
                    $tab+=5;
            }
            $html_detail.=	"<tr><td><br /><strong>Query:</strong><br />"
                    .$arr_detail[0]["query"]."<br /><br /><strong>Mysql Error No: </strong>"
                    .$arr_detail[0]["mysql_errno"]."<br /><strong>Mysql Error Description: </strong>"
                    .$arr_detail[0]["mysql_error"]."</td></tr></table>";
            $detail_mess="<strong>Un error ha ocurrido en ".SYSTEM_NAME."</strong>, a continuación se especifica el detalle<br />";
            $footer="Mensaje Generado Automaticamente por ".SYSTEM_NAME;
            $vars=array("##error_detail##"=>$html_detail,
                                    "##error_id##"=>$arr_detail[0]["id_error"],
                                    "##date##"=>$arr_detail[0]["date"],
                                    "##user_name##"=>$arr_detail[0]["user_name"],
                                    "##message##"=>$detail_mess,
                                    "##footer##"=>$footer
                                    );
            return $vars;
    }
    /**
     * Busca la lista de usuarios a quiees se les envia el error generado
     * @param $app
     * @return array
     */
    function get_list_notif_error($app){
            $default=array("");
            $query="SELECT email from app_error_users ";
            $rs=mysql_query($query, $this->DBconnection[$app]) or die(mysql_error($this->DBconnection[$app]));
            $arr_users_error=array();
            if($rs){
                    while($row=mysql_fetch_array($rs)){
                            $arr_users_error[]=$row['email'];
                    }
            }
            return ($arr_users_error)? $arr_users_error : $default;
    }
}
