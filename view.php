<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player's Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #5a5a9e;
        }

        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5a5a9e;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        img {
            display: block;
            margin: 0 auto;
            border-radius: 4px;
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            color: #5a5a9e;
            border: 1px solid #5a5a9e;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        a:hover {
            background-color: #5a5a9e;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Player's Data</h1>

    <?php
    // Koneksi ke database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "cruddatabase";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk mengambil data
    $sql = "SELECT * FROM datamahasiswa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>NIM</th><th>Majors</th><th>Email</th><th>id's photo</th><th>Button</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prodi']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td><img src='" . htmlspecialchars($row['gambar']) . "' alt='Gambar' style='width:50px; height:50px;'></td>";
            echo "<td>";
            echo "<button style='margin-right: 5px; background-color: green;'>Update</button>";
            echo "<button style='background-color: red;'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Tidak ada data ditemukan.</p>";
    }

    $conn->close();
    ?>
    <br> <br>
    <a href="index.php">kembali</a>
</body>

</html>