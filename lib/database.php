<?php

class FDatabase {

    var $_resource;
    var $_response;
    var $_statement;
    var $_result;
    var $_sql;

    /**
     * Construct function to connect to Database
     * and assign the connection string to $_resource variable
     */
    function __construct() {
        $configObj = new FConfig();
        try {

            $this->_resource = new PDO("mysql:host=" . $configObj->dbHost . ";dbname=" . $configObj->dbName, $configObj->dbUser, $configObj->dbPwd);
            $this->_resource->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_response = 1;
        } catch (PDOException $e) {
          // die("<pre>".print_r($e, true)."</pre>");
            $this->_response = $e->getMessage();
        }
    }

    /**
     * Destructor function to disconnect the database.
     */
    function __destruct() {
        $this->_resource = null;
    }

    /**
     * Function to prepare a SQL statement
     */
    function prepare() {
        $this->_statement = $this->_resource->prepare($this->_sql);
    }

    /**
     * Function to bind the values to SQL Statement
     * @param $param
     * @param $value
     * @param null $type
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case
                is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->_statement->bindValue($param, $value, $type);
    }

    /**
     * Function to execute SQL statement
     * @return mixed
     */
    public function execute($dataArr = '') {
        if (!$this->_statement):
            $this->prepare();
        endif;
        if (is_array($dataArr)):
            $this->_result = $this->_statement->execute($dataArr);
        else:
            $this->_result = $this->_statement->execute();
        endif;
        return $this->_result;
    }

    /**
     * Function to begin Transaction for SQL
     */
    public function beginTrans() {
        $this->_resource->beginTransaction();
    }

    /**
     * Function to Commit the transaction
     */
    public function commitTrans() {
        $this->_resource->commit();
    }

    /**
     * Function to Roll Back the transaction
     */
    public function rollTrans() {
        $this->_resource->rollBack();
    }

    public function query($sql, $dataArr = '') {
        $this->_sql = $sql;
        $this->prepare();
        $this->execute($dataArr);
        return $this;
    }

    public function queryPaging($sql, $dataArr = '', $offset = 0, $limit = 0) {
        $this->_sql = $sql;
        $this->prepare();
        $this->execute($dataArr);
        define("TOTALREC", count($this->fetchObjList()));
        $offset = ($offset * $limit) - $limit;
        $this->_sql = $sql . " LIMIT $offset,$limit";
        $this->prepare();
        $this->execute($dataArr);
        return $this;
    }

    /**
     * Function used to fetch data from select statement in the form of an Array - Single Result
     * @return mixed
     */
    public function fetch() {
        return $this->_statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Function to fetch data from select statement in the form of an Array  - Multi Result
     * @return mixed
     */
    public function fetchList() {
        return $this->_statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Function used to fetch data from select statement in the form of an Object - Single Result
     * @return mixed
     */
    public function fetchObj() {
        return $this->_statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Function to fetch data from select statement in the form of an Object  - Multi Result
     * @return mixed
     */
    public function fetchObjList() {
        return $this->_statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Function to get Last Update/ Inserted PK
     * @return mixed
     */
    public function getLastInsID() {
        return $this->_resource->lastInsertId();
    }

    /**
     * Function to return total number of records
     * @return int
     */
    public function getNumRows() {
        return $this->_statement->rowCount();
    }

    /**
     * Function to print Query
     * @return string
     */
    public function printQuery() {
        return $this->_sql;
    }

}

?>
