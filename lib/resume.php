<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $fullname = trim($_POST['fullname'] ?? '');
    if(empty($fullname)) {
        $errors[] = "ФИО обязательно для заполнения";
    }

    $email = trim($_POST['email'] ?? '');
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный email";
    }

    $phone = trim($_POST['phone'] ?? '');
    if(!preg_match("/^\+?[0-9\s\-\(\)]{10,20}$/", $phone)) {
        $errors[] = "Неверный формат телефона";
    }

    $experience = trim($_POST['experience'] ?? '');
    if(empty($experience)) {
        $errors[] = "Опыт работы обязателен";
    }

    $skills = trim($_POST['skills'] ?? '');
    if(empty($skills)) {
        $errors[] = "Навыки обязательны";
    }

    $job = $_POST['job'] ?? '';
    if(empty($job)) {
        $errors[] = "Выберите вакансию";
    }

  
    $resume_file = $_FILES['resume_file'] ?? null;
    $uploadedFileName = null;
    
   
    if ($resume_file && $resume_file['error'] === UPLOAD_ERR_OK) {
       
        $uploadDir = 'uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileExtension = pathinfo($resume_file['name'], PATHINFO_EXTENSION);
        $uploadedFileName = uniqid() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $uploadedFileName;
        
        if (!move_uploaded_file($resume_file['tmp_name'], $uploadPath)) {
            $errors[] = "Ошибка при сохранении файла";
        }
    } elseif ($resume_file && $resume_file['error'] !== UPLOAD_ERR_NO_FILE) {
        
        $errors[] = "Ошибка загрузки файла (код ошибки: " . $resume_file['error'] . ")";
    }
    

   
    if(!empty($errors)) {
        foreach($errors as $err) {
            echo "<p style='color:red'>$err</p>";
        }
        exit;
    }

  
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=jobfan;port=8889', 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'INSERT INTO users(fullname, email, phone, experience, skills, resume_file, job) VALUES(?, ?, ?, ?, ?, ?, ?)';
        $query = $pdo->prepare($sql);
        $query->execute([$fullname, $email, $phone, $experience, $skills, $uploadedFileName, $job]);
        
        echo "<p style='color:green'>Данные успешно сохранены!</p>";
        header('Location: /');
        
    } catch (PDOException $e) {
        echo "<p style='color:red'>Ошибка базы данных: " . $e->getMessage() . "</p>";
    }
}


?>
