<?php

class sql
 {
  public $connection = '';
  function __constructor()
  {
    session_start();
  }
  public function Connect()
  {
    define('USER', 'o92644i4_kdp');
    define('PASSWORD', 'ABOBuS1');
    define('HOST', 'localhost');
    define('DATABASE', 'o92644i4_kdp');
    try {
        $this -> connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
  }
  public function Auth()
  {
    
    include('Connect.php');
    if (isset($_POST['login'])) 
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $query = $connection->prepare("SELECT * FROM log/pswd WHERE username=:login");
      $query->bindParam("username", $username, PDO::PARAM_STR);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
          echo '<p class="error">Неверные пароль или имя пользователя!</p>';
      } else {
          if (password_verify($password, $result['password'])) {
              $_SESSION['user_id'] = $result['id'];
              echo '<p class="success">Поздравляем, вы прошли авторизацию!</p>';
          } else 
          {
              echo '<p class="error"> Неверные пароль или имя пользователя!</p>';
          }
      }
    }  
  } 
}
?>