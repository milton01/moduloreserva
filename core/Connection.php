<?php

 /**
 * @author 
 * @copyright 
 */

class Connection extends MySQLi{
    private $dbhost = 'localhost';	
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'decameron';
    //private $dbport = '8080';
    
    public function __construct(){
		parent::__construct($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        
		if($this->connect_error){
			die($this->error_mysql('Connect Error', $this->connect_error, $this->connect_errno));
		}
		session_start();
		session_name('session');
	}
    
    public function selquery($query){
		$rs = $this->query($query) or die($this->error_mysql($query, $this->error, $this->errno));
		$this->x_rows = $rs->num_rows;
		$rows=array();
		while($row = $rs->fetch_assoc()){
			$rows[] = $row;
		}
		$rs->free();
		return $rows;
	}
    
    public function insquery($query){
		$rs=$this->query($query) or die($this->error_mysql($query, $this->error, $this->errno));
		$this->x_ins=$this->insert_id;
		return $this->x_ins;
	}
    
    public function updquery($query){
		$rs=$this->query($query) or die($this->error_mysql($query, $this->error, $this->errno));
		$this->x_upd=$this->affected_rows;
		return $this->x_upd;
	}
    
    public function delquery($query){
		$rs=$this->query($query) or die($this->error_mysql($query, $this->error, $this->errno));
		$this->x_del=$this->affected_rows;
		return $this->x_del;
	}
    
    public function seldato($query){
		$rs = $this->query($query) or die($this->error_mysql($query, $this->error, $this->errno));
		$this->x_rows = $rs->num_rows;
        $rows = '';
		while($row = $rs->fetch_array()){
			$rows = $row[0];
		}
		$rs->free();
		return $rows;
	}
	
	public function error_mysql($query, $error, $type){
		if($_SESSION['datos_usuario']['usuario_id'] == 1){
			echo '<font style="font-size:12px; font-family:Arial;"><b>Query:</b> '.$query.'<br><br><b>Error:</b> '.$error.'<br><br><b>C&oacute;digo error:</b> '.$type.'</font>';
		}
	}
}

?>