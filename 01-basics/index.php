<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basics - Variables & Data Types</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Basics</h1>
            <p>Variables, Data Types, and Basic Syntax</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="variables.php">Variables</a>
            <a href="data-types.php">Data Types</a>
            <a href="operators.php">Operators</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 What is PHP?</h2>
                <p>PHP (Hypertext Preprocessor) is a server-side scripting language designed for web development. It can be embedded into HTML and is widely used for creating dynamic websites.</p>
                
                <div class="example">
                    <h4>Basic PHP Structure:</h4>
                    <div class="code-block">
<pre><code>&lt;?php
// This is a PHP comment
echo "Hello, World!";
?&gt;</code></pre>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>📝 Variables</h2>
                <p>Variables in PHP start with a dollar sign ($) and can store different types of data.</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Variable declaration
$name = "John";
$age = 25;
$height = 5.9;
$isStudent = true;

// Displaying variables
echo "Name: " . $name . "&lt;br&gt;";
echo "Age: " . $age . "&lt;br&gt;";
echo "Height: " . $height . "&lt;br&gt;";
echo "Is Student: " . ($isStudent ? "Yes" : "No") . "&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $name = "John";
                    $age = 25;
                    $height = 5.9;
                    $isStudent = true;

                    echo "Name: " . $name . "<br>";
                    echo "Age: " . $age . "<br>";
                    echo "Height: " . $height . "<br>";
                    echo "Is Student: " . ($isStudent ? "Yes" : "No") . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔤 Data Types</h2>
                <p>PHP supports several data types. Here are the most common ones:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// String
$text = "Hello World";
echo "String: " . $text . "&lt;br&gt;";

// Integer
$number = 42;
echo "Integer: " . $number . "&lt;br&gt;";

// Float
$decimal = 3.14;
echo "Float: " . $decimal . "&lt;br&gt;";

// Boolean
$true = true;
$false = false;
echo "Boolean true: " . ($true ? "true" : "false") . "&lt;br&gt;";
echo "Boolean false: " . ($false ? "true" : "false") . "&lt;br&gt;";

// Array
$colors = ["red", "green", "blue"];
echo "Array: " . implode(", ", $colors) . "&lt;br&gt;";

// Null
$empty = null;
echo "Null: " . (is_null($empty) ? "null" : "not null") . "&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $text = "Hello World";
                    echo "String: " . $text . "<br>";

                    $number = 42;
                    echo "Integer: " . $number . "<br>";

                    $decimal = 3.14;
                    echo "Float: " . $decimal . "<br>";

                    $true = true;
                    $false = false;
                    echo "Boolean true: " . ($true ? "true" : "false") . "<br>";
                    echo "Boolean false: " . ($false ? "true" : "false") . "<br>";

                    $colors = ["red", "green", "blue"];
                    echo "Array: " . implode(", ", $colors) . "<br>";

                    $empty = null;
                    echo "Null: " . (is_null($empty) ? "null" : "not null") . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔗 String Concatenation</h2>
                <p>PHP uses the dot (.) operator to concatenate strings:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
$firstName = "John";
$lastName = "Doe";
$fullName = $firstName . " " . $lastName;
echo "Full Name: " . $fullName . "&lt;br&gt;";

// Using double quotes for variable interpolation
echo "Hello, $firstName!&lt;br&gt;";
echo "Welcome, {$firstName} {$lastName}!&lt;br&gt;";
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $firstName = "John";
                    $lastName = "Doe";
                    $fullName = $firstName . " " . $lastName;
                    echo "Full Name: " . $fullName . "<br>";

                    echo "Hello, $firstName!<br>";
                    echo "Welcome, {$firstName} {$lastName}!<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📊 Arrays</h2>
                <p>Arrays can store multiple values. PHP supports both indexed and associative arrays:</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Indexed array
$fruits = ["apple", "banana", "orange"];
echo "Fruits: " . implode(", ", $fruits) . "&lt;br&gt;";

// Associative array
$person = [
    "name" => "John",
    "age" => 30,
    "city" => "New York"
];
echo "Person: " . $person["name"] . " is " . $person["age"] . " years old.&lt;br&gt;";

// Multidimensional array
$students = [
    ["name" => "Alice", "grade" => 85],
    ["name" => "Bob", "grade" => 92],
    ["name" => "Charlie", "grade" => 78]
];

foreach ($students as $student) {
    echo $student["name"] . " got " . $student["grade"] . "&lt;br&gt;";
}
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $fruits = ["apple", "banana", "orange"];
                    echo "Fruits: " . implode(", ", $fruits) . "<br>";
                    echo "First fruit: " . $fruits[0] . "<br>";

                    $person = [
                        "name" => "John",
                        "age" => 25,
                        "city" => "New York"
                    ];
                    echo "Name: " . $person["name"] . "<br>";
                    echo "Age: " . $person["age"] . "<br>";
                    echo "City: " . $person["city"] . "<br>";

                    $students = [
                        ["name" => "John", "grade" => 85],
                        ["name" => "Jane", "grade" => 92],
                        ["name" => "Bob", "grade" => 78]
                    ];

                    foreach ($students as $student) {
                        echo $student["name"] . " - Grade: " . $student["grade"] . "<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>PHP code is enclosed in <code>&lt;?php ?&gt;</code> tags</li>
                    <li>Variables start with <code>$</code> and are case-sensitive</li>
                    <li>Statements end with semicolons <code>;</code></li>
                    <li>Use <code>echo</code> or <code>print</code> to output data</li>
                    <li>Comments start with <code>//</code> or <code>/* */</code></li>
                    <li>Strings can use single or double quotes</li>
                    <li>Arrays can be indexed or associative</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 