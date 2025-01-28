<?php

session_start();


try {

    require '../phpmailer/PHPMailer.php';
    require '../phpmailer/SMTP.php';
    require '../phpmailer/Exception.php';

    function showError($message)
    {
        $_SESSION['error'] = $message;
        header('Location: ../');
    }

    function showMessage($message)
    {
        $_SESSION['message'] = $message;
        header('Location: ../');
    }

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $massage = trim($_POST['massage']);

    if (strlen($name) > 25 || empty($name)) {
        showError('Не правильно ввели имя!');
    }
    if (strlen($phone) > 12 || empty($phone)) {
        showError('Не правильно ввели телефон!');
    }
    if (strlen($massage) > 250 || empty($massage)) {
        showError('Не правильно ввели сообщение!');
    }

    $title = 'Сообщение с сайта!';
    $body = '<p>Имя: ' . $name . '</p>' .
        '<p>Телефон: ' . $phone . '</p>' .
        '<p>Сообщение: ' . $massage . ' человека.</p>';


    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.yandex.ru';
    $mail->Username = 'sservice18@yandex.ru';
    $mail->Password = 'nahtlcunpnkhwmda';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('sservice18@yandex.ru', $name);

    $mail->addAddress('sservice18@yandex.ru');

    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;

    if ($mail->send()) {
        showMessage('Сообщение успешно отправлено!');
    } else {
        showError('Ошибка при отправке сообщения. Попробуйте позже.');
    }


} catch (Exception $e) {
    showError('Ошибка сервера. Попробуйте позже.');
}

// для индекса

//session_start();
//if (isset($_SESSION['error'])) {
//    echo '<p class="form_error">' . $_SESSION['error'] .'</p>';
//    unset($_SESSION['error']);
//}
//if (isset($_SESSION['message'])) {
//    echo '<p class="form_message">' . $_SESSION['message'] .'</p>';
//    unset($_SESSION['message']);
//}