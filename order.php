<?php

$order = [];

if ($_POST) {

    if ((isset($_POST["name"]) and !empty($_POST["name"]))
    and (isset($_POST["phone"]) and !empty($_POST["phone"]))
    and (isset($_POST["email"]) and !empty($_POST["email"]))
    and (isset($_POST["street"]) and !empty($_POST["street"]))
    and (isset($_POST["home"]) and !empty($_POST["home"]))
    and (isset($_POST["appt"]) and !empty($_POST["floor"]))
    and (isset($_POST["floor"]) and !empty($_POST["floor"]))) {
        $order["name"] = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $order["phone"] = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $order["email"] = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
        $order["street"] = filter_var($_POST["street"], FILTER_SANITIZE_STRING);
        $order["home"] = filter_var($_POST["home"], FILTER_SANITIZE_STRING);
        $order["part"] = filter_var($_POST["part"], FILTER_SANITIZE_STRING);
        $order["appt"] = filter_var($_POST["appt"], FILTER_SANITIZE_STRING);
        $order["floor"] = filter_var($_POST["floor"], FILTER_SANITIZE_STRING);
        $order["comment"] = filter_var($_POST["comment"], FILTER_SANITIZE_STRING);

        try {
            $pdo = new PDO("mysql:host=localhost;dbname=burger", "burger", "burger");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    //Authorization
        try {
            $sql = "INSERT INTO users VALUES(null,:name, :phone, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $order["name"],
                ':phone' => $order["phone"],
                ':email' => $order["email"]
            ]);
        } catch (Exception $e) {
            $_SESSION["authorized"] = true;
        }

    //Order
        try {
            $sql = "INSERT INTO orders VALUES(null, :street, :home, :part, :appt, :floor, :comment, (SELECT id FROM users WHERE email = :email))";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':street' => $order["street"],
                ':home' => $order["home"],
                ':part' => (int)$order["part"],
                ':appt' => $order["appt"],
                ':floor' => $order["floor"],
                ':comment' => $order["comment"],
                ':email' => $order["email"]
            ]);


        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!file_exists('orders')) {
            mkdir("orders");
        }

        $mailContent = "Заказ - заказ N " . $pdo->lastInsertId();
        $mailContent .= "\nВаш заказ будет доставлен по адресу: улица " . $order["street"];
        $mailContent .= " кв. " . $order['appt'];
        $mailContent .= "\nDarkBeefBurger за 500 рублей 1 шт\n";

        try {
            $sql = "SELECT count(*) FROM orders WHERE user_id = (SELECT id FROM users WHERE email = :email);";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $order["email"]]);
            $mailContent .= "Спасибо - это ваш " . $stmt->fetch(PDO::FETCH_NUM)[0] . " заказ\n";
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $currentDate = date("Y-m-d H:i:s");
        $mailContent .= $currentDate;
        file_put_contents("orders/order.txt", $mailContent);
        echo "Success";

   } else {
        exit('Fill out the order form');
   }
} else {
    header("HTTP/1.1 403 Forbidden");
    echo "Forbidden";
}