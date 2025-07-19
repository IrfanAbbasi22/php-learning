<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Operations</title>
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
        .form-group input, .form-group textarea {
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
        .file-info {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .file-info h3 {
            margin-top: 0;
            color: #333;
        }
        .error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP File Operations</h1>
            <p>Reading, Writing, and Manipulating Files</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../05-sessions/">Sessions</a>
            <a href="../07-database/">Database</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 What are File Operations?</h2>
                <p>PHP provides powerful functions to read, write, and manipulate files on the server. This is essential for data storage, configuration files, logs, and more.</p>
                
                <div class="file-info">
                    <h3>Current Directory Information:</h3>
                    <?php
                    echo "<strong>Current Directory:</strong> " . getcwd() . "<br>";
                    echo "<strong>Script Path:</strong> " . __FILE__ . "<br>";
                    echo "<strong>Directory Contents:</strong><br>";
                    
                    $files = scandir('.');
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            $type = is_dir($file) ? 'Directory' : 'File';
                            $size = is_file($file) ? filesize($file) . ' bytes' : '-';
                            echo "- $file ($type) - $size<br>";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📖 Reading Files</h2>
                <p>There are several ways to read files in PHP:</p>
                
                <div class="code-block">
&lt;?php
// Method 1: file_get_contents() - Read entire file into string
$content = file_get_contents('example.txt');
echo "File content: $content&lt;br&gt;";

// Method 2: file() - Read file into array (one line per element)
$lines = file('example.txt');
foreach ($lines as $line) {
    echo "Line: " . trim($line) . "&lt;br&gt;";
}

// Method 3: fopen() and fread() - Read file in chunks
$handle = fopen('example.txt', 'r');
if ($handle) {
    while (!feof($handle)) {
        $chunk = fread($handle, 1024); // Read 1024 bytes at a time
        echo $chunk;
    }
    fclose($handle);
}

// Method 4: fgets() - Read file line by line
$handle = fopen('example.txt', 'r');
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        echo "Line: " . trim($line) . "&lt;br&gt;";
    }
    fclose($handle);
}
?&gt;
                </div>

                <div class="output">
                    <strong>File Reading Examples:</strong><br>
                    <?php
                    // Create a test file
                    $testContent = "Hello World!\nThis is line 2.\nThis is line 3.\n";
                    file_put_contents('test_file.txt', $testContent);
                    
                    echo "<strong>Method 1 - file_get_contents():</strong><br>";
                    $content = file_get_contents('test_file.txt');
                    echo htmlspecialchars($content) . "<br><br>";
                    
                    echo "<strong>Method 2 - file():</strong><br>";
                    $lines = file('test_file.txt');
                    foreach ($lines as $index => $line) {
                        echo "Line " . ($index + 1) . ": " . htmlspecialchars(trim($line)) . "<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>✍️ Writing Files</h2>
                <p>PHP provides various methods to write data to files:</p>
                
                <div class="code-block">
&lt;?php
// Method 1: file_put_contents() - Write entire content at once
$data = "Hello, this is some data to write to a file.\n";
file_put_contents('output.txt', $data);

// Method 2: file_put_contents() with append flag
file_put_contents('output.txt', "This line will be appended.\n", FILE_APPEND);

// Method 3: fopen() and fwrite() - Write in chunks
$handle = fopen('output.txt', 'w');
if ($handle) {
    fwrite($handle, "First line\n");
    fwrite($handle, "Second line\n");
    fwrite($handle, "Third line\n");
    fclose($handle);
}

// Method 4: Append mode
$handle = fopen('output.txt', 'a');
if ($handle) {
    fwrite($handle, "This line is appended.\n");
    fclose($handle);
}
?&gt;
                </div>

                <div class="output">
                    <strong>File Writing Examples:</strong><br>
                    <?php
                    // Write some test data
                    $testData = "This is a test file created by PHP.\n";
                    $testData .= "Current time: " . date('Y-m-d H:i:s') . "\n";
                    $testData .= "Random number: " . rand(1, 100) . "\n";
                    
                    file_put_contents('demo_output.txt', $testData);
                    echo "File 'demo_output.txt' created successfully!<br>";
                    
                    // Append more data
                    file_put_contents('demo_output.txt', "This line was appended.\n", FILE_APPEND);
                    echo "Data appended to file.<br>";
                    
                    // Read and display the file
                    if (file_exists('demo_output.txt')) {
                        echo "<strong>File contents:</strong><br>";
                        echo "<pre>" . htmlspecialchars(file_get_contents('demo_output.txt')) . "</pre>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📁 File and Directory Information</h2>
                <p>PHP provides functions to get information about files and directories:</p>
                
                <div class="code-block">
&lt;?php
$filename = 'example.txt';

// Check if file exists
if (file_exists($filename)) {
    echo "File exists&lt;br&gt;";
    
    // Get file information
    echo "File size: " . filesize($filename) . " bytes&lt;br&gt;";
    echo "Last modified: " . date('Y-m-d H:i:s', filemtime($filename)) . "&lt;br&gt;";
    echo "Last accessed: " . date('Y-m-d H:i:s', fileatime($filename)) . "&lt;br&gt;";
    echo "File permissions: " . substr(sprintf('%o', fileperms($filename)), -4) . "&lt;br&gt;";
    echo "Is readable: " . (is_readable($filename) ? 'Yes' : 'No') . "&lt;br&gt;";
    echo "Is writable: " . (is_writable($filename) ? 'Yes' : 'No') . "&lt;br&gt;";
    echo "Is executable: " . (is_executable($filename) ? 'Yes' : 'No') . "&lt;br&gt;";
    echo "File type: " . filetype($filename) . "&lt;br&gt;";
}

// Directory operations
$dir = '.';
if (is_dir($dir)) {
    echo "Directory contents:&lt;br&gt;";
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $type = is_dir($file) ? 'Directory' : 'File';
            echo "- $file ($type)&lt;br&gt;";
        }
    }
}
?&gt;
                </div>

                <div class="output">
                    <strong>File Information:</strong><br>
                    <?php
                    $testFile = 'test_file.txt';
                    
                    if (file_exists($testFile)) {
                        echo "File exists<br>";
                        echo "File size: " . filesize($testFile) . " bytes<br>";
                        echo "Last modified: " . date('Y-m-d H:i:s', filemtime($testFile)) . "<br>";
                        echo "Is readable: " . (is_readable($testFile) ? 'Yes' : 'No') . "<br>";
                        echo "Is writable: " . (is_writable($testFile) ? 'Yes' : 'No') . "<br>";
                        echo "File type: " . filetype($testFile) . "<br>";
                    } else {
                        echo "File does not exist<br>";
                    }
                    
                    echo "<br><strong>Current Directory Contents:</strong><br>";
                    $files = scandir('.');
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..' && strpos($file, '.txt') !== false) {
                            $type = is_dir($file) ? 'Directory' : 'File';
                            $size = is_file($file) ? filesize($file) . ' bytes' : '-';
                            echo "- $file ($type) - $size<br>";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🗂️ Directory Operations</h2>
                <p>Working with directories in PHP:</p>
                
                <div class="code-block">
&lt;?php
// Create a directory
if (!is_dir('test_directory')) {
    mkdir('test_directory', 0755);
    echo "Directory created&lt;br&gt;";
}

// Create nested directories
if (!is_dir('test_directory/subdir')) {
    mkdir('test_directory/subdir', 0755, true);
    echo "Nested directory created&lt;br&gt;";
}

// List directory contents
function listDirectory($dir) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;
            $type = is_dir($path) ? 'Directory' : 'File';
            echo "- $file ($type)&lt;br&gt;";
        }
    }
}

// Remove directory (must be empty)
if (is_dir('test_directory/subdir')) {
    rmdir('test_directory/subdir');
    echo "Subdirectory removed&lt;br&gt;";
}

// Remove directory and all contents
function removeDirectory($dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $path = $dir . '/' . $file;
                if (is_dir($path)) {
                    removeDirectory($path);
                } else {
                    unlink($path);
                }
            }
        }
        rmdir($dir);
    }
}
?&gt;
                </div>

                <div class="output">
                    <strong>Directory Operations:</strong><br>
                    <?php
                    // Create test directory
                    if (!is_dir('demo_dir')) {
                        mkdir('demo_dir', 0755);
                        echo "Created directory: demo_dir<br>";
                    }
                    
                    // Create a file in the directory
                    file_put_contents('demo_dir/test.txt', 'This is a test file in a directory.');
                    echo "Created file: demo_dir/test.txt<br>";
                    
                    // List directory contents
                    if (is_dir('demo_dir')) {
                        echo "<strong>Contents of demo_dir:</strong><br>";
                        $files = scandir('demo_dir');
                        foreach ($files as $file) {
                            if ($file != '.' && $file != '..') {
                                $path = 'demo_dir/' . $file;
                                $type = is_dir($path) ? 'Directory' : 'File';
                                $size = is_file($path) ? filesize($path) . ' bytes' : '-';
                                echo "- $file ($type) - $size<br>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📤 File Upload Example</h2>
                <p>Let's create a simple file upload form:</p>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="uploaded_file">Select a file to upload:</label>
                        <input type="file" id="uploaded_file" name="uploaded_file" accept=".txt,.pdf,.jpg,.png">
                    </div>
                    
                    <button type="submit" class="btn">Upload File</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['uploaded_file'])) {
                    $file = $_FILES['uploaded_file'];
                    
                    if ($file['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'uploads/';
                        
                        // Create uploads directory if it doesn't exist
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755);
                        }
                        
                        $uploadPath = $uploadDir . basename($file['name']);
                        
                        // Validate file type
                        $allowedTypes = ['text/plain', 'application/pdf', 'image/jpeg', 'image/png'];
                        if (in_array($file['type'], $allowedTypes)) {
                            
                            // Validate file size (max 5MB)
                            if ($file['size'] <= 5 * 1024 * 1024) {
                                
                                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                                    echo '<div class="output">';
                                    echo '<strong>File uploaded successfully!</strong><br>';
                                    echo 'File name: ' . htmlspecialchars($file['name']) . '<br>';
                                    echo 'File size: ' . number_format($file['size']) . ' bytes<br>';
                                    echo 'File type: ' . htmlspecialchars($file['type']) . '<br>';
                                    echo 'Upload path: ' . htmlspecialchars($uploadPath) . '<br>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="error">Failed to move uploaded file.</div>';
                                }
                            } else {
                                echo '<div class="error">File size too large. Maximum size is 5MB.</div>';
                            }
                        } else {
                            echo '<div class="error">Invalid file type. Allowed types: .txt, .pdf, .jpg, .png</div>';
                        }
                    } else {
                        echo '<div class="error">Upload error: ' . $file['error'] . '</div>';
                    }
                }
                
                // Display uploaded files
                if (is_dir('uploads')) {
                    echo '<div class="file-info">';
                    echo '<h3>Uploaded Files:</h3>';
                    $files = scandir('uploads');
                    $hasFiles = false;
                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            $hasFiles = true;
                            $path = 'uploads/' . $file;
                            $size = filesize($path);
                            $modified = date('Y-m-d H:i:s', filemtime($path));
                            echo "- $file ($size bytes, modified: $modified)<br>";
                        }
                    }
                    if (!$hasFiles) {
                        echo "No files uploaded yet.<br>";
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <div class="section">
                <h2>🔧 File Manipulation</h2>
                <p>Advanced file operations:</p>
                
                <div class="code-block">
&lt;?php
// Copy a file
copy('source.txt', 'destination.txt');

// Rename a file
rename('old_name.txt', 'new_name.txt');

// Delete a file
unlink('file_to_delete.txt');

// Get file information
$fileInfo = stat('example.txt');
echo "File size: " . $fileInfo['size'] . " bytes&lt;br&gt;";
echo "Last modified: " . date('Y-m-d H:i:s', $fileInfo['mtime']) . "&lt;br&gt;";

// Check file permissions
$permissions = fileperms('example.txt');
echo "Permissions: " . substr(sprintf('%o', $permissions), -4) . "&lt;br&gt;";

// Change file permissions
chmod('example.txt', 0644);

// Get file owner
$owner = posix_getpwuid(fileowner('example.txt'));
echo "File owner: " . $owner['name'] . "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>File Manipulation Examples:</strong><br>
                    <?php
                    // Create a test file for manipulation
                    $testFile = 'manipulation_test.txt';
                    file_put_contents($testFile, 'This is a test file for manipulation.');
                    
                    if (file_exists($testFile)) {
                        echo "Original file created: $testFile<br>";
                        
                        // Copy the file
                        $copyFile = 'manipulation_test_copy.txt';
                        if (copy($testFile, $copyFile)) {
                            echo "File copied: $copyFile<br>";
                        }
                        
                        // Get file information
                        $fileInfo = stat($testFile);
                        echo "File size: " . $fileInfo['size'] . " bytes<br>";
                        echo "Last modified: " . date('Y-m-d H:i:s', $fileInfo['mtime']) . "<br>";
                        
                        // Check if file is readable/writable
                        echo "Is readable: " . (is_readable($testFile) ? 'Yes' : 'No') . "<br>";
                        echo "Is writable: " . (is_writable($testFile) ? 'Yes' : 'No') . "<br>";
                        
                        // Clean up
                        if (file_exists($copyFile)) {
                            unlink($copyFile);
                            echo "Copy file deleted<br>";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Use <code>file_get_contents()</code> for reading entire files</li>
                    <li>Use <code>file_put_contents()</code> for writing entire files</li>
                    <li>Use <code>fopen()</code>, <code>fread()</code>, <code>fwrite()</code> for large files</li>
                    <li>Always check if files exist before operating on them</li>
                    <li>Use <code>file_exists()</code> to check file existence</li>
                    <li>Use <code>is_dir()</code> to check if path is a directory</li>
                    <li>Use <code>scandir()</code> to list directory contents</li>
                    <li>Use <code>mkdir()</code> to create directories</li>
                    <li>Use <code>rmdir()</code> to remove empty directories</li>
                    <li>Use <code>unlink()</code> to delete files</li>
                    <li>Always validate uploaded files for security</li>
                    <li>Use proper file permissions for security</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 