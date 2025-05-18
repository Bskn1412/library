<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//http://localhost/STUDENT/initialize_db.php

$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = "";
$dbname = "lib_db";
$flag_file = "db_initialized.txt";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected to MySQL successfully.<br>";
}

// Check if the flag file exists
if (!file_exists($flag_file)) {
    // Create database if not exists
    if (!$conn->query("CREATE DATABASE IF NOT EXISTS $dbname")) {
        die("Error creating database: " . $conn->error);
    } else {
        echo "Database '$dbname' created successfully.<br>";
    }

    if (!$conn->select_db($dbname)) {
        die("Database selection failed: " . $conn->error);
    } else {
        echo "Database selected successfully.<br>";
    }

    // Create tables
    $tables = [
        "CREATE TABLE IF NOT EXISTS branches (
            ug VARCHAR(20) NOT NULL,
            pg VARCHAR(20) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1",

        "CREATE TABLE IF NOT EXISTS logins (
            username VARCHAR(20) NOT NULL,
            password VARCHAR(20) NOT NULL,
            page VARCHAR(20) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1",

        "CREATE TABLE IF NOT EXISTS main (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date DATE NOT NULL,
        name VARCHAR(100) NOT NULL,
        branch VARCHAR(20) NOT NULL,
        year INT(5) NOT NULL,
        rollnum VARCHAR(15) NOT NULL,
        intime TIME NOT NULL,
        outtime TIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1",

        "CREATE TABLE IF NOT EXISTS staff (
            rollnum VARCHAR(20) NOT NULL,
            name VARCHAR(100) NOT NULL,
            title ENUM('Sir', 'Madam') NOT NULL,  
            branch VARCHAR(20) NOT NULL,
            PRIMARY KEY (rollnum)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1",


        "CREATE TABLE IF NOT EXISTS student (
            rollnum VARCHAR(15) NOT NULL,
            name VARCHAR(100) NOT NULL,
            year INT(5) NOT NULL,
            branch VARCHAR(20) NOT NULL,
            batch INT(11) DEFAULT NULL,
            PRIMARY KEY (rollnum)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1",

        "CREATE TABLE IF NOT EXISTS `branches` (
        `ug` varchar(20) NOT NULL,
        `pg` varchar(20) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;",

        "
        INSERT INTO `branches` (`ug`, `pg`) VALUES
        ('cse', ''),
        ('ece', 'Mtech-ece'),
        ('mech', 'Mtech-cse'),
        ('it', 'Mtech-eee'),
        ('eee', 'mca'),
        ('civil', 'mba'),
        ('BS&H', ''),
        ('', 'M.TECH VLSI & ES'),
        ('', 'M.TECH CSE-AIML'),
        ('', 'M.TECH PEED'),
        ('', 'M.TECH SE'),
        ('', 'M.TECH MD'),
        ('IOT', '--'),
        ('AIDS', '--');",

        "
        CREATE TABLE IF NOT EXISTS today (
        date DATE NOT NULL,
        branch VARCHAR(50) NOT NULL,
        total INT NOT NULL,
        PRIMARY KEY (date, branch)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;",

        "CREATE TABLE IF NOT EXISTS monthly_stats (
         year INT NOT NULL,
         month INT NOT NULL,
         branch VARCHAR(50) NOT NULL,
         total INT NOT NULL,
         PRIMARY KEY (year, month, branch)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;",

        "CREATE TABLE IF NOT EXISTS yearly_stats (
         year INT NOT NULL,
         branch VARCHAR(50) NOT NULL,
         total INT NOT NULL,
         PRIMARY KEY (year, branch)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;",



        "CREATE TABLE IF NOT EXISTS staff_logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            date DATE NOT NULL,
            name VARCHAR(100) NOT NULL,
            branch VARCHAR(20) NOT NULL,
            rollnum VARCHAR(20) NOT NULL,
            intime TIME NOT NULL,
            outtime TIME NOT NULL 
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 "

    ];

    foreach ($tables as $sql) {
        if (!$conn->query($sql)) {
            die("Error creating table: " . $conn->error);
        } else {
            echo "Table created successfully: " . explode(" ", $sql)[5] . "<br>";
        }
    }

    // Insert default users
    $default_users = [
        ["admin", "yes", "adminpage"],
        ["admin", "no", "viewpage"]
    ];

    $stmt = $conn->prepare("INSERT INTO logins (username, password, page) VALUES (?, ?, ?)");
    foreach ($default_users as $user) {
        $stmt->bind_param("sss", $user[0], $user[1], $user[2]);
        if (!$stmt->execute()) {
            die("Error inserting users: " . $stmt->error);
        } else {
            echo "User inserted: " . $user[0] . "<br>";
        }
    }
    $stmt->close();

    file_put_contents($flag_file, "Database initialized on " . date("Y-m-d H:i:s"));
    echo "Database and tables created successfully.<br>";
}

// Close connection
$conn->close();

?>