<?php
require_once("functions.php");

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $entry = getEntryFromDatabase($id);

    if ($entry) {
        $name = $entry['name'];
        $course_id = $entry['course_id'];
        $course_name = $entry['course_name'];
        $year_section = $entry['year_section'];
        $action_taken = $entry['action_taken'];
        $photo = $entry['photo'];
    } else {
        echo "Entry not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #0c0c0c, #222);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .circular-image {
            width: 200px;
            height: 200px;
            border-radius: 150%;
            object-fit: cover;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 50%;
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
</head>
</head>
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
        <h1 class="text-center display-4 text-success">Student Information</h1>
        <div class="row">
            <div class="card">
                <div style="text-align: center;">
                    <img src="<?php echo $photo; ?>" alt="User Image" class="circular-image">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $name; ?></h5>
                    <p>Course ID: <?php echo $course_id; ?></p>
                    <p>Course Name: <?php echo $course_name; ?></p>
                    <p>Year & Section: <?php echo $year_section; ?></p>
                    <p>Action Taken: <?php echo $action_taken; ?></p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
