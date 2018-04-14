<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 11-Jan-18
 * Time: 8:30 PM
 */


/**
 * Created by PhpStorm.
 * User: PC
 * Date: 28-Dec-17
 * Time: 8:00 PM
 */

class models
{
    protected $connect;
    protected $database;
    protected $table;
    protected $resultQuery;

    public function __construct($param = null)
    {
        if($param == null){
            $param['host']     = DS_HOST;
            $param['name']     = DS_NAME;
            $param['password'] = DS_PASS;
            $param['database'] = DS_DATABASE;
            $param['table']    = DS_TABLE;
        }

        $link = mysqli_connect($param['host'], $param['name'], $param['password']);
        if (!$link) {
            die('Fail' . mysqli_error($link));
        } else {
            $this->connect = $link;
            $this->database = $param['database'];
            $this->table = $param['table'];
            $this->setDatabase();
        }
    }

    public function setDatabase($database = null)
    {
        if ($database != null) {
            $this->database = $database;
        }
        mysqli_select_db($this->connect, $this->database);
        mysqli_set_charset($this->connect,"utf8");
    }

    public function setTable($value)
    {
        $this->table = $value;
    }

    public function setInsert($value, $type = 'simple')
    {
        if ($type == 'simple') {
           $newQuery = $this->insertTable($value);
          $query = "INSERT INTO `$this->table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
           $this->query($query);
        } else {
            foreach ($value as $vals) {
                $newQuery = $this->insertTable($vals);
                $query = "INSERT INTO `$this->table`(" . $newQuery['cols'] . ") VALUES (" . $newQuery['vals'] . ")";
                $this->query($query);
            }
        }
    }

    // XỬ LÝ HÀM INSERT TABLE
    public function insertTable($data)
    {
        $newQuery = array();
        if (!empty($data)) {
            $cols = '';
            $vals = '';
            foreach ($data as $key => $value) {
                $cols .= ", `$key`";
                $vals .= ", '$value'";
            }
            $newQuery['cols'] = substr($cols, 2);
            $newQuery['vals'] = substr($vals, 2);
        }
        return $newQuery;
    }
    // truy vấn

    public function showAffectedRow()
    {
        return mysqli_affected_rows($this->connect);
    }

    public function Update($data,$where)
    {
        $newQuery =  $this->setUpdate($data);
        $newWhere =  $this->createWhereUpdateSQL($where);
//        UPDATE `group` SET `name` = 'oc cho',`status` = '2' WHERE `id` = '2'
        $query = "UPDATE `$this->table` SET $newQuery WHERE $newWhere";

        $this->query($query);
        return $this->showAffectedRow();

    }

    public function UpdateElement($data,$id)
    {
        $newQuery =  $this->setUpdate($data);
         $query = "UPDATE `$this->table` SET $newQuery WHERE `id`= '$id'";
        $this->query($query);

    }


    public function setWhereDelete($data)
    {
        $newQuery = '';
        if(!empty($data))
        {
            foreach ($data as $key => $value)
            {
                $newQuery .= "'$value'". ",";
            }
            $newQuery .= "'0'";
        }
        return $newQuery;
    }

    public function delete($data)
    {
        $newQuery = $this->setWhereDelete($data);

        $query    = "DELETE FROM `$this->table` WHERE `id` IN ($newQuery)";
        $this->query($query);
        return $this->showAffectedRow();
    }


    public function query($query){
        $this->resultQuery = mysqli_query($this->connect, $query);
        return $this->resultQuery;
    }

    public function setUpdate($data)
    {
        if(!empty($data))
        {   $newQuery = '';
            foreach ($data as $key => $value) {
                $newQuery .= ", `$key` = '$value'";
            }
            $newQuery = substr($newQuery, 2);
            return $newQuery;
        }
    }

    public function createWhereUpdateSQL($data){
        if(!empty($data)){
            $newWhere = array();
            foreach($data as  $value){
                $newWhere[] = "`$value[0]` = '$value[1]'";
                $newWhere[] = $value[2];
            }
            $newWhere = implode(" ",$newWhere);
        }
        return $newWhere;
    }

    // create group
    public function fetchQuery($query){
        $result = array();
        if(!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
                while ($row = mysqli_fetch_assoc($resultQuery)) {
                    $result[$row['id']] = $row['name'];
                }
            }
            mysqli_free_result($resultQuery);
        }
       return $result;
    }

    public function showSelect($query)
    {
        $result = array();
        if (!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
                while ($row = mysqli_fetch_assoc($resultQuery)) {
                    $result[] = $row;
                }
                mysqli_free_result($resultQuery);
            }
        }
        return $result;
    }

    public function showSelects($query)
    {
        $result = array();
        if (!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
               $result = mysqli_fetch_all($resultQuery);
            }
        }
        return $result;
    }


    public function countItemtotal($query)
    {
        if (!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
                $result = mysqli_fetch_assoc($resultQuery);
            }
        }
        return $result['total'];
    }

    public function singleRecord($query){
        $result = array();
        if(!empty($query))
        {
            $resultQuery = $this->query($query);
            if(mysqli_num_rows($resultQuery) > 0){
                $result = mysqli_fetch_assoc($resultQuery);
            }
            mysqli_free_result($resultQuery);
            return $result;
        }

    }

    function isExist($query)
    {
        if(!empty($query))
        {
            $this->resultQuery = $this->query($query);
        }
        if(mysqli_num_rows($this->resultQuery))
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysqli_close($this->connect);
    }

}
