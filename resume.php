<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Резюме кадрового агентства</title>
    <link rel="stylesheet" href="/styles/resume.css">
</head>
<body>

    <?php require_once "blocks/header.php"; ?>

    <section>
        <div class="container4">
            <form  onsubmit="showMessage()" action="/lib/resume.php" method="post" id='myForm'  enctype="multipart/form-data">
                <label>Имя и Фамилия</label>
                <input type="text" name="fullname" placeholder="Иван Иванов" required>

                <label>Email</label>
                <input type="email" name="email" placeholder="ivan@example.com" required>

                    <label>Телефон</label>
                    <input type="tel" name="phone" placeholder="+7 (999) 123-45-67" required>

  
                    <label>Опыт работы</label>
                    <textarea name="experience" rows="4" placeholder="Опишите ваш опыт работы" required></textarea>


                    <label>Навыки</label>
                    <textarea name="skills" rows="3" placeholder="Перечислите навыки через запятую" required></textarea>


                    <label>Прикрепить файл резюме</label>
                    <input type="file" name="resume_file" accept=".pdf,.doc,.docx">


                    <label>Вакансия</label>
                    <select name="job" required>
                        <option value="" disabled selected hidden>Выберите вакансию</option>
                        <option value="men">Менеджер по подбору персонала</option>
                        <option value="Rec">Рекрутер</option>
                        <option value="IT">Специалист по подбору IT-специалистов</option>
                        <option value="HR-MEN">HR-менеджер</option>
                        <option value="VEDKAD">Ведущий специалист по кадрам</option>
                        <option value="hedhant">Хедхантер</option>
                        <option value="Mebwsois">Менеджер по работе с соискателями</option>
                        <option value="HR-MENMASPOD">HR-менеджер по массовому подбору</option>
                    </select>
                    <button type="submit" id='btn'>Отправить резюме</button>
                
        </form>
    </div>

    
</section>

<script>
    function showMessage() {
        alert("Резюме успешно отправлено!")
    }
</script>



<?php require_once "blocks/footer.php"; ?>

    
</body>
</html>

