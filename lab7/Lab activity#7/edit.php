<?php
$name = "";
$course_id = "";
$course_name = [];
$year_section = "";
$action_taken = "";

require_once("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $course_id = $_POST["course_id"];
    $course_name = isset($_POST["coursename"]) ? $_POST["coursename"] : [];
    $year_section = $_POST["year_section"];
    $action_taken = $_POST["acttaken"];

    if (!empty($name) && !empty($course_id) && !empty($course_name) && !empty($year_section) && !empty($action_taken)) {
        $entry = getEntryFromDatabase($id);

        if ($entry) {
            $course_name_str = implode(", ", $course_name);

            updateDataInDatabase($id, $name, $course_id, $course_name_str, $year_section, $action_taken, $entry["photo"]);

            $courseTable = '';
            if ($year_section === 'BSIT') {
                $courseTable = "bsittable.php";
            } elseif ($year_section === 'BSGE') {
                $courseTable = "bsgetable.php";
            } elseif ($year_section === 'BSFT') {
                $courseTable = "bsfttable.php";
            }

            header("Location: $courseTable");
            exit();
        } else {
            echo "Entry not found.";
        }
    } else {
        echo "Please fill in all the fields.";
    }
}

if (isset($_GET['id'])) {
    $entryId = $_GET['id'];
    $entry = getEntryFromDatabase($entryId);

    if ($entry) {
        $id = $entry['id'];
        $name = $entry['name'];
        $course_id = $entry['course_id'];
        $course_name = explode(", ", $entry['course_name']);
        $year_section = $entry['year_section'];
        $action_taken = $entry['action_taken'];
        $photoPath = $entry['photo'];
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
    <title>Edit</title>
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
        <h1 class="text-center display-4 text-success">Edit Students Information</h1>
        <div class="row">
            <div class="card">
                <div style="text-align: center;">
                    <img src="<?php echo $photoPath; ?>" alt="User Image" class="circular-image">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $name; ?></h5>
                    <p>Course ID: <?php echo $course_id; ?></p>
                    <p>Course Name: <?php echo implode(", ", $course_name); ?></p>
                    <p>Year & Section: <?php echo $year_section; ?></p>
                    <p>Action Taken: <?php echo $action_taken; ?></p>
                </div>
            </div>
        </div>
        <div class="table-responsive text-center">
            <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="course_id">Course ID:</label>
                    <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo $course_id; ?>" required>
                </div>
                <div class="form-group">
                <label for="coursename">Course Name:</label>
                <?php
                $courses = array(
                    // Additional subjects for BSIT
                    "Networking II",
                    "Systems Integration and Architecture",
                    "Information Management I",
                    "Multimedia Publishing",
                    "Quantitative Methods",
                    "Web Systems and Technologies 2",
                    "Interactive Programming and Technologies 2",
                    "Individual Sports",
                    // Additional subjects for BSGE
                    "Theory of Errors and Adjustments",
                    "Satellite Geodesy",
                    "Geodetic Surveying",
                    "Land Use Planning and Development",
                    "Enginering Mechanics 2 (Dynamics)",
                    "Engineering Economy",
                    "Principle of Geography",
                    "Art Appreciation",
                    // Additional subjects for BSFT
                    "Introduction to Computer Concepts and Application",
                    "Technical Writing",
                    "Food Processing I",
                    "Food Chemistry II",
                    "Physical Education",
                    "Basic Nutrition",
                    "Dairy Science and Technology",
                    "Physical Chemistry"
                );

                foreach ($courses as $course) {
                    $isChecked = in_array($course, $course_name) ? 'checked' : '';
                    echo "<div class='form-check'>";
                    echo "<input type='checkbox' class='form-check-input' id='" . strtolower(str_replace(' ', '', $course)) . "' name='coursename[]' value='$course' $isChecked>";
                    echo "<label class='form-check-label' for='" . strtolower(str_replace(' ', '', $course)) . "'>$course</label>";
                    echo "</div>";
                }
                ?>
            </div>
                <div class="form-group">
                    <label for="year_section">Course:</label>
                    <select class="form-control" id="year_section" name="year_section" required>
                        <option value="BSIT" <?php if ($year_section === 'BSIT') echo 'selected'; ?>>BSIT</option>
                        <option value="BSGE" <?php if ($year_section === 'BSGE') echo 'selected'; ?>>BSGE</option>
                        <option value="BSFT" <?php if ($year_section === 'BSFT') echo 'selected'; ?>>BSFT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="action_taken">Action Taken:</label>
                    <select class="form-control" id="acttaken" name="acttaken" required>
                        <option value="Enrolled" <?php if ($action_taken === 'Enrolled') echo 'selected'; ?>>Enrolled</option>
                        <option value="Dropped" <?php if ($action_taken === 'Dropped') echo 'selected'; ?>>Dropped</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
