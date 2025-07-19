<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Control Structures</title>
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
        .example {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .example h4 {
            margin-top: 0;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Control Structures</h1>
            <p>Conditional Statements, Loops, and Switch Cases</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../01-basics/">Basics</a>
            <a href="../03-functions/">Functions</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🔀 If Statements</h2>
                <p>If statements allow you to execute code conditionally based on whether a condition is true or false.</p>
                
                <div class="code-block">
                    <?php
                        $age = 18;

                        // Simple if statement
                        if ($age >= 18) {
                            echo "You are an adult.&lt;br&gt;";
                        }

                        // If-else statement
                        if ($age >= 18) {
                            echo "You can vote.&lt;br&gt;";
                        } else {
                            echo "You cannot vote yet.&lt;br&gt;";
                        }

                        // If-elseif-else statement
                        $score = 85;
                        if ($score >= 90) {
                            echo "Grade: A&lt;br&gt;";
                        } elseif ($score >= 80) {
                            echo "Grade: B&lt;br&gt;";
                        } elseif ($score >= 70) {
                            echo "Grade: C&lt;br&gt;";
                        } else {
                            echo "Grade: F&lt;br&gt;";
                        }
                    ?>
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $age = 18;

                    if ($age >= 18) {
                        echo "You are an adult.<br>";
                    }

                    if ($age >= 18) {
                        echo "You can vote.<br>";
                    } else {
                        echo "You cannot vote yet.<br>";
                    }

                    $score = 85;
                    if ($score >= 90) {
                        echo "Grade: A<br>";
                    } elseif ($score >= 80) {
                        echo "Grade: B<br>";
                    } elseif ($score >= 70) {
                        echo "Grade: C<br>";
                    } else {
                        echo "Grade: F<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔄 Loops</h2>
                <p>Loops allow you to execute a block of code multiple times.</p>
                
                <h3>For Loop</h3>
                <div class="code-block">
&lt;?php
// For loop - counting from 1 to 5
echo "For loop: ";
for ($i = 1; $i <= 5; $i++) {
    echo $i . " ";
}
echo "&lt;br&gt;";

// For loop with array
$fruits = ["apple", "banana", "orange"];
echo "Fruits: ";
for ($i = 0; $i < count($fruits); $i++) {
    echo $fruits[$i] . " ";
}
echo "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    echo "For loop: ";
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i . " ";
                    }
                    echo "<br>";

                    $fruits = ["apple", "banana", "orange"];
                    echo "Fruits: ";
                    for ($i = 0; $i < count($fruits); $i++) {
                        echo $fruits[$i] . " ";
                    }
                    echo "<br>";
                    ?>
                </div>

                <h3>While Loop</h3>
                <div class="code-block">
&lt;?php
// While loop
$count = 1;
echo "While loop: ";
while ($count <= 3) {
    echo $count . " ";
    $count++;
}
echo "&lt;br&gt;";

// While loop with condition
$number = 10;
echo "Counting down: ";
while ($number > 0) {
    echo $number . " ";
    $number -= 2;
}
echo "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $count = 1;
                    echo "While loop: ";
                    while ($count <= 3) {
                        echo $count . " ";
                        $count++;
                    }
                    echo "<br>";

                    $number = 10;
                    echo "Counting down: ";
                    while ($number > 0) {
                        echo $number . " ";
                        $number -= 2;
                    }
                    echo "<br>";
                    ?>
                </div>

                <h3>Foreach Loop</h3>
                <div class="code-block">
&lt;?php
// Foreach with indexed array
$colors = ["red", "green", "blue"];
echo "Colors: ";
foreach ($colors as $color) {
    echo $color . " ";
}
echo "&lt;br&gt;";

// Foreach with associative array
$person = [
    "name" => "John",
    "age" => 25,
    "city" => "New York"
];
echo "Person details:&lt;br&gt;";
foreach ($person as $key => $value) {
    echo ucfirst($key) . ": " . $value . "&lt;br&gt;";
}
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $colors = ["red", "green", "blue"];
                    echo "Colors: ";
                    foreach ($colors as $color) {
                        echo $color . " ";
                    }
                    echo "<br>";

                    $person = [
                        "name" => "John",
                        "age" => 25,
                        "city" => "New York"
                    ];
                    echo "Person details:<br>";
                    foreach ($person as $key => $value) {
                        echo ucfirst($key) . ": " . $value . "<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔀 Switch Statement</h2>
                <p>Switch statements are useful when you have multiple conditions to check against a single variable.</p>
                
                <div class="code-block">
&lt;?php
$day = "Monday";

switch ($day) {
    case "Monday":
        echo "Start of the work week&lt;br&gt;";
        break;
    case "Tuesday":
    case "Wednesday":
    case "Thursday":
        echo "Middle of the work week&lt;br&gt;";
        break;
    case "Friday":
        echo "TGIF!&lt;br&gt;";
        break;
    case "Saturday":
    case "Sunday":
        echo "Weekend!&lt;br&gt;";
        break;
    default:
        echo "Invalid day&lt;br&gt;";
}

// Switch with numbers
$grade = 85;
switch (true) {
    case $grade >= 90:
        echo "Grade: A&lt;br&gt;";
        break;
    case $grade >= 80:
        echo "Grade: B&lt;br&gt;";
        break;
    case $grade >= 70:
        echo "Grade: C&lt;br&gt;";
        break;
    default:
        echo "Grade: F&lt;br&gt;";
}
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $day = "Monday";

                    switch ($day) {
                        case "Monday":
                            echo "Start of the work week<br>";
                            break;
                        case "Tuesday":
                        case "Wednesday":
                        case "Thursday":
                            echo "Middle of the work week<br>";
                            break;
                        case "Friday":
                            echo "TGIF!<br>";
                            break;
                        case "Saturday":
                        case "Sunday":
                            echo "Weekend!<br>";
                            break;
                        default:
                            echo "Invalid day<br>";
                    }

                    $grade = 85;
                    switch (true) {
                        case $grade >= 90:
                            echo "Grade: A<br>";
                            break;
                        case $grade >= 80:
                            echo "Grade: B<br>";
                            break;
                        case $grade >= 70:
                            echo "Grade: C<br>";
                            break;
                        default:
                            echo "Grade: F<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Comparison Operators</h2>
                <p>PHP provides various operators for comparing values:</p>
                
                <div class="code-block">
&lt;?php
$a = 10;
$b = 5;

echo "a = $a, b = $b&lt;br&gt;";
echo "a == b: " . ($a == $b ? "true" : "false") . "&lt;br&gt;";
echo "a != b: " . ($a != $b ? "true" : "false") . "&lt;br&gt;";
echo "a > b: " . ($a > $b ? "true" : "false") . "&lt;br&gt;";
echo "a < b: " . ($a < $b ? "true" : "false") . "&lt;br&gt;";
echo "a >= b: " . ($a >= $b ? "true" : "false") . "&lt;br&gt;";
echo "a <= b: " . ($a <= $b ? "true" : "false") . "&lt;br&gt;";

// Strict comparison
$c = "10";
echo "&lt;br&gt;c = '$c' (string)&lt;br&gt;";
echo "a == c: " . ($a == $c ? "true" : "false") . "&lt;br&gt;";
echo "a === c: " . ($a === $c ? "true" : "false") . "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    $a = 10;
                    $b = 5;

                    echo "a = $a, b = $b<br>";
                    echo "a == b: " . ($a == $b ? "true" : "false") . "<br>";
                    echo "a != b: " . ($a != $b ? "true" : "false") . "<br>";
                    echo "a > b: " . ($a > $b ? "true" : "false") . "<br>";
                    echo "a < b: " . ($a < $b ? "true" : "false") . "<br>";
                    echo "a >= b: " . ($a >= $b ? "true" : "false") . "<br>";
                    echo "a <= b: " . ($a <= $b ? "true" : "false") . "<br>";

                    $c = "10";
                    echo "<br>c = '$c' (string)<br>";
                    echo "a == c: " . ($a == $c ? "true" : "false") . "<br>";
                    echo "a === c: " . ($a === $c ? "true" : "false") . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Use <code>if</code>, <code>elseif</code>, and <code>else</code> for conditional logic</li>
                    <li><code>for</code> loops are good for counting or when you know the number of iterations</li>
                    <li><code>while</code> loops continue until a condition becomes false</li>
                    <li><code>foreach</code> is perfect for iterating through arrays</li>
                    <li><code>switch</code> statements are cleaner than multiple <code>elseif</code> statements</li>
                    <li>Use <code>===</code> for strict comparison (checks both value and type)</li>
                    <li>Don't forget <code>break</code> statements in switch cases</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 