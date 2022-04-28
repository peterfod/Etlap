<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Törlés</title>
</head>

<body>
    <?php
    require 'config.php';
    $sql = "DELETE FROM etelek WHERE etelAz = '$_GET[eaz]'";
    if (mysqli_query($conn, $sql)) {
        $error = 'Sikeres törlés!';
    } else {
        $error = mysqli_error($conn);
    }
    if (isset($error)) {
        echo $error;
    }
    ?>
    <br><a href="index.php">Vissza</a>
</body>

</html>