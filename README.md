# Mini-Task-Collaboration-App



## Database Connection Details
$host = 'localhost';
$db   = 'taskapp';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>


## Sample Login Credentials
- **Admin:**
  - Email: `admin@gmail.com`
  - Password: `admin@123`

  
- **User:**
  - Email: `user@gmail.com`
  - Password: `user@123`

## .sql File
The `taskapp.sql` file for the database schema can be found in the repository at `taskapp.sql`. 

The file includes the structure for the `users` and `tasks` tables.
