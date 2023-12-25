<?php 

include_once('database_connection.php');

//  Add data
 if(isset($_POST['action']) && $_POST['action'] == 'insert'){
    $test = new Users();
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $test->addData($name,$email);
 }

//  show data
$test = new Users();
 if(isset($_POST['action']) && $_POST['action'] == 'view'){
    $table = $test->displayData();
    $output = '';
    $output .= "<table class = 'table mt-5 table-striped table-border-less text-center'>
                    <thead class = 'table-primary '>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                            ";
        $output .= "<tbody >";
        $number = 1;
    if(count($table) > 0){
        foreach($table as $row){
            $output .= "
                            <tr>
                                <td>$number</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['user_email']}</td>
                                <td> 
                                 <a class='btn btn-danger delete_btn mx-2' id = '{$row['id']}'>Delete</a>
                                 <a class='btn btn-primary edit_btn' id ='{$row['id']}' data-bs-toggle = 'modal' data-bs-target = '#EditModal'>Edit</a>
                                </td>
                            </tr>
                        
                            ";
                            $number++;
        }
    $output .= "</tbody>";
    $output .= "</table>";

    }

    echo $output;
 }




//  Edit data

if(isset($_POST['edit_id'])){
    $ed_id = $_POST['edit_id'];
    $row = $test->edit($ed_id);
    echo json_encode($row);
}

if(isset($_POST['action']) && $_POST['action'] == 'update'){
    $id = $_POST['Ed_id'];
    $name = $_POST['ed_user_name'];
    $email = $_POST['ed_user_email'];
    $test->update($id,$name,$email);
}

if(isset($_POST['de_id'])){
    $dle_id = $_POST['de_id'];
    
    $test->deleteData($dle_id);
}


?>