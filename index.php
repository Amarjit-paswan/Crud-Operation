

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation Using Ajax Bootstrap OOP And JQuery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        .alert1{
            gap: 20px;
        }
    </style>
</head>
<body class="bg-info">
    <!-- Adduser modal starts here -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h4 class="text-center">Add Details</h4>
                    </div>
                        <button type="button" class="btn-close" data-bs-dismiss = 'modal'></button>
                </div>

                <div class="modal-body">
                    <form action="" id="myForm" autocomplete="off">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="user_name" id="u_name" class="form-control" placeholder="Enter Your Name...">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="user_email" id="u_email" class="form-control" placeholder="Enter Your Email...">
                        </div>

                        <input type="submit" class="btn btn-primary float-end" id="add_btn" name="submit" value="Add"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Adduser modal end here -->

        <!-- Edit_user modal starts here -->
        <div class="modal fade" id="EditModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h4 class="text-center">Edit Details</h4>
                    </div>
                        <button type="button" class="btn-close" data-bs-dismiss = 'modal'></button>
                </div>

                <div class="modal-body">
                    <form action="" id="EditForm" autocomplete="off">
                        <input type="hidden" name="Ed_id" id="ed_id">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="ed_user_name" id="ed_name" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="ed_user_email" id="ed_email" class="form-control" >
                        </div>

                        <input type="submit" class="btn btn-primary float-end" id="update" name="update_submit" value="Update"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Edit_user modal end here -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">
            <div class="col-6 p-3 border bg-white">
                <div class="col-12">
                    <h1 class="text-center alert alert-primary">CRUD Operation</h1>
                </div>
                  

                <div class="col-12">
                    <button class="btn btn-success float-end" data-bs-target='#myModal' data-bs-toggle = 'modal' >Add Account</button>
                </div>

                <!-- <div class="alert alert-success">
                     A simple success alert—check it out!
                </div> -->

                <div class="display p-2 ">

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.alert1').hide(); 
            // show data on website
            showData();
            function showData(){
                $.ajax({
                    url:'action.php',
                    type:'POST',
                    data: {action : 'view'},
                    success: function(res){
                        $('.display').html(res);
                    }
                })
            }

            // insert data to server
            addUser();
            function addUser(){
            $('#add_btn').click(function(e){
             e.preventDefault();
              var name =  $('#u_name').val();
              var email = $('#u_email').val();
              if(name === '' && email === ''){
                alert('All Flelds are require');
              }else{
             $.ajax({
                url:'action.php',
                type:'POST',
                data:$('#myForm').serialize() + "&action=insert",
                success:function(res){
                    $('#myModal').modal('hide');

                    $('#myForm').trigger('reset');
                    showData();
                   
                     $('.display').html(res);
                    //  $('.modal').hide();
                    console.log(res);
                 }
                  })
                     }
                      })
                        }


            // Edit function
            $('body').on('click','.edit_btn',function(e){
                e.preventDefault();
                let edit_id = $(this).attr('id');
                // console.log(edit_id);

                $.ajax({
                    url:'action.php',
                    type:'POST',
                    data:{edit_id:edit_id},
                    success:function(res){
                        let json = JSON.parse(res);
                        $('#ed_id').val(json.id);
                        $('#ed_name').val(json.user_name);
                        $('#ed_email').val(json.user_email);
                    }
                })
            })

            // update function

            function updateData(){
                $('#update').click(function(e){
                    e.preventDefault();
                    let id = $('#ed_id').val();
                    $.ajax({
                        url:'action.php',
                        type:'POST',
                        data: $('#EditForm').serialize()+'&action=update',
                        success:function(res){
                            showData();
                            $('#EditForm').trigger('reset');
                            $('#EditModal').modal('hide');
                            
                        }
                        
                    })
                })
            }

            updateData();

            // Delete function
            function deleteData(){
                $('body').on('click','.delete_btn',function(e){
                    e.preventDefault();
                    var de_id = $(this).attr('id');
                    console.log(de_id);

                    $.ajax({
                        url:'action.php',
                        type:'POST',
                        data:{de_id:de_id},
                        success:function(res){
                            showData();
                        }
                    })
                })
            }

            deleteData();

            
                
                
          
         })
    </script>
</body>
</html>