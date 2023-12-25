<?php 

class Users{
    private $sql_database = '';

    public function __construct()
    {
        $this->sql_database = new mysqli('localhost','root','','php_oop');

        if($this->sql_database->connect_error){
            die('Connection Failed...');
        }
    }

    // Show Data
    public function displayData(){
        $data = [];
        $display_sql = "SELECT * FROM user_data";
        $display_result = $this->sql_database->query($display_sql);

        $result = $display_result->fetch_all(MYSQLI_ASSOC);
        foreach($result as $row){
            $data[] = $row;
        }
      
       return $data;
    }

    // Insert into Database
    public function addData($name,$email){
        if($name == '' && $email = ''){
            echo "Insert all data";
        }else{
            $add_sql = "INSERT INTO user_data (user_name,user_email) VALUES ('$name','$email')";
            $result = $this->sql_database->query($add_sql);
    
            if($result){
                echo "Users added";
            }else{
                
                die('Query Failed');
            }
        }
     
    }

    // Edit User
    public function edit($edit_id){
        $sql_edit = "SELECT * FROM user_data WHERE id = $edit_id";
        $result_edit = $this->sql_database->query($sql_edit);

        $fetch_row = $result_edit->fetch_assoc();
        return $fetch_row;
    }

    public function update($id,$name,$email){
        $sql_update = "UPDATE user_data SET  user_name = '$name', user_email = '$email' WHERE id = $id";
        $update_result = $this->sql_database->query($sql_update);

        if($update_result){
            return true;
        }else{
            die('Query Failed');
        }
    }


    // Delete Data from Database
    public function deleteData($d_id){
        $sql_delete = "DELETE FROM user_data WHERE id = $d_id";
        $result_delete = $this->sql_database->query($sql_delete);

      
        return $result_delete;
    }



}





?>  