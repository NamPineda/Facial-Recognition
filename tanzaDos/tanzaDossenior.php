<?php
require '../includes/encryption_functions.php';
require '../includes/dbconfig.php';
$sql = "SELECT * FROM seniordb WHERE barangay = 'Tangos'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Tanza Dos</title>
    <link rel="stylesheet" href="../style/bgyStyle.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/0c1d2e938f.js" crossorigin="anonymous"></script></script>
</head>
<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Barangay Tanza Dos</header>
        <ul>
            <li><a href="#">Graphs</a></li>
            <li><a href="../tanzaDos/tanzaDospwd.php">PWDs</a></li>
            <li><a href="../tanzaDos/tanzaDossenior.php">Senior Citizens</a></li>
            <li><a href="../tanzaDos/tanzaDossp.php">Solo Parents</a></li>
        </ul>
        <ul>
            <li><a href="#">Log Out</a></li>
        </ul>
    </div>
    <div class="container">
    <div class="jumbotron">
        <h1>Senior Citizens' Information</h1>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id Number</th>
                <th>firstname</th>
                <th>middle name</th>
                <th>surname</th>
                <th>suffix</th>
                <th>address</th>
                <th>barangay</th>
                <th>date of birth</th>
                <th>age</th>
                <th>sex</th>
                <th>date id issued</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $decryptedName = decryptthis($row['idNumber'], $key);
                    $decryptedEmail = decryptthis($row['firstName'], $key);
                    $decryptedmiddleName = decryptthis($row['middleName'], $key);
                    $decryptedsurname = decryptthis($row['surname'], $key);
                    $decryptedsuffix = decryptthis($row['suffix'], $key);
                    $decryptedaddress= decryptthis($row['address'], $key);
                    $decryptedbarangay= decryptthis($row['barangay'], $key);
                    $decrypteddob = decryptthis($row['dob'], $key);
                    $decryptedage = decryptthis($row['age'], $key);
                    $decryptedsex = decryptthis($row['sex'], $key);
                    $decrypteddateIdissue = decryptthis($row['dateIdissue'], $key);
                    echo "<tr>
                            <td>" . htmlspecialchars($decryptedName) . "</td>
                            <td>" . htmlspecialchars($decryptedEmail) . "</td>
                            <td>" . htmlspecialchars($decryptedmiddleName) . "</td>
                            <td>" . htmlspecialchars($decryptedsurname) . "</td>
                            <td>" . htmlspecialchars($decryptedsuffix) . "</td>
                            <td>" . htmlspecialchars($decryptedaddress) . "</td>
                            <td>" . htmlspecialchars($decryptedbarangay) . "</td>
                            <td>" . htmlspecialchars($decrypteddob) . "</td>
                            <td>" . htmlspecialchars($decryptedage) . "</td>
                            <td>" . htmlspecialchars($decryptedsex) . "</td>
                            <td>" . htmlspecialchars($decrypteddateIdissue) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No results found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>