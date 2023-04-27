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
        // echo "$this->sqlInsert `$table` (`Full_Name`, `Age`, `Date`, `Password`, `Date_Create_Accont`, `User_Name`, `gmail`) VALUES ('$Full_Name','$Age','$Date','$Password','$Date_Create_Accont','$User_Name', '$gmail')";die;
        mysqli_query($this->conection,"$this->sqlInsert `$table` (`Full_Name`, `Age`, `Date`, `Password`, `Date_Create_Accont`, `User_Name`, `gmail`) VALUES ('$Full_Name','$Age','$Date','$Password','$Date_Create_Accont','$User_Name', '$gmail')");
        $isInsert = mysqli_affected_rows($this->conection);
        if ($isInsert===1) {
            $this->resultInsert='successful';
        }else {
            $this->resultInsert='Unsuccessful';
        }
        return $this->resultInsert;
    }
    public function insertProduct($table, $title, $price, $photoFile,$photoSize,$full_path,$tmp_name, $discount, $description){
        mysqli_query($this->conection,"$this->sqlInsert `$table` (`title`, `price`, `photo`,`photoSize`,`full_path`,`tmp_name`, `discount`, `description`) VALUES ('$title','$price','$photoFile','$photoSize','$full_path','$tmp_name','$discount','$description')");
        $isInsert = mysqli_affected_rows($this->conection);
        if ($isInsert===1) {
            $this->resultInsert='successful';
        }else {
            $this->resultInsert='Unsuccessful';
        }
        return $this->resultInsert;
    }
    public function delete($id){
        mysqli_query($this->conection,"DELETE FROM `product` WHERE `Id`= $id");
        return $this;
    }

    // update
    public function update($table,$title,$price,$photo,$discount,$description,$photoSize,$full_path,$tmp_name,$id){
        mysqli_query($this->conection,"UPDATE `$table` SET `title`='$title',`price`='$price',`photo`='$photo',`discount`='$discount',`description`='$description',`photoSize`='$photoSize',`full_path`='$full_path',`tmp_name`='$tmp_name' WHERE `Id` = $id");
        return $this;
    }
    // update users
    // UPDATE `user` SET `Full_Name`='[value-2]',`Age`='[value-3]',`Date`='[value-4]',`Password`='[value-5]',`Date_Create_Accont`='[value-6]',`User_Name`='[value-7]',`gmail`='[value-8]' WHERE 1
    public function updateUser($table,$full_name,$age,$date,$gmail,$User_Name,$Password,$id){
        // echo "UPDATE `$table` SET `Full_Name`='$full_name',`Age`='$age',`Date`='$date',`Password`='$Password',`User_Name`='$User_Name',`gmail`='$gmail' WHERE `Id` = $id";die;
        mysqli_query($this->conection,"UPDATE `$table` SET `Full_Name`='$full_name',`Age`='$age',`Date`='$date',`Password`='$Password',`User_Name`='$User_Name',`gmail`='$gmail' WHERE `Id` = $id");
        return $this;
    }
}
