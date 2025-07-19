<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Error Handling</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Error Handling</h1>
            <p>Try-Catch Blocks, Error Reporting, and Debugging</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../08-oop/">OOP</a>
            <a href="../10-projects/">Projects</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 What is Error Handling?</h2>
                <p>Error handling is the process of responding to and managing errors that occur during program execution. PHP provides several mechanisms for handling errors gracefully.</p>
                
                <div class="warning">
                    <strong>Note:</strong> In this learning environment, we'll demonstrate error handling concepts. Some errors are intentionally triggered for educational purposes.
                </div>
            </div>

            <div class="section">
                <h2>🔍 Error Types in PHP</h2>
                <p>PHP has different types of errors:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// 1. Parse Errors (Fatal) - Syntax errors
// $variable = "Hello World"  // Missing semicolon

// 2. Fatal Errors - Critical errors that stop execution
// undefined_function();  // Function doesn't exist

// 3. Warnings - Non-fatal errors
$result = 10 / 0;  // Division by zero warning

// 4. Notices - Minor issues
echo $undefined_variable;  // Undefined variable notice

// 5. Deprecated - Features that will be removed
// mysql_connect();  // Deprecated function

// 6. User Errors - Custom errors
trigger_error("This is a custom error", E_USER_ERROR);
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Error Types:</strong><br>
                    <?php
                    // Safe demonstration: Suppress actual errors for display
                    echo "✅ <strong>Parse Errors:</strong> Syntax errors that prevent script execution<br>";
                    echo "✅ <strong>Fatal Errors:</strong> Critical errors that stop execution<br>";
                    echo "✅ <strong>Warnings:</strong> Non-fatal errors that don't stop execution<br>";
                    echo "✅ <strong>Notices:</strong> Minor issues and suggestions<br>";
                    echo "✅ <strong>Deprecated:</strong> Features that will be removed in future versions<br>";
                    echo "✅ <strong>User Errors:</strong> Custom errors triggered by developers<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>⚙️ Error Reporting Configuration</h2>
                <p>You can configure how PHP reports errors:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Display all errors (development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Display only errors and warnings
error_reporting(E_ERROR | E_WARNING);

// Display only errors
error_reporting(E_ERROR);

// Turn off error display (production)
ini_set('display_errors', 0);

// Log errors to file
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');

// Custom error handler
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    echo "Error [$errno]: $errstr in $errfile on line $errline&lt;br&gt;";
    return true; // Don't execute PHP's internal error handler
}

set_error_handler("customErrorHandler");
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Current Error Settings:</strong><br>
                    <?php
                    echo "Error reporting level: " . error_reporting() . "<br>";
                    echo "Display errors: " . (ini_get('display_errors') ? 'On' : 'Off') . "<br>";
                    echo "Log errors: " . (ini_get('log_errors') ? 'On' : 'Off') . "<br>";
                    echo "Error log file: " . ini_get('error_log') . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🛡️ Try-Catch Blocks</h2>
                <p>Exception handling with try-catch blocks:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Custom exception class
class CustomException extends Exception {
    public function errorMessage() {
        return "Error on line " . $this->getLine() . " in " . $this->getFile() . ": " . $this->getMessage();
    }
}

// Function that might throw an exception
function divideNumbers($a, $b) {
    if ($b == 0) {
        throw new CustomException("Division by zero is not allowed");
    }
    return $a / $b;
}

// Try-catch block
try {
    $result = divideNumbers(10, 2);
    echo "Result: $result&lt;br&gt;";
    
    $result = divideNumbers(10, 0); // This will throw an exception
    echo "This line won't execute&lt;br&gt;";
} catch (CustomException $e) {
    echo "Custom Exception: " . $e->errorMessage() . "&lt;br&gt;";
} catch (Exception $e) {
    echo "General Exception: " . $e->getMessage() . "&lt;br&gt;";
} finally {
    echo "This always executes&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Try-Catch Example:</strong><br>
                    <?php
                    class CustomException extends Exception {
                        public function errorMessage() {
                            return "Error on line " . $this->getLine() . " in " . $this->getFile() . ": " . $this->getMessage();
                        }
                    }

                    function divideNumbers($a, $b) {
                        if ($b == 0) {
                            throw new CustomException("Division by zero is not allowed");
                        }
                        return $a / $b;
                    }

                    try {
                        $result = divideNumbers(10, 2);
                        echo "Result: $result<br>";
                        // The next line will throw an exception, caught below
                        $result = divideNumbers(10, 0);
                        echo "This won't be executed<br>";
                    } catch (CustomException $e) {
                        echo "Custom Exception: " . htmlspecialchars($e->errorMessage()) . "<br>";
                    } catch (Exception $e) {
                        echo "General Exception: " . htmlspecialchars($e->getMessage()) . "<br>";
                    } finally {
                        echo "This code always executes<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📝 Error Logging</h2>
                <p>Logging errors for debugging and monitoring:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Basic error logging
error_log("This is a test error message");

// Log with different levels
error_log("INFO: User logged in successfully", 0);
error_log("WARNING: Database connection slow", 1);
error_log("ERROR: Failed to save user data", 2);

// Custom logging function
function logError($message, $level = 'ERROR', $context = []) {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] [$level] $message";
    
    if (!empty($context)) {
        $logMessage .= " Context: " . json_encode($context);
    }
    
    error_log($logMessage . PHP_EOL, 3, 'error.log');
}

// Usage
logError("User authentication failed", "ERROR", [
    'user_id' => 123,
    'ip_address' => '192.168.1.1',
    'attempt_time' => time()
]);

// Log exceptions
try {
    $result = 10 / 0;
} catch (Exception $e) {
    logError("Division by zero error: " . $e->getMessage(), "ERROR", [
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Error Logging:</strong><br>
                    <?php
                    function logError($message, $level = 'ERROR', $context = []) {
                        $timestamp = date('Y-m-d H:i:s');
                        $logMessage = "[$timestamp] [$level] $message";
                        if (!empty($context)) {
                            $logMessage .= " Context: " . json_encode($context);
                        }
                        // In a real application, this would write to a file
                        echo "Logged: " . htmlspecialchars($logMessage) . "<br>";
                    }
                    logError("User authentication failed", "ERROR", [
                        'user_id' => 123,
                        'ip_address' => '192.168.1.1',
                        'attempt_time' => time()
                    ]);
                    // Demonstrate error logging without causing a fatal error
                    try {
                        if (0 === 0) {
                            throw new Exception("Division by zero error");
                        }
                    } catch (Exception $e) {
                        logError("Division by zero error: " . $e->getMessage(), "ERROR", [
                            'file' => $e->getFile(),
                            'line' => $e->getLine()
                        ]);
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔧 Debugging Techniques</h2>
                <p>Various debugging methods in PHP:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// 1. var_dump() - Display variable information
$array = [1, 2, 3, 'test'];
var_dump($array);

// 2. print_r() - Print human-readable information
print_r($array);

// 3. debug_backtrace() - Get call stack
function debugFunction() {
    $backtrace = debug_backtrace();
    echo "Call stack:&lt;br&gt;";
    foreach ($backtrace as $trace) {
        echo "- " . $trace['function'] . " in " . $trace['file'] . ":" . $trace['line'] . "&lt;br&gt;";
    }
}

// 4. error_get_last() - Get last error
$result = @(10 / 0); // Suppress error
$lastError = error_get_last();
if ($lastError) {
    echo "Last error: " . $lastError['message'] . "&lt;br&gt;";
}

// 5. Custom debug function
function debug($data, $label = 'Debug') {
    echo "&lt;div style='background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;'&gt;";
    echo "&lt;strong&gt;$label:&lt;/strong&gt;&lt;br&gt;";
    echo "&lt;pre&gt;" . print_r($data, true) . "&lt;/pre&gt;";
    echo "&lt;/div&gt;";
}

// 6. Performance debugging
$startTime = microtime(true);
// ... some code ...
$endTime = microtime(true);
$executionTime = $endTime - $startTime;
echo "Execution time: " . round($executionTime * 1000, 2) . " ms&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Debugging Examples:</strong><br>
                    <?php
                    $array = [1, 2, 3, 'test'];
                    echo "<strong>var_dump() output:</strong><br>";
                    ob_start();
                    var_dump($array);
                    $varDumpOutput = ob_get_clean();
                    echo htmlspecialchars($varDumpOutput) . "<br>";
                    echo "<strong>print_r() output:</strong><br>";
                    echo "<pre>" . htmlspecialchars(print_r($array, true)) . "</pre>";
                    function debug($data, $label = 'Debug') {
                        echo "<div style='background: #37474F; color: #FAFAFA; padding: 10px; margin: 10px 0; border: 1px solid #80CBC4;'>";
                        echo "<strong>" . htmlspecialchars($label) . ":</strong><br>";
                        echo "<pre>" . htmlspecialchars(print_r($data, true)) . "</pre>";
                        echo "</div>";
                    }
                    debug($array, 'Sample Array');
                    $startTime = microtime(true);
                    // Simulate some work
                    usleep(100000); // 0.1 seconds
                    $endTime = microtime(true);
                    $executionTime = $endTime - $startTime;
                    echo "Execution time: " . round($executionTime * 1000, 2) . " ms<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🛠️ Error Handling Best Practices</h2>
                <p>Let's create a comprehensive error handling system:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Custom error handler class
class ErrorHandler {
    private $logFile;
    
    public function __construct($logFile = 'errors.log') {
        $this->logFile = $logFile;
    }
    
    public function handleError($errno, $errstr, $errfile, $errline) {
        $errorType = $this->getErrorType($errno);
        $message = "[$errorType] $errstr in $errfile on line $errline";
        
        // Log the error
        $this->logError($message);
        
        // Display error in development
        if (ini_get('display_errors')) {
            echo "&lt;div style='color: red;'&gt;$message&lt;/div&gt;";
        }
        
        return true; // Don't execute PHP's internal error handler
    }
    
    public function handleException($exception) {
        $message = "Exception: " . $exception->getMessage() . 
                  " in " . $exception->getFile() . 
                  " on line " . $exception->getLine();
        
        $this->logError($message);
        
        if (ini_get('display_errors')) {
            echo "&lt;div style='color: red;'&gt;$message&lt;/div&gt;";
        }
    }
    
    private function getErrorType($errno) {
        switch ($errno) {
            case E_ERROR: return 'ERROR';
            case E_WARNING: return 'WARNING';
            case E_PARSE: return 'PARSE';
            case E_NOTICE: return 'NOTICE';
            case E_CORE_ERROR: return 'CORE_ERROR';
            case E_CORE_WARNING: return 'CORE_WARNING';
            case E_COMPILE_ERROR: return 'COMPILE_ERROR';
            case E_COMPILE_WARNING: return 'COMPILE_WARNING';
            case E_USER_ERROR: return 'USER_ERROR';
            case E_USER_WARNING: return 'USER_WARNING';
            case E_USER_NOTICE: return 'USER_NOTICE';
            case E_STRICT: return 'STRICT';
            case E_RECOVERABLE_ERROR: return 'RECOVERABLE_ERROR';
            case E_DEPRECATED: return 'DEPRECATED';
            case E_USER_DEPRECATED: return 'USER_DEPRECATED';
            default: return 'UNKNOWN';
        }
    }
    
    private function logError($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] $message" . PHP_EOL;
        error_log($logMessage, 3, $this->logFile);
    }
}

// Usage
$errorHandler = new ErrorHandler();
set_error_handler([$errorHandler, 'handleError']);
set_exception_handler([$errorHandler, 'handleException']);
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Error Handler Example:</strong><br>
                    <?php
                    class ErrorHandler {
                        private $logFile;
                        public function __construct($logFile = 'errors.log') {
                            $this->logFile = $logFile;
                        }
                        public function handleError($errno, $errstr, $errfile, $errline) {
                            $errorType = $this->getErrorType($errno);
                            $message = "[$errorType] $errstr in $errfile on line $errline";
                            echo "<div style='color: #FF5252;'>" . htmlspecialchars($message) . "</div>";
                            return true;
                        }
                        public function handleException($exception) {
                            $message = "Exception: " . $exception->getMessage() . 
                                      " in " . $exception->getFile() . 
                                      " on line " . $exception->getLine();
                            echo "<div style='color: #FF5252;'>" . htmlspecialchars($message) . "</div>";
                        }
                        private function getErrorType($errno) {
                            switch ($errno) {
                                case E_ERROR: return 'ERROR';
                                case E_WARNING: return 'WARNING';
                                case E_NOTICE: return 'NOTICE';
                                default: return 'UNKNOWN';
                            }
                        }
                    }
                    $errorHandler = new ErrorHandler();
                    set_error_handler([$errorHandler, 'handleError']);
                    set_exception_handler([$errorHandler, 'handleException']);
                    // Test the error handler (safe demonstration)
                    echo "Testing error handler:<br>";
                    @trigger_error("This is a test notice", E_USER_NOTICE);
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Use <code>try-catch</code> blocks for exception handling</li>
                    <li>Use <code>error_reporting()</code> to configure error levels</li>
                    <li>Use <code>ini_set()</code> to configure error display</li>
                    <li>Use <code>error_log()</code> to log errors</li>
                    <li>Use <code>set_error_handler()</code> for custom error handling</li>
                    <li>Use <code>set_exception_handler()</code> for uncaught exceptions</li>
                    <li>Use <code>var_dump()</code> and <code>print_r()</code> for debugging</li>
                    <li>Use <code>debug_backtrace()</code> to get call stack</li>
                    <li>Always log errors in production environments</li>
                    <li>Don't display sensitive error information to users</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 