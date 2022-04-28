<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>
    <style>
        #container {
            margin: 20px;
        }

        input,
        select {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div id="container">
        <?php
        require 'config.php';
        session_start();
        $sql = "SELECT * FROM etelek WHERE etelAz = {$_GET['eaz']}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $sqlKat = "SELECT * FROM kategoriak";
        $kategoriak = mysqli_query($conn, $sqlKat);
        echo '<form method="post" novalidate>
              <label for="katAz">Kategória:</label>
              <select name="katAz" id="kategoria">';
        while ($kat = mysqli_fetch_assoc($kategoriak)) {
            if ($kat['katAz'] == $row['katAz']) {
                echo '<option value=' . $kat['katAz'] . ' selected>' . $kat['katNev'] . '</option>';
            } else {
                echo '<option value=' . $kat['katAz'] . '>' . $kat['katNev'] . '</option>';
            }
        }
        echo '</select>';
        if ($_GET['eaz'] == 0) {
            echo '<label for="nev">Név:</label>
                  <input type="text" name="etelNev">
                  <label for="ar">Ár:</label>
                  <input type="text" name="ar">
                  <input type="submit" name="button" value="Hozzáadás">';
        } else {
            echo '<label for="nev">Név:</label>
                  <input type="text" name="etelNev" value="' . $row["etelNev"] . '">
                  <label for="ar">Ár:</label>
                  <input type="text" name="ar" value="' . $row['ar'] . '">
                  <input type="submit" name="button" value="Módosítás">';
        }
        echo '</form>
              <a href="index.php">Vissza</a>';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $etelNev =  mysqli_real_escape_string($conn, $_POST['etelNev']);
            $ar =  mysqli_real_escape_string($conn, $_POST['ar']);
            $katAz =  mysqli_real_escape_string($conn, $_POST['katAz']);

            switch ($_POST['button']) {
                case 'Hozzáadás':
                    $sql = "INSERT INTO etelek (etelNev, ar, katAz) VALUES ('$etelNev', '$ar', '$katAz')";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['error'] = 'Sikeres hozzáadás!';
                    } else {
                        $_SESSION['error'] = mysqli_error($conn);
                    }
                    break;
                case 'Módosítás':
                    $sql = "UPDATE etelek SET etelNev = '$etelNev', ar = '$ar', katAz = '$katAz' WHERE etelAz = '$_GET[eaz]'";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['error'] = 'Sikeres módosítás!';
                    } else {
                        $_SESSION['error'] = mysqli_error($conn);
                    }
                    break;
            }
            header("location: modify.php?eaz={$_GET['eaz']}");
        }
        if (isset($_SESSION['error'])) {
            echo '<br>' . $_SESSION['error'];
        }
        ?>

    </div>
</body>

</html>