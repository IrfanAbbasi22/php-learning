<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Sessions & Cookies</title>
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
        .code-block {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            overflow-x: auto;
        }
        .output {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 5px;
            padding: 15px;
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
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
        .session-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .session-info h3 {
            margin-top: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Sessions & Cookies</h1>
            <p>Managing User State and Data Persistence</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../04-forms/">Forms</a>
            <a href="../06-files/">Files</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 What are Sessions?</h2>
                <p>Sessions allow you to store user data on the server between page requests. This is essential for maintaining user state, shopping carts, login systems, and more.</p>
                
                <div class="session-info">
                    <h3>Current Session Information:</h3>
                    <?php
                    session_start();
                    echo "<strong>Session ID:</strong> " . session_id() . "<br>";
                    echo "<strong>Session Name:</strong> " . session_name() . "<br>";
                    echo "<strong>Session Status:</strong> " . (session_status() == PHP_SESSION_ACTIVE ? "Active" : "Inactive") . "<br>";
                    echo "<strong>Session Data:</strong><br>";
                    if (!empty($_SESSION)) {
                        echo "<pre>" . print_r($_SESSION, true) . "</pre>";
                    } else {
                        echo "No session data stored yet.<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📝 Basic Session Operations</h2>
                <p>Let's learn how to work with sessions:</p>
                
                <div class="code-block">
&lt;?php
// Start a session (must be called before any output)
session_start();

// Store data in session
$_SESSION['user_id'] = 123;
$_SESSION['username'] = 'john_doe';
$_SESSION['login_time'] = time();

// Retrieve data from session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Check if session variable exists
if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'] . "&lt;br&gt;";
}

// Remove specific session variable
unset($_SESSION['login_time']);

// Destroy entire session
// session_destroy();
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    session_start();
                    
                    // Store some test data
                    $_SESSION['user_id'] = 123;
                    $_SESSION['username'] = 'john_doe';
                    $_SESSION['login_time'] = time();
                    
                    echo "User ID: " . $_SESSION['user_id'] . "<br>";
                    echo "Username: " . $_SESSION['username'] . "<br>";
                    echo "Login Time: " . date('Y-m-d H:i:s', $_SESSION['login_time']) . "<br>";
                    
                    // Remove one variable
                    unset($_SESSION['login_time']);
                    echo "After unset - Login Time: " . (isset($_SESSION['login_time']) ? $_SESSION['login_time'] : 'Removed') . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🍪 Working with Cookies</h2>
                <p>Cookies are small pieces of data stored on the client's browser:</p>
                
                <div class="code-block">
&lt;?php
// Set a cookie
setcookie('user_preference', 'dark_theme', time() + 3600); // Expires in 1 hour

// Set cookie with more options
setcookie('language', 'en', time() + (86400 * 30), '/', '', false, true); // 30 days, secure

// Read cookie
if (isset($_COOKIE['user_preference'])) {
    echo "User preference: " . $_COOKIE['user_preference'] . "&lt;br&gt;";
}

// Delete cookie (set expiration in the past)
setcookie('old_cookie', '', time() - 3600);

// Check all cookies
echo "All cookies:&lt;br&gt;";
if (!empty($_COOKIE)) {
    foreach ($_COOKIE as $name => $value) {
        echo "$name: $value&lt;br&gt;";
    }
} else {
    echo "No cookies set.&lt;br&gt;";
}
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    // Set some test cookies
                    setcookie('user_preference', 'dark_theme', time() + 3600);
                    setcookie('language', 'en', time() + (86400 * 30));
                    
                    echo "All cookies:<br>";
                    if (!empty($_COOKIE)) {
                        foreach ($_COOKIE as $name => $value) {
                            echo "$name: $value<br>";
                        }
                    } else {
                        echo "No cookies set.<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔐 Simple Login System</h2>
                <p>Let's create a basic login system using sessions:</p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    
                    <button type="submit" name="login" class="btn">Login</button>
                    <button type="submit" name="logout" class="btn">Logout</button>
                </form>

                <?php
                // Simple user database (in real apps, use a real database)
                $users = [
                    'john' => 'password123',
                    'admin' => 'admin123',
                    'user' => 'user123'
                ];

                if (isset($_POST['login'])) {
                    $username = $_POST['username'] ?? '';
                    $password = $_POST['password'] ?? '';
                    
                    if (isset($users[$username]) && $users[$username] === $password) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $username;
                        $_SESSION['login_time'] = time();
                        echo '<div class="output"><strong>Login successful!</strong></div>';
                    } else {
                        echo '<div class="output" style="background: #f8d7da; border-color: #f5c6cb; color: #721c24;"><strong>Login failed!</strong> Invalid username or password.</div>';
                    }
                }

                if (isset($_POST['logout'])) {
                    session_destroy();
                    echo '<div class="output"><strong>Logged out successfully!</strong></div>';
                }

                // Display login status
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                    echo '<div class="session-info">';
                    echo '<h3>Login Status:</h3>';
                    echo '<strong>Status:</strong> Logged in<br>';
                    echo '<strong>Username:</strong> ' . htmlspecialchars($_SESSION['username']) . '<br>';
                    echo '<strong>Login Time:</strong> ' . date('Y-m-d H:i:s', $_SESSION['login_time']) . '<br>';
                    echo '<strong>Session Duration:</strong> ' . (time() - $_SESSION['login_time']) . ' seconds<br>';
                    echo '</div>';
                } else {
                    echo '<div class="session-info">';
                    echo '<h3>Login Status:</h3>';
                    echo '<strong>Status:</strong> Not logged in<br>';
                    echo '<strong>Available users:</strong> john, admin, user<br>';
                    echo '<strong>Passwords:</strong> password123, admin123, user123<br>';
                    echo '</div>';
                }
                ?>
            </div>

            <div class="section">
                <h2>🛒 Shopping Cart Example</h2>
                <p>Let's create a simple shopping cart using sessions:</p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="product">Product:</label>
                        <select id="product" name="product">
                            <option value="laptop">Laptop ($999)</option>
                            <option value="phone">Phone ($599)</option>
                            <option value="tablet">Tablet ($399)</option>
                            <option value="headphones">Headphones ($99)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
                    </div>
                    
                    <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                    <button type="submit" name="clear_cart" class="btn">Clear Cart</button>
                </form>

                <?php
                // Initialize cart if it doesn't exist
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $products = [
                    'laptop' => ['name' => 'Laptop', 'price' => 999],
                    'phone' => ['name' => 'Phone', 'price' => 599],
                    'tablet' => ['name' => 'Tablet', 'price' => 399],
                    'headphones' => ['name' => 'Headphones', 'price' => 99]
                ];

                if (isset($_POST['add_to_cart'])) {
                    $product = $_POST['product'] ?? '';
                    $quantity = (int)($_POST['quantity'] ?? 1);
                    
                    if (isset($products[$product])) {
                        if (isset($_SESSION['cart'][$product])) {
                            $_SESSION['cart'][$product]['quantity'] += $quantity;
                        } else {
                            $_SESSION['cart'][$product] = [
                                'name' => $products[$product]['name'],
                                'price' => $products[$product]['price'],
                                'quantity' => $quantity
                            ];
                        }
                        echo '<div class="output"><strong>Added to cart!</strong></div>';
                    }
                }

                if (isset($_POST['clear_cart'])) {
                    $_SESSION['cart'] = [];
                    echo '<div class="output"><strong>Cart cleared!</strong></div>';
                }

                // Display cart
                if (!empty($_SESSION['cart'])) {
                    echo '<div class="session-info">';
                    echo '<h3>Shopping Cart:</h3>';
                    $total = 0;
                    foreach ($_SESSION['cart'] as $product_id => $item) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                        echo "<strong>{$item['name']}</strong> - \${$item['price']} x {$item['quantity']} = \${$subtotal}<br>";
                    }
                    echo "<hr><strong>Total: \${$total}</strong>";
                    echo '</div>';
                } else {
                    echo '<div class="session-info">';
                    echo '<h3>Shopping Cart:</h3>';
                    echo '<strong>Cart is empty</strong>';
                    echo '</div>';
                }
                ?>
            </div>

            <div class="section">
                <h2>⚙️ Session Configuration</h2>
                <p>You can configure session behavior using PHP settings:</p>
                
                <div class="code-block">
&lt;?php
// Set session configuration
ini_set('session.gc_maxlifetime', 3600); // Session timeout in seconds
ini_set('session.cookie_lifetime', 0); // Cookie expires when browser closes
ini_set('session.use_strict_mode', 1); // Use strict mode for security

// Start session with custom settings
session_start([
    'cookie_lifetime' => 0,
    'cookie_secure' => false, // Set to true for HTTPS
    'cookie_httponly' => true,
    'use_strict_mode' => true
]);

// Session timeout example
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // Session expired (30 minutes)
    session_unset();
    session_destroy();
    echo "Session expired due to inactivity.&lt;br&gt;";
}

$_SESSION['last_activity'] = time();
?&gt;
                </div>

                <div class="output">
                    <strong>Current Session Settings:</strong><br>
                    <?php
                    echo "Session timeout: " . ini_get('session.gc_maxlifetime') . " seconds<br>";
                    echo "Cookie lifetime: " . ini_get('session.cookie_lifetime') . " seconds<br>";
                    echo "Strict mode: " . (ini_get('session.use_strict_mode') ? 'Enabled' : 'Disabled') . "<br>";
                    echo "Session save path: " . session_save_path() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Always call <code>session_start()</code> before any output</li>
                    <li>Sessions store data on the server, cookies on the client</li>
                    <li>Use <code>$_SESSION</code> to store and retrieve session data</li>
                    <li>Use <code>setcookie()</code> to set cookies</li>
                    <li>Use <code>$_COOKIE</code> to read cookies</li>
                    <li>Call <code>session_destroy()</code> to end a session</li>
                    <li>Use <code>unset()</code> to remove specific session variables</li>
                    <li>Configure session security for production applications</li>
                    <li>Be careful with sensitive data in cookies</li>
                    <li>Use HTTPS and secure cookies in production</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 