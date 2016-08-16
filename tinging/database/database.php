<?php
/*
* Mysql database class - only one connection alowed
*/
class Database 
{
	private $_connection;
	private static $_instance; //The single instance
	private $_host = "dagogtid.com.mysql";
	private $_username = "dagogtid_com";
	private $_password = "ABcmXkhw";
	private $_database = "dagogtid_com";
	private $result;
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) 
		{ // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() 
	{
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}
	
	public function __destruct() 
	{
		$this->_connection->close();
	}
	
	function insert($database , $data)//fungsi insert
	{
		$row = array();
		$nilai = array();
		foreach ( $data as $kolom =>$value )
		{
			$row[] = $kolom;
			$nilai[] = "'".$value."'";
		}
	
		$this->result = $this->_connection->query("INSERT INTO ". $database ."(". implode(',' ,$row) .")
                    VALUES (". implode(',' , $nilai) .")");
		if ($this->result === TRUE) {
			$this->result = $this->_connection->insert_id;
		}
		return $this->result;
	}
	
	function update($table , $data , $where)//fungsi update
	{
		foreach ( $data as $kolom => $row )
		{
			$set[]= $kolom."='".$row."'" ;
		}
		$set = implode(',',$set);
		$query = "UPDATE ".$table." SET ".$set." WHERE ".$where ;
		$this->_connection->query($query);
	}
	
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}
?>