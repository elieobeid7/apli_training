<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
  
</head>
<body>

<form class="dropdown-menu p-4" method="post">
  <div class="form-group">
    <label for="exampleDropdownFormEmail2">Username</label>
    <input type="text" class="form-control" name="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="exampleDropdownFormPassword2">Password</label>
    <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
  </div>
  <div class="form-group">
    
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="submit_btn">Sign in</button>
 
  <a href="signup.php">Sign up</a>
</form>
</body>
</html>

<?php
session_start();
    $host ='localhost';
    $user ='root';
    $password ='123456';
    $dbname ='signup_form';

// Set DSN
    $dsn = 'mysql:host=' .$host .';dbname=' .$dbname;

// Create a pdo instance
    $pdo = new PDO($dsn, $user, $password);
?>

    <?php
    if(isset($_POST['submit_btn'])){
      
        if($_POST['username'] == "" || $_POST['password'] == "")
        {
            header("location:index.php?Empty= please fill in the blanks");
            
        }
        else {
            $username = $_POST['username'];
            $pass = $_POST['password'];

    
        $sql ='SELECT * FROM signup where username = :username && password = :pass ';   
        $stmt =$pdo->prepare($sql);
        $stmt -> execute(['username'=>$username , 'pass' => $pass]);                     
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach($users as $user_table)
        {
            $_SESSION['User'] = $_POST['username'];
            header("location:curl.php"); 
            
        }
        if(empty($user_table))
            {
            header("location:index.php?Invalid= please enter valid username and password");

            }
        }
             
     }

    
    
    
    ?>