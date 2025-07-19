<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Database Operations</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Database Operations</h1>
            <p>MySQL Connections, CRUD Operations, and Prepared Statements</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../06-files/">Files</a>
            <a href="../08-oop/">OOP</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 Database Connection</h2>
                <p>PHP provides several ways to connect to databases. The most common are MySQLi and PDO. Let's explore both:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// MySQLi Connection
$mysqli = new mysqli('localhost', 'username', 'password', 'database_name');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// PDO Connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=database_name", "username", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Database Connection Status:</strong><br>
                    <?php
                    // Note: This is a demonstration. In real applications, you'd use actual database credentials
                    echo "This is a learning environment. In a real application, you would:<br>";
                    echo "1. Have a MySQL server running<br>";
                    echo "2. Create a database<br>";
                    echo "3. Set up proper credentials<br>";
                    echo "4. Use secure connection methods<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📊 Creating Tables</h2>
                <p>Let's create some example tables for our learning:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Create users table
$createUsersTable = "
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Create posts table
$createPostsTable = "
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

// Execute the queries
$mysqli->query($createUsersTable);
$mysqli->query($createPostsTable);
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Table Structure Examples:</strong><br>
                    <strong>Users Table:</strong><br>
                    - id (INT, AUTO_INCREMENT, PRIMARY KEY)<br>
                    - username (VARCHAR(50), UNIQUE, NOT NULL)<br>
                    - email (VARCHAR(100), UNIQUE, NOT NULL)<br>
                    - password (VARCHAR(255), NOT NULL)<br>
                    - created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)<br><br>
                    
                    <strong>Posts Table:</strong><br>
                    - id (INT, AUTO_INCREMENT, PRIMARY KEY)<br>
                    - user_id (INT, FOREIGN KEY)<br>
                    - title (VARCHAR(200), NOT NULL)<br>
                    - content (TEXT)<br>
                    - created_at (TIMESTAMP, DEFAULT CURRENT_TIMESTAMP)<br>
                </div>
            </div>

            <div class="section">
                <h2>➕ INSERT Operations</h2>
                <p>Adding data to the database:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// MySQLi INSERT
$username = "john_doe";
$email = "john@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "User inserted successfully&lt;br&gt;";
} else {
    echo "Error: " . $stmt->error . "&lt;br&gt;";
}

// PDO INSERT
try {
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => 'jane_doe',
        ':email' => 'jane@example.com',
        ':password' => password_hash("password456", PASSWORD_DEFAULT)
    ]);
    echo "User inserted with PDO&lt;br&gt;";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>INSERT Operations:</strong><br>
                    <?php
                    // Simulate database operations
                    echo "User 'john_doe' created successfully. ID: 1<br>";
                    echo "User 'jane_doe' created successfully. ID: 2<br>";
                    echo "User 'admin' created successfully. ID: 3<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📖 SELECT Operations</h2>
                <p>Retrieving data from the database:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// MySQLi SELECT
$sql = "SELECT id, username, email, created_at FROM users";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Username: " . $row["username"] . "&lt;br&gt;";
    }
} else {
    echo "No users found&lt;br&gt;";
}

// PDO SELECT with prepared statement
try {
    $sql = "SELECT id, username, email, created_at FROM users WHERE id > ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([1]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row["id"] . " - Username: " . $row["username"] . "&lt;br&gt;";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>SELECT Operations:</strong><br>
                    <?php
                    // Simulate database results
                    $users = [
                        ['id' => 1, 'username' => 'john_doe', 'email' => 'john@example.com', 'created_at' => '2024-01-15 10:30:00'],
                        ['id' => 2, 'username' => 'jane_doe', 'email' => 'jane@example.com', 'created_at' => '2024-01-15 11:45:00'],
                        ['id' => 3, 'username' => 'admin', 'email' => 'admin@example.com', 'created_at' => '2024-01-15 12:00:00']
                    ];
                    
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Created At</th></tr>";
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . $user['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>" . $user['created_at'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>✏️ UPDATE Operations</h2>
                <p>Modifying existing data:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// MySQLi UPDATE
$newEmail = "john.updated@example.com";
$userId = 1;

$sql = "UPDATE users SET email = ? WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("si", $newEmail, $userId);

if ($stmt->execute()) {
    echo "User updated successfully. Rows affected: " . $stmt->affected_rows . "&lt;br&gt;";
} else {
    echo "Error: " . $stmt->error . "&lt;br&gt;";
}

// PDO UPDATE
try {
    $sql = "UPDATE users SET email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => 'jane.updated@example.com',
        ':id' => 2
    ]);
    echo "User updated successfully. Rows affected: " . $stmt->rowCount() . "&lt;br&gt;";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>UPDATE Operations:</strong><br>
                    <?php
                    echo "User ID 1 email updated to: john.updated@example.com<br>";
                    echo "User ID 2 email updated to: jane.updated@example.com<br>";
                    echo "Rows affected: 2<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🗑️ DELETE Operations</h2>
                <p>Removing data from the database:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// MySQLi DELETE
$userId = 3;

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    echo "User deleted successfully. Rows affected: " . $stmt->affected_rows . "&lt;br&gt;";
} else {
    echo "Error: " . $stmt->error . "&lt;br&gt;";
}

// PDO DELETE
try {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => 4]);
    echo "User deleted successfully. Rows affected: " . $stmt->rowCount() . "&lt;br&gt;";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>DELETE Operations:</strong><br>
                    <?php
                    echo "User ID 3 deleted successfully<br>";
                    echo "User ID 4 deleted successfully<br>";
                    echo "Total rows affected: 2<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔗 JOIN Operations</h2>
                <p>Combining data from multiple tables:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// INNER JOIN - Get posts with user information
$sql = "
SELECT p.id, p.title, p.content, u.username, p.created_at 
FROM posts p 
INNER JOIN users u ON p.user_id = u.id 
ORDER BY p.created_at DESC
";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Post: " . $row["title"] . " by " . $row["username"] . "&lt;br&gt;";
    }
} else {
    echo "No posts found&lt;br&gt;";
}

// LEFT JOIN - Get all users and their posts (if any)
$sql = "
SELECT u.username, COUNT(p.id) as post_count 
FROM users u 
LEFT JOIN posts p ON u.id = p.user_id 
GROUP BY u.id, u.username
";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["username"] . " has " . $row["post_count"] . " posts&lt;br&gt;";
    }
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>JOIN Operations:</strong><br>
                    <?php
                    // Simulate JOIN results
                    $posts = [
                        ['id' => 1, 'title' => 'First Post', 'content' => 'Hello World!', 'username' => 'john_doe', 'created_at' => '2024-01-15 14:30:00'],
                        ['id' => 2, 'title' => 'My Blog Post', 'content' => 'This is my first blog post.', 'username' => 'jane_doe', 'created_at' => '2024-01-15 15:45:00']
                    ];
                    
                    echo "<strong>Posts with User Information:</strong><br>";
                    foreach ($posts as $post) {
                        echo "Post: " . htmlspecialchars($post['title']) . " by " . htmlspecialchars($post['username']) . "<br>";
                    }
                    
                    echo "<br><strong>User Post Counts:</strong><br>";
                    $userPosts = [
                        'john_doe' => 1,
                        'jane_doe' => 1,
                        'admin' => 0
                    ];
                    
                    foreach ($userPosts as $username => $count) {
                        echo "$username has $count posts<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔒 Prepared Statements</h2>
                <p>Using prepared statements to prevent SQL injection:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// MySQLi Prepared Statement
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';

$sql = "SELECT * FROM users WHERE username = ? AND email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

// PDO Prepared Statement
try {
    $sql = "SELECT * FROM users WHERE username = :username AND email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email
    ]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "User found: " . $row['username'] . "&lt;br&gt;";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Prepared Statements Benefits:</strong><br>
                    ✅ Prevents SQL injection attacks<br>
                    ✅ Improves performance for repeated queries<br>
                    ✅ Handles special characters automatically<br>
                    ✅ Separates SQL logic from data<br>
                </div>
            </div>

            <div class="section">
                <h2>📊 Simple User Management System</h2>
                <p>Let's create a simple user management form:</p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    
                    <button type="submit" name="add_user" class="btn">Add User</button>
                    <button type="submit" name="search_user" class="btn">Search User</button>
                </form>

                <?php
                // Simulate database operations
                if (isset($_POST['add_user'])) {
                    $username = $_POST['username'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $password = $_POST['password'] ?? '';
                    
                    if (!empty($username) && !empty($email) && !empty($password)) {
                        echo '<div class="success">User added successfully!</div>';
                    } else {
                        echo '<div class="error">Please fill all fields.</div>';
                    }
                }
                
                if (isset($_POST['search_user'])) {
                    $username = $_POST['username'] ?? '';
                    if (!empty($username)) {
                        echo '<div class="output">';
                        echo '<strong>Search Results for: ' . htmlspecialchars($username) . '</strong><br>';
                        echo 'User found: john_doe (john@example.com)<br>';
                        echo '</div>';
                    } else {
                        echo '<div class="error">Please enter a username to search.</div>';
                    }
                }
                ?>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Always use prepared statements to prevent SQL injection</li>
                    <li>Use PDO for better error handling and portability</li>
                    <li>Use MySQLi for MySQL-specific features</li>
                    <li>Always validate and sanitize user input</li>
                    <li>Use transactions for multiple related operations</li>
                    <li>Handle database errors gracefully</li>
                    <li>Use appropriate data types for columns</li>
                    <li>Index frequently queried columns</li>
                    <li>Use foreign keys for data integrity</li>
                    <li>Close database connections when done</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 