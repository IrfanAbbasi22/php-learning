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
        &lt;h3&gt;Contact Form Submission&lt;/h3&gt;
        &lt;p&gt;&lt;strong&gt;Name:&lt;/strong&gt; " . htmlspecialchars($name) . "&lt;/p&gt;
        &lt;p&gt;&lt;strong&gt;Email:&lt;/strong&gt; " . htmlspecialchars($email) . "&lt;/p&gt;
        &lt;p&gt;&lt;strong&gt;Subject:&lt;/strong&gt; " . htmlspecialchars($subject) . "&lt;/p&gt;
        &lt;p&gt;&lt;strong&gt;Message:&lt;/strong&gt;&lt;/p&gt;
        &lt;p&gt;" . nl2br(htmlspecialchars($message)) . "&lt;/p&gt;
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
    <title>Contact Form - PHP Project</title>
    <link rel="stylesheet" href="../../style.css">
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