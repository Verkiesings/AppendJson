<?php 
   $success = '';
   $error = '';
   
   if (isset($_POST["submit"])){
   
     if( empty($_POST["name"]) || empty($_POST["surname"])){
       $error = "<script> swal(
         'Please ensure that the form is filled',
         'Kindly check!!',
         'error'
       ) </script>";
       
     }else {
       if(file_exists('users.json')) {
           $current_data = file_get_contents('users.json');
           $array_data = json_decode($current_data, true);
           $extra = array(
             'name' => $_POST['name'],
             'surname' => $_POST["surname"]
           );
           $array_data[] = $extra;
           $final_data = json_encode($array_data);
           if (file_put_contents('users.json', $final_data)) {
             
             $success = "<script> swal(
               'Awesome',
               'User has been appended to a JSON file',
               'success'
             ) </script>";
             header("Refresh: 2; url=index.php");
           }
          
       } else {
         $error = 'JSON file does not exist';
       }
  
     }
  
   }

   ?>
<html>
   <head>
      <title>Push Json</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   </head>
   <body>
      <br /><br />
      <div class="container">
        <h2>PHP apppend data to a Json file</h2>
        <div class="panel panel-success">
        <div class="panel-body">Use the below for to append</div>
        </div>
         <form method="post" autocomplete="off">
            <?php
               if (isset($error)){
                 echo $error;
               }  
               ?>
            <div class="form-group">
               <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
               <input type="text" name="surname" class="form-control" id="surname" placeholder="Surname">
            </div>
            <?php 
               if (isset($success)){
                 echo $success;
               }
               ?>
            <br />
            <button type="submit" name="submit" class="btn btn-primary">Insert</button>
         </form>
      </div>
   </body>
</html>