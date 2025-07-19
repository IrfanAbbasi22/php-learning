<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Functions</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Functions</h1>
            <p>Creating Reusable Code Blocks</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../02-control-structures/">Control Structures</a>
            <a href="../04-forms/">Forms</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 What are Functions?</h2>
                <p>Functions are reusable blocks of code that perform specific tasks. They help organize code, reduce repetition, and make programs easier to maintain.</p>
                
                <div class="example">
                    <h4>Basic Function Structure:</h4>
                    <div class="code-block">
<pre><code>function functionName($parameter1, $parameter2) {
    // Function code here
    return $result;
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>📝 Basic Functions</h2>
                <p>Let's start with simple functions that don't take parameters:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Simple function with no parameters
function sayHello() {
    echo "Hello, World!&lt;br&gt;";
}

// Function that returns a value
function getCurrentTime() {
    return date('Y-m-d H:i:s');
}

// Function with local variable
function countToThree() {
    $count = 0;
    for ($i = 1; $i <= 3; $i++) {
        $count++;
        echo "Count: $count&lt;br&gt;";
    }
}

// Calling functions
sayHello();
echo "Current time: " . getCurrentTime() . "&lt;br&gt;";
countToThree();
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    function sayHello() {
                        echo "Hello, World!<br>";
                    }

                    function getCurrentTime() {
                        return date('Y-m-d H:i:s');
                    }

                    function countToThree() {
                        $count = 0;
                        for ($i = 1; $i <= 3; $i++) {
                            $count++;
                            echo "Count: $count<br>";
                        }
                    }

                    sayHello();
                    echo "Current time: " . getCurrentTime() . "<br>";
                    countToThree();
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔧 Functions with Parameters</h2>
                <p>Functions can accept parameters (arguments) to make them more flexible:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Function with one parameter
function greet($name) {
    echo "Hello, $name!&lt;br&gt;";
}

// Function with multiple parameters
function add($a, $b) {
    return $a + $b;
}

// Function with default parameter
function greetWithDefault($name = "Guest") {
    echo "Hello, $name!&lt;br&gt;";
}

// Function with type hinting (PHP 7+)
function multiply(int $a, int $b): int {
    return $a * $b;
}

// Calling functions with parameters
greet("John");
echo "Sum: " . add(5, 3) . "&lt;br&gt;";
greetWithDefault();
greetWithDefault("Alice");
echo "Product: " . multiply(4, 6) . "&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    function greet($name) {
                        echo "Hello, $name!<br>";
                    }

                    function add($a, $b) {
                        return $a + $b;
                    }

                    function greetWithDefault($name = "Guest") {
                        echo "Hello, $name!<br>";
                    }

                    function multiply(int $a, int $b): int {
                        return $a * $b;
                    }

                    greet("John");
                    echo "Sum: " . add(5, 3) . "<br>";
                    greetWithDefault();
                    greetWithDefault("Alice");
                    echo "Product: " . multiply(4, 6) . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📊 Functions with Arrays</h2>
                <p>Functions can work with arrays and return multiple values:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Function that processes an array
function calculateStats($numbers) {
    $sum = array_sum($numbers);
    $count = count($numbers);
    $average = $count > 0 ? $sum / $count : 0;
    $max = max($numbers);
    $min = min($numbers);
    
    return [
        'sum' => $sum,
        'count' => $count,
        'average' => $average,
        'max' => $max,
        'min' => $min
    ];
}

// Function that filters array
function filterEvenNumbers($numbers) {
    $evenNumbers = [];
    foreach ($numbers as $number) {
        if ($number % 2 == 0) {
            $evenNumbers[] = $number;
        }
    }
    return $evenNumbers;
}

// Using the functions
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$stats = calculateStats($numbers);
$evenNumbers = filterEvenNumbers($numbers);

echo "Numbers: " . implode(", ", $numbers) . "&lt;br&gt;";
echo "Sum: " . $stats['sum'] . "&lt;br&gt;";
echo "Average: " . $stats['average'] . "&lt;br&gt;";
echo "Even numbers: " . implode(", ", $evenNumbers) . "&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    function calculateStats($numbers) {
                        $sum = array_sum($numbers);
                        $count = count($numbers);
                        $average = $count > 0 ? $sum / $count : 0;
                        $max = max($numbers);
                        $min = min($numbers);
                        
                        return [
                            'sum' => $sum,
                            'count' => $count,
                            'average' => $average,
                            'max' => $max,
                            'min' => $min
                        ];
                    }

                    function filterEvenNumbers($numbers) {
                        $evenNumbers = [];
                        foreach ($numbers as $number) {
                            if ($number % 2 == 0) {
                                $evenNumbers[] = $number;
                            }
                        }
                        return $evenNumbers;
                    }

                    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                    $stats = calculateStats($numbers);
                    $evenNumbers = filterEvenNumbers($numbers);

                    echo "Numbers: " . implode(", ", $numbers) . "<br>";
                    echo "Sum: " . $stats['sum'] . "<br>";
                    echo "Average: " . $stats['average'] . "<br>";
                    echo "Even numbers: " . implode(", ", $evenNumbers) . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🌐 Variable Scope</h2>
                <p>Understanding how variables work inside and outside functions:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Global variable
$globalVar = "I'm global";

function testScope() {
    // Local variable
    $localVar = "I'm local";
    echo "Local: $localVar&lt;br&gt;";
    
    // Access global variable
    global $globalVar;
    echo "Global: $globalVar&lt;br&gt;";
}

// Static variable
function counter() {
    static $count = 0;
    $count++;
    echo "Count: $count&lt;br&gt;";
}

// Test scope
testScope();
echo "Outside function - Global: $globalVar&lt;br&gt;";

// Test static variable
counter();
counter();
counter();
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $globalVar = "I'm global";

                    function testScope() {
                        // Local variable
                        $localVar = "I'm local";
                        echo "Local: $localVar<br>";
                        
                        // Access global variable
                        global $globalVar;
                        echo "Global: $globalVar<br>";
                    }

                    // Static variable
                    function counter() {
                        static $count = 0;
                        $count++;
                        echo "Count: $count<br>";
                    }

                    // Test scope
                    testScope();
                    echo "Outside function - Global: $globalVar<br>";

                    // Test static variable
                    counter();
                    counter();
                    counter();
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔄 Recursive Functions</h2>
                <p>Functions that call themselves (useful for complex algorithms):</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Recursive function - factorial
function factorial($n) {
    if ($n <= 1) return 1;
    return $n * factorial($n - 1);
}

// Recursive function - fibonacci
function fibonacci($n) {
    if ($n <= 1) return $n;
    return fibonacci($n - 1) + fibonacci($n - 2);
}

// Recursive function - count array elements
function countArray($array) {
    if (empty($array)) return 0;
    return 1 + countArray(array_slice($array, 1));
}

// Test recursive functions
echo "Factorial of 5: " . factorial(5) . "&lt;br&gt;";
echo "Fibonacci(6): " . fibonacci(6) . "&lt;br&gt;";
echo "Array count: " . countArray([1, 2, 3, 4, 5]) . "&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    function factorial($n) {
                        if ($n <= 1) return 1;
                        return $n * factorial($n - 1);
                    }

                    function fibonacci($n) {
                        if ($n <= 1) return $n;
                        return fibonacci($n - 1) + fibonacci($n - 2);
                    }

                    function countArray($array) {
                        if (empty($array)) return 0;
                        return 1 + countArray(array_slice($array, 1));
                    }

                    echo "Factorial of 5: " . factorial(5) . "<br>";
                    echo "Fibonacci(6): " . fibonacci(6) . "<br>";
                    echo "Array count: " . countArray([1, 2, 3, 4, 5]) . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Anonymous Functions (Closures)</h2>
                <p>Functions without names, useful for callbacks and modern PHP:</p>
                
                <div class="code-block">
&lt;?php
// Anonymous function
$greet = function($name) {
    echo "Hello, $name!&lt;br&gt;";
};

// Arrow function (PHP 7.4+)
$add = fn($a, $b) => $a + $b;

// Using anonymous functions with array functions
$numbers = [1, 2, 3, 4, 5];

// Map function
$squared = array_map(function($n) {
    return $n * $n;
}, $numbers);

// Filter function
$evenNumbers = array_filter($numbers, function($n) {
    return $n % 2 == 0;
});

// Test anonymous functions
$greet("World");
echo "Sum: " . $add(10, 20) . "&lt;br&gt;";
echo "Squared numbers: " . implode(', ', $squared) . "&lt;br&gt;";
echo "Even numbers: " . implode(', ', $evenNumbers) . "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $greet = function($name) {
                        echo "Hello, $name!<br>";
                    };

                    $add = fn($a, $b) => $a + $b;

                    $numbers = [1, 2, 3, 4, 5];

                    $squared = array_map(function($n) {
                        return $n * $n;
                    }, $numbers);

                    $evenNumbers = array_filter($numbers, function($n) {
                        return $n % 2 == 0;
                    });

                    $greet("World");
                    echo "Sum: " . $add(10, 20) . "<br>";
                    echo "Squared numbers: " . implode(', ', $squared) . "<br>";
                    echo "Even numbers: " . implode(', ', $evenNumbers) . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Functions help organize and reuse code</li>
                    <li>Use <code>function</code> keyword to define functions</li>
                    <li>Parameters make functions flexible and reusable</li>
                    <li>Use <code>return</code> to send values back from functions</li>
                    <li>Variables inside functions are local by default</li>
                    <li>Use <code>global</code> keyword to access global variables</li>
                    <li>Static variables retain their value between function calls</li>
                    <li>Recursive functions call themselves (be careful with infinite loops)</li>
                    <li>Anonymous functions are useful for callbacks and modern PHP</li>
                    <li>Type hints help with code clarity and error prevention</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 