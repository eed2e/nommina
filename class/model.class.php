<?php 
/**
 * D2PW Solutions
 *
 * Description: Funciones generales para cargar y guardar data en cualquier tabla de la base de datos
 *
 * @author Miguel Aguero y Cesar Lizarraga
 * @version 1.0  2010/10/21
 */
class Model extends cls_dbtools {
    /******************************************************************
    /*******  VARIABLES
    /******************************************************************/
    var $id=null;
    var $table;
    var $idName = 'id';

    /******************************************************************
    /*******  CONSTRUCTOR
    /******************************************************************/
    function __construct(){  }

    /******************************************************************
    /*******  FUNCIONES
    /******************************************************************/
    /**
     * Realiza una busqueda de una tabla en especifico
     * @param $condition
     * @param $limit
     * @param $fields
     * @param $type
     * @param $order
     * @return boolean
     */
    function find($condition, $limit=null, $fields='*', $type = '', $order = '',$inners = '',$other_conditions='')
    {
        $queryCondition = '1 ';
        $query = 'SELECT ';
                if ($condition) {
        foreach($condition as $field=>$value){
                   // if ($value){
                        if (is_array($value)){
			$queryCondition.= ' AND '.get_class($this).".".$field."in ('".implode("','",$value)."') ";
                        }else{
                        $queryCondition.= ' AND '.get_class($this).".".$field."='".$value."' ";
        }
                   // }
		}
                }
                $queryCondition.= " ".$other_conditions;
        if(is_array($fields)){
                foreach($fields as $i => $value){
                        if($i > 0 ) $query.= ',';
                        $query.= $value;
                }
        }else{
                $query.= $fields;
        }

        if(!empty($order))	$order = " ORDER BY ".$order;

		$query .= " FROM ".$this->table." ".get_class($this)." ".$inners." where ".$queryCondition.$order;
        $result = false;
			if(is_array($limit)) {
				$query .= " LIMIT " . $limit[0].','.$limit[1];
				//die($query);
				$result = $this->_SQL_tool('SELECT', __METHOD__, $query);
			} else if(!is_null($limit)){
                $result = $this->_SQL_tool('SELECT_SINGLE', __METHOD__, $query);
        } else {
                $result = $this->_SQL_tool('SELECT', __METHOD__, $query);
        }
        if(strcasecmp('list',$type) == 0){
                $list = array();
			$key = (count($fields) > 1) ? $fields[0] : $this->idName;
                $value =  (count($fields) > 1) ? $fields[1] : 'name';
                if (count($result)>0)
                        foreach ($result as $element)	$list[$element[$key]] = $element[$value];
                $result = $list;
        }
        return $result;
    }
    /**
     * Guarda la informacion de una tabla en especifico
     * @param $data
     * @return int
     */
    function save($data)
    {
        if($data["$this->idName"]!=null)	$this->id = $data["$this->idName"];

		if(empty($data["$this->idName"]))
			unset($data["$this->idName"]);

        if($this->id!=null){
            $query = "UPDATE " . $this->table ." SET ";
            $values = " ";
            $sw = false;
            foreach($data as $field=>$value) {
                if($sw)
                    $values.= ", ";
                else
                    $sw = true;

                htmlentities(trim($values), ENT_COMPAT);
                $values.= $field.'="'.$value.'"';
            }

            $values.=", modified=now()";
            $query.= $values . ' WHERE ' .$this->idName.'='.$this->id;
            //Debug::pr($query, true);
            $result = $this->_SQL_tool('UPDATE', __METHOD__, $query);

        } else {
            $query = "INSERT INTO " . $this->table;
            $sw = false;

            foreach($data as $field=>$value){
                if($sw){
                    $fields.=", ";
                    $values.=", ";
                } else {
                    $fields =" (";
                    $values =" (";
                    $sw = true;
                }
                $fields.= $field;
                htmlentities(trim($values), ENT_COMPAT);
                $values.= '"'.$value.'"';
            }
            $fields.=",created,modified)";
            $values .=",now(),now())";

            $query.=" " . $fields." VALUES ".$values;
            $result = $this->_SQL_tool('INSERT', __METHOD__, $query);
            $this->id = $result;
        }
        return $result;
    }
    /**
     * Guarda la informacion contenida en un array en una tabla en especifico
     * @param $data
     * @return int
     */
    function saveAll($data){
    	$this->_begin_tool();

    	foreach ($data as $element){
            $result[] = $this->save($element);
            $this->id = null;
	}
    	if($result)	$this->_commit_tool();
    	else		$this->_rollback_tool();

        return $result;
    }
    /**
     * Busca el ultimo ID generada de una tabla en especifico
     * @return array
     */
    function getLastId(){
            $query = "SELECT MAX(id) AS lastId FROM " . $this->table ;
            $result = $this->_SQL_tool($this->SELECT_SINGLE, __METHOD__, $query);
            return $result;
    }

    /**
     * Actualiza los datos indicados en $data de uno � varios registros dependiendo de
     * las condiciones que se coloquen en el segundo parametro ( $where )
     *
     * Ejemplo:
     *
     * ->update(array('nombres' => 'Manuel Aguirre'),'id_person = 3');
     *
     * @param array $data  datos a actualizar e forma de array
     * @param string $where  condicion que debe cumplir el update
     * @param boolean $modified parametro opcional para saber si existe un campo modified en la tabla
     * @return int
     *
     * @author Manuel Aguirre
     */
    public function update($data, $where, $modidied = true) {
    	$values = array();
    	foreach ($data as $field => $value) {
    		$value = mysql_real_escape_string($value);
    		$values[] = "$field = '$value'";
    	}
    	if ($modidied) {
    		$values[] = "modified = now()";
    	}
    	$values = join(', ', $values);
    	$query = "UPDATE {$this->table} SET {$values} WHERE {$where}";
    	return $this->_SQL_tool($this->UPDATE, __METHOD__, $query);
    }

    public function delete($where) {
    	$query = "DELETE FROM {$this->table} WHERE {$where}";
    	return $this->_SQL_tool($this->DELETE, __METHOD__, $query);
    }
}
