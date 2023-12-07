<?php
require_once("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $course_id = $_POST["id"];
    $course_name = $_POST["coursename"];
    $year_section = $_POST["yrsec"];
    $action_taken = $_POST["acttaken"];
    $photo = $_FILES["photo"];

    saveDataToDatabase($name, $course_id, $course_name, $year_section, $action_taken, $photo);
}

$data = fetchDataFromDatabase();
$bsit_data = array_filter($data, function($row) {
    return $row['year_section'] === 'BSIT';
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Activity 5</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #0c0c0c, #222);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 10%;
        }

        .text-success {
            text-align: center;
        }

        .table {
            color: white;
        }

        .form-control {
            background: transparent;
            color: white;
            border: none;
            border-bottom: 2px solid #4287f5;
            border-radius: 0;
            padding: 15px 0;
            font-size: 18px;
        }

        .form-control::placeholder {
            color: #4287f5;
        }

        .btn-success,
        .btn-danger {
            border: none;
            border-radius: 5px;
            padding: 10px 20px; 
            font-size: 18px;
            cursor: pointer;
        }

        .btn-success {
            background: #02b875;
        }

        .btn-success:hover {
            background: #02855b;
        }

        .btn-danger {
            background: #b80202;
        }

        .btn-danger:hover {
            background: #870202;
        }

        .form-group {
            text-align: center;
        }

        .circular-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .navbar-nav li.nav-item:hover {
            background-color: #0c0c0c;
        }

        .navbar-nav li.nav-item:hover > .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a:hover {
            background-color: #4287f5;
        }
        
        .navbar {
            background-color: #0c0c0c;
        }

        .navbar-brand, .nav-link {
            color: #4287f5;
        }

        .navbar-toggler {
            border-color: #4287f5;
        }

        .navbar-nav li.nav-item:hover .dropdown-menu {
            display: block;
        }

        .nav-item:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    </style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0c0c0c;">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="history.php">History of BASC</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Courses
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="bsittable.php">BSIT</a>
                                <a class="dropdown-item" href="bsfttable.php">BSFT</a>
                                <a class="dropdown-item" href="bsgetable.php">BSGE</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
    <div class="container mt-4">
        <h1 class="text-center text-primary">BSIT Students</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Course</th>
                        <th>Action Taken</th>
                        <th>Photo</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody id="table1-body">
                <?php
                    foreach ($bsit_data as $row) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['course_id']}</td>";
                        echo "<td>{$row['course_name']}</td>";
                        echo "<td>{$row['year_section']}</td>";
                        echo "<td>{$row['action_taken']}</td>";
                        echo "<td><img src='{$row['photo']}' class='circular-image' alt='Student Photo'></td>";
                        echo "<td>
                                <a href='edit.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this entry?\");'>Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
