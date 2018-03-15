<?php

    $settings = array(
      'host'=>'localhost',
      'port'=>'3306',
      'name'=>'streamuxcom',
      'username'=>'root',
      'password'=>'root',
      'charset'=>'utf8'
    );

    try {

      $pdo = new PDO(
        sprintf(
          'mysql:host=%s;dbname=%s;port=%s;charset=%s',
          $settings['host'],
          $settings['name'],
          $settings['port'],
          $settings['charset']
        ),
        $settings['username'],
        $settings['password'] 
      );

    } catch( PDOException $e ) {
      
      die('Cannot connect to DB');
    }

    $sql = 'SELECT * FROM sux_member WHERE id = :id';
    $statement = $pdo->prepare($sql);

    //$id = filter_input(INPUT_GET, 'id');
    $id = $_GET['id'];

    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    while (($result = $statement->fetch(PDO::FETCH_ASSOC)) !== false) {
      echo $result['nickname'] . "<br>";
    }
?>