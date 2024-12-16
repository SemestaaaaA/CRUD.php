<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player's Input Data</title>
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

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="file"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #5a5a9e;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #494985;
        }

        table {
            width: 80%;
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
    <h1>Player's Input Data</h1>

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

    // Handle POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $conn->real_escape_string($_POST['name']);
        $npm = $conn->real_escape_string($_POST['npm']);
        $prodi = $conn->real_escape_string($_POST['prodi']);
        $email = $conn->real_escape_string($_POST['email']);

        // Proses upload gambar
        $foto = $_FILES['foto']['name'];
        $target_dir = "src/";
        $target_file = $target_dir . basename($foto);

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO datamahasiswa (nama, nim, prodi, email, gambar) VALUES ('$name', '$npm', '$prodi', '$email', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Data berhasil disimpan.</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Gagal mengupload foto.</p>";
        }
    }

    $conn->close();
    ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="npm">NIM:</label>
        <input type="text" id="npm" name="npm" required><br><br>

        <label for="prodi">Majors:</label>
        <input type="text" id="prodi" name="prodi" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="foto">Id's Photo:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required><br><br>

        <center><button type="submit">Submit</button></center>
    </form>
    <br><br>
    <a href="view.php">liat data</a>
</body>

</html>