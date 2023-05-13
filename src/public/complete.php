<?php 
  $name = $_POST["name"];
  $food = $_POST["food"];
  $hobby = $_POST["hobby"];

  $errors  = [];
  if (empty($name) || empty($food) || empty($hobby)){
    $errors[] = '「回答者名」「好きな食べ物」「趣味」のどれかが記入されていません！';
  }

  $dbUserName = 'root';
  $dbPassword = 'password';
  $pdo = new PDO(
    'mysql:host=mysql; dbname=questionnaireform; charset=utf8',
    $dbUserName,
    $dbPassword
  );

  $stmt = $pdo->prepare("INSERT INTO questionnaire(
    name, food_awnser, hobby_awnser
  ) VALUES (
    :name, :food_awnser, :hobby_awnser
  )");

  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':food_awnser', $food, PDO::PARAM_STR);
  $stmt->bindParam(':hobby_awnser', $hobby, PDO::PARAM_STR);
  $res = $stmt->execute();
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
 
<body>
  <div>
    <?php if(!empty($errors)): ?>
      <?php foreach($errors as $error): ?>
        <p><?php echo $error . "\n"; ?></p>
      <?php endforeach; ?>
      <a href="index.php">アンケート画面へ</a>
    <?php endif; ?>  

    <?php if(empty($errors)): ?>
      <h2>アンケート完了</h2>
      <a href="index.php">アンケート画面へ</a><br><br>
    <?php endif; ?>   

  </div> 
</body>
    
</html>