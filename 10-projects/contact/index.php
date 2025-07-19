<?php
session_start();

// Initialize messages array
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    $errors = [];
    
    // Validation
    if (empty($name)) {
        $errors[] = 'Name is required';
    } elseif (strlen($name) < 2) {
        $errors[] = 'Name must be at least 2 characters long';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address';
    }
    
    if (empty($subject)) {
        $errors[] = 'Subject is required';
    } elseif (strlen($subject) < 5) {
        $errors[] = 'Subject must be at least 5 characters long';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    } elseif (strlen($message) < 10) {
        $errors[] = 'Message must be at least 10 characters long';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // Simulate email sending (in real app, use mail() or PHPMailer)
        $to = "admin@example.com";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $emailBody = "
        <h2>Contact Form Submission</h2>
        <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
        <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
        <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
        <p><strong>Message:</strong></p>
        <p>" . nl2br(htmlspecialchars($message)) . "</p>
        <p><strong>Submitted:</strong> " . date('Y-m-d H:i:s') . "</p>
        ";
        
        // In a real application, you would use:
        // mail($to, $subject, $emailBody, $headers);
        
        // Store success message
        $_SESSION['messages'][] = [
            'type' => 'success',
            'text' => 'Thank you! Your message has been sent successfully.'
        ];
        
        // Clear form data
        $name = $email = $subject = $message = '';
        
    } else {
        // Store error messages
        foreach ($errors as $error) {
            $_SESSION['messages'][] = [
                'type' => 'error',
                'text' => $error
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - PHP Learning</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 300;
        }
        .content {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }
        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
        .btn {
            background: #667eea;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #5a6fd8;
        }
        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .message.success {
            background: #d4edda;
            border: 1px solid #c3e6c3;
            color: #155724;
        }
        .message.error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
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
        .contact-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .contact-info h3 {
            margin-top: 0;
            color: #333;
        }
        .contact-info p {
            margin: 10px 0;
            color: #666;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Contact Us</h1>
            <p>Get in touch with us</p>
        </div>
        
        <div class="nav">
            <a href="../../index.html">← Back to Learning Hub</a>
        </div>

        <div class="content">
            <!-- Display Messages -->
            <?php if (!empty($_SESSION['messages'])): ?>
                <?php foreach ($_SESSION['messages'] as $message): ?>
                    <div class="message <?php echo $message['type']; ?>">
                        <?php echo htmlspecialchars($message['text']); ?>
                    </div>
                <?php endforeach; ?>
                <?php $_SESSION['messages'] = []; // Clear messages ?>
            <?php endif; ?>

            <div class="contact-info">
                <h3>📞 Contact Information</h3>
                <p><strong>Email:</strong> info@example.com</p>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p><strong>Address:</strong> 123 Main Street, City, State 12345</p>
                <p><strong>Hours:</strong> Monday - Friday, 9:00 AM - 5:00 PM</p>
            </div>

            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <input type="text" id="subject" name="subject" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" placeholder="Please enter your message here..." required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                </div>
                
                <button type="submit" class="btn">Send Message</button>
            </form>

            <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                <h3>🔧 Form Features Demonstrated:</h3>
                <ul>
                    <li><strong>Form Validation:</strong> Server-side validation for all fields</li>
                    <li><strong>Error Handling:</strong> Display validation errors to users</li>
                    <li><strong>Session Management:</strong> Store and display success/error messages</li>
                    <li><strong>Security:</strong> Input sanitization and XSS prevention</li>
                    <li><strong>Responsive Design:</strong> Works on all device sizes</li>
                    <li><strong>User Experience:</strong> Form data persistence on validation errors</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Client-side validation enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('.btn');
            
            form.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value.trim();
                const email = document.getElementById('email').value.trim();
                const subject = document.getElementById('subject').value.trim();
                const message = document.getElementById('message').value.trim();
                
                let isValid = true;
                
                // Clear previous error styling
                document.querySelectorAll('.form-group input, .form-group textarea').forEach(input => {
                    input.style.borderColor = '#e1e5e9';
                });
                
                // Validate name
                if (name.length < 2) {
                    document.getElementById('name').style.borderColor = '#dc3545';
                    isValid = false;
                }
                
                // Validate email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    document.getElementById('email').style.borderColor = '#dc3545';
                    isValid = false;
                }
                
                // Validate subject
                if (subject.length < 5) {
                    document.getElementById('subject').style.borderColor = '#dc3545';
                    isValid = false;
                }
                
                // Validate message
                if (message.length < 10) {
                    document.getElementById('message').style.borderColor = '#dc3545';
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Please correct the errors before submitting.');
                } else {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Sending...';
                }
            });
        });
    </script>
</body>
</html> 