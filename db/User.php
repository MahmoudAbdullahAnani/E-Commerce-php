<?php
include "./db/env.php";
class User
{
    // Var Conected
    public $conection;
    // Var Select
    public $sqlSelect = 'SELECT ';
    public $sqlWhere = 'WHERE';
    public $data;
    // Var Insert
    public $sqlInsert = "INSERT INTO";
    public $resultInsert;
    // Conected DataBase
    public function __construct()
    {
        $this->conection = mysqli_connect(SERVER,USER,PASS,DBNAME);
    }
    // Start Select
    public function select($col, $talbe){
        $this->sqlSelect .="$col FROM `$talbe`";
        return $this;
    }
    public function where($col, $mark,$val){
        $this->sqlSelect .=" $this->sqlWhere `$col` $mark '$val'";
        return $this;
    }
    public function andWhere($col, $mark,$val){
        $this->sqlSelect .=" AND `$col` $mark '$val'";
        return $this;
    }
    public function orWhere($col, $mark,$val){
        $this->sqlSelect .=" OR `$col` $mark '$val'";
        return $this;
    }
    public function print(){
            $q = mysqli_query($this->conection,$this->sqlSelect);
            $data=[];
            while ($row = mysqli_fetch_assoc($q)) {
                $data[]=$row;
            }
            return $data;
    }
    // End Select
    // Start Insert
    public function insert($table, $Full_Name, $Age, $Date, $Password, $Date_Create_Accont, $User_Name,$gmail){
        mysqli_query($this->conection,"$this->sqlInsert `$table` (`Full_Name`, `Age`, `Date`, `Password`, `Date_Create_Accont`, `User_Name`, `gmail`) VALUES ('$Full_Name','$Age','$Date','$Password','$Date_Create_Accont','$User_Name', '$gmail')");
        $isInsert = mysqli_affected_rows($this->conection);
        if ($isInsert===1) {
            $this->resultInsert='successful';
        }else {
            $this->resultInsert='Unsuccessful';
        }
        return $this->resultInsert;
    }
}
