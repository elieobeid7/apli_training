<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Username</label>
   <input type="text" name="username">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Password</label>
    <input type="password" name="password" >
  </div>
  <button type="submit" id="btn" name="button">Sign Up</button>
</form>
</body>
</html>

<?php
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
    if(isset($_POST['button'])){
      
    

    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    


    $sql='Insert into signup(email,username,password) values(:email,:username,:pass)';
    $stmt =$pdo ->prepare($sql);
    $stmt ->execute(['email' =>$email,'username' =>$username, 'pass' =>$pass]);
    }
    ?>
