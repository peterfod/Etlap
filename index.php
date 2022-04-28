<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Étlap</title>
    <style>
         label,
        select,
        input,
        a {
            margin-right: 15px;
        }

        table {
            margin-top: 25px;
        }

        td,
        th {
            width: 150px;
            text-align: center;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Étlap</h1>
    <?php
    include 'config.php';
    $password = 'a';
    session_start();
    unset($_SESSION['error']);

    if (isset($_POST["password"]) && $_POST["password"] == $password) {
        $_SESSION['role'] = 'admin';
    }

    $sqlKat = "SELECT * FROM kategoriak";
    $kat = mysqli_query($conn, $sqlKat);
    echo '<form id="etelForm" method="post">';
    echo '<label for="kategoriák">Kategóriák:</label>';
    echo '<select onchange="this.form.submit()" name="kategoriak" id="kategoriak">';
    echo '<option value="%">Válasszon..</option>';
    echo '<option value="%">Összes kategória</option>';
    while ($rowKat = mysqli_fetch_assoc($kat)) {
        echo '<option value=' . $rowKat['katAz'] . '>' . $rowKat['katNev'] . '</option>';
    }
    echo '</select>';
    echo '<label for="password">Adminisztrátor jelszó:</label>';
    echo '<input type="password" size="6" name="password" id="password">';
    if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
        echo '<a href="logout.php">Kilépés</a>';
        echo '<a href="modify.php?eaz=0">Új étel felvitele</a>';
    } else {
        echo '<input type="submit" value="Belépés" name="button">';
    }
    echo '</form>';

    if (!isset($_POST["kategoriak"])) {
        $sql = "SELECT k.katNev, e.etelAz, e.etelNev, e.ar FROM etelek e INNER JOIN kategoriak k ON e.katAz = k.katAz
                ORDER BY k.katAz";
    } else {
        $katAz =  mysqli_real_escape_string($conn, $_POST['kategoriak']);
        $sql = "SELECT k.katNev, e.etelAz, e.etelNev, e.ar FROM etelek e INNER JOIN kategoriak k ON e.katAz = k.katAz
                                WHERE k.katAz LIKE '$katAz'
                                ORDER BY k.katAz";
    }
    $result = mysqli_query($conn, $sql);
    if (!empty($result)) {
        echo '<table>
               <tr>
                <th>Kategória</th>
                <th>Név</th>
                <th>Ár</th>';
        if (isset($_SESSION['role']) && $_SESSION["role"] == "admin") {
            echo '<th>Módosítás</th>';
            echo '<th>Törlés</th>';
        }
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
                  <tr>
                    <td>' . $row["katNev"] . '</td>
                    <td>' . $row["etelNev"] . '</td>
                    <td>' . $row["ar"] . ' Ft</td>';
            if (isset($_SESSION['role']) && $_SESSION["role"] == "admin") {
                echo '<th><a href="modify.php?eaz=' . $row["etelAz"] . '">Módosít</a></th>';
                echo '<th><a href="delete.php?eaz=' . $row["etelAz"] . '">Töröl</a></th>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
</body>

</html>