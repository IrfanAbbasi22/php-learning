<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Forms & User Input</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .section {
            margin-bottom: 40px;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
        }
        .section h2 {
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        .btn {
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .btn:hover {
            background: #5a6fd8;
        }
        .output {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
        .success {
            background: #d4edda;
            border: 1px solid #c3e6c3;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .nav {
            background: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .nav a {
            color: #667eea;
            text-decoration: none;
            margin-right: 20px;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Forms & User Input</h1>
            <p>Handling HTML Forms, Validation, and Data Processing</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../01-basics/">Basics</a>
            <a href="../02-control-structures/">Control Structures</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>📝 Basic Form Processing</h2>
                <p>PHP can process form data submitted via HTML forms. The form data is available in the <code>$_POST</code> or <code>$_GET</code> superglobal arrays.</p>
                
                <h3>Simple Contact Form</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Submit</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo '<div class="output">';
                    echo '<h3>Form Data Received:</h3>';
                    echo '<strong>Name:</strong> ' . (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Not provided') . '<br>';
                    echo '<strong>Email:</strong> ' . (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'Not provided') . '<br>';
                    echo '<strong>Message:</strong> ' . (isset($_POST['message']) ? htmlspecialchars($_POST['message']) : 'Not provided') . '<br>';
                    echo '</div>';
                }
                ?>
            </div>

            <div class="section">
                <h2>✅ Form Validation</h2>
                <p>It's important to validate form data to ensure it meets your requirements and is secure.</p>
                
                <h3>Validated Registration Form</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        <?php
                        if (isset($_POST['username']) && empty($_POST['username'])) {
                            echo '<div class="error">Username is required</div>';
                        }
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email2">Email:</label>
                        <input type="email" id="email2" name="email2" value="<?php echo isset($_POST['email2']) ? htmlspecialchars($_POST['email2']) : ''; ?>">
                        <?php
                        if (isset($_POST['email2']) && !filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)) {
                            echo '<div class="error">Please enter a valid email address</div>';
                        }
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" min="1" max="120" value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>">
                        <?php
                        if (isset($_POST['age']) && ($_POST['age'] < 1 || $_POST['age'] > 120)) {
                            echo '<div class="error">Age must be between 1 and 120</div>';
                        }
                        ?>
                    </div>
                    
                    <button type="submit" class="btn">Register</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];
                    
                    // Validate username
                    if (empty($_POST['username'])) {
                        $errors[] = 'Username is required';
                    } elseif (strlen($_POST['username']) < 3) {
                        $errors[] = 'Username must be at least 3 characters long';
                    }
                    
                    // Validate email
                    if (empty($_POST['email2'])) {
                        $errors[] = 'Email is required';
                    } elseif (!filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)) {
                        $errors[] = 'Please enter a valid email address';
                    }
                    
                    // Validate age
                    if (empty($_POST['age'])) {
                        $errors[] = 'Age is required';
                    } elseif (!is_numeric($_POST['age']) || $_POST['age'] < 1 || $_POST['age'] > 120) {
                        $errors[] = 'Age must be a number between 1 and 120';
                    }
                    
                    if (empty($errors)) {
                        echo '<div class="success">';
                        echo '<h3>Registration Successful!</h3>';
                        echo '<strong>Username:</strong> ' . htmlspecialchars($_POST['username']) . '<br>';
                        echo '<strong>Email:</strong> ' . htmlspecialchars($_POST['email2']) . '<br>';
                        echo '<strong>Age:</strong> ' . htmlspecialchars($_POST['age']) . '<br>';
                        echo '</div>';
                    } else {
                        echo '<div class="output">';
                        echo '<h3>Validation Errors:</h3>';
                        echo '<ul>';
                        foreach ($errors as $error) {
                            echo '<li>' . htmlspecialchars($error) . '</li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <div class="section">
                <h2>🔒 Security Best Practices</h2>
                <p>When handling form data, always follow these security practices:</p>
                
                <div class="code-block">
                    <?php
                        // 1. Always validate and sanitize input
                        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

                        // 2. Use prepared statements for database queries
                        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                        $stmt->execute([$username]);

                        // 3. Escape output to prevent XSS
                        echo htmlspecialchars($user_input);

                        // 4. Use CSRF tokens for forms
                        session_start();
                        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                            die('CSRF token validation failed');
                        }
                    ?>
                </div>

                <h3>Key Security Points:</h3>
                <ul>
                    <li><strong>Input Validation:</strong> Always validate user input</li>
                    <li><strong>Output Escaping:</strong> Use <code>htmlspecialchars()</code> to prevent XSS</li>
                    <li><strong>SQL Injection:</strong> Use prepared statements</li>
                    <li><strong>CSRF Protection:</strong> Implement CSRF tokens</li>
                    <li><strong>File Uploads:</strong> Validate file types and sizes</li>
                </ul>
            </div>

            <div class="section">
                <h2>📊 Working with Different Form Elements</h2>
                <p>PHP can handle various HTML form elements:</p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <select id="country" name="country">
                            <option value="">Select a country</option>
                            <option value="us" <?php echo (isset($_POST['country']) && $_POST['country'] === 'us') ? 'selected' : ''; ?>>United States</option>
                            <option value="uk" <?php echo (isset($_POST['country']) && $_POST['country'] === 'uk') ? 'selected' : ''; ?>>United Kingdom</option>
                            <option value="ca" <?php echo (isset($_POST['country']) && $_POST['country'] === 'ca') ? 'selected' : ''; ?>>Canada</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Interests:</label><br>
                        <input type="checkbox" id="sports" name="interests[]" value="sports" <?php echo (isset($_POST['interests']) && in_array('sports', $_POST['interests'])) ? 'checked' : ''; ?>>
                        <label for="sports">Sports</label><br>
                        
                        <input type="checkbox" id="music" name="interests[]" value="music" <?php echo (isset($_POST['interests']) && in_array('music', $_POST['interests'])) ? 'checked' : ''; ?>>
                        <label for="music">Music</label><br>
                        
                        <input type="checkbox" id="reading" name="interests[]" value="reading" <?php echo (isset($_POST['interests']) && in_array('reading', $_POST['interests'])) ? 'checked' : ''; ?>>
                        <label for="reading">Reading</label>
                    </div>
                    
                    <div class="form-group">
                        <label>Gender:</label><br>
                        <input type="radio" id="male" name="gender" value="male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'checked' : ''; ?>>
                        <label for="male">Male</label><br>
                        
                        <input type="radio" id="female" name="gender" value="female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'checked' : ''; ?>>
                        <label for="female">Female</label><br>
                        
                        <input type="radio" id="other" name="gender" value="other" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'other') ? 'checked' : ''; ?>>
                        <label for="other">Other</label>
                    </div>
                    
                    <button type="submit" class="btn">Submit Preferences</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    echo '<div class="output">';
                    echo '<h3>Form Data:</h3>';
                    
                    if (isset($_POST['country']) && !empty($_POST['country'])) {
                        echo '<strong>Country:</strong> ' . htmlspecialchars($_POST['country']) . '<br>';
                    }
                    
                    if (isset($_POST['interests']) && is_array($_POST['interests'])) {
                        echo '<strong>Interests:</strong> ' . implode(', ', array_map('htmlspecialchars', $_POST['interests'])) . '<br>';
                    }
                    
                    if (isset($_POST['gender']) && !empty($_POST['gender'])) {
                        echo '<strong>Gender:</strong> ' . htmlspecialchars($_POST['gender']) . '<br>';
                    }
                    
                    echo '</div>';
                }
                ?>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Use <code>$_POST</code> for form data submitted via POST method</li>
                    <li>Use <code>$_GET</code> for data sent via GET method or URL parameters</li>
                    <li>Always validate and sanitize user input</li>
                    <li>Use <code>htmlspecialchars()</code> to prevent XSS attacks</li>
                    <li>Check if form was submitted using <code>$_SERVER['REQUEST_METHOD']</code></li>
                    <li>Use prepared statements for database operations</li>
                    <li>Implement CSRF protection for sensitive forms</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 