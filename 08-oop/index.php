<?php
// OOP Concepts Demonstration
class Person {
    // Properties (attributes)
    public $name;
    public $age;
    private $email;
    protected $phone;
    
    // Constructor
    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }
    
    // Methods
    public function getInfo() {
        return "Name: {$this->name}, Age: {$this->age}";
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
}

// Inheritance Example
class Student extends Person {
    private $studentId;
    private $courses = [];
    
    public function __construct($name, $age, $email, $studentId) {
        parent::__construct($name, $age, $email);
        $this->studentId = $studentId;
    }
    
    public function addCourse($course) {
        $this->courses[] = $course;
    }
    
    public function getCourses() {
        return $this->courses;
    }
    
    public function getInfo() {
        return parent::getInfo() . ", Student ID: {$this->studentId}";
    }
}

// Abstract Class Example
abstract class Shape {
    protected $color;
    
    public function __construct($color) {
        $this->color = $color;
    }
    
    abstract public function getArea();
    abstract public function getPerimeter();
    
    public function getColor() {
        return $this->color;
    }
}

class Circle extends Shape {
    private $radius;
    
    public function __construct($color, $radius) {
        parent::__construct($color);
        $this->radius = $radius;
    }
    
    public function getArea() {
        return pi() * $this->radius * $this->radius;
    }
    
    public function getPerimeter() {
        return 2 * pi() * $this->radius;
    }
}

class Rectangle extends Shape {
    private $width;
    private $height;
    
    public function __construct($color, $width, $height) {
        parent::__construct($color);
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getArea() {
        return $this->width * $this->height;
    }
    
    public function getPerimeter() {
        return 2 * ($this->width + $this->height);
    }
}

// Interface Example
interface Logger {
    public function log($message);
    public function getLogs();
}

class FileLogger implements Logger {
    private $logs = [];
    
    public function log($message) {
        $this->logs[] = date('Y-m-d H:i:s') . ": " . $message;
    }
    
    public function getLogs() {
        return $this->logs;
    }
}

// Static Methods Example
class MathUtils {
    public static function add($a, $b) {
        return $a + $b;
    }
    
    public static function multiply($a, $b) {
        return $a * $b;
    }
    
    public static function getPi() {
        return pi();
    }
}

// Magic Methods Example
class MagicExample {
    private $data = [];
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    public function __toString() {
        return "MagicExample with " . count($this->data) . " properties";
    }
}

// Create instances for demonstration
$person1 = new Person("John Doe", 30, "john@example.com");
$person2 = new Person("Jane Smith", 25, "jane@example.com");
$student1 = new Student("Jane Smith", 20, "jane@example.com", "STU001");
$circle = new Circle("Red", 5);
$rectangle = new Rectangle("Blue", 4, 6);
$logger = new FileLogger();
$magic = new MagicExample();

$student1->addCourse("PHP Programming");
$student1->addCourse("Web Development");

$logger->log("Application started");
$logger->log("User logged in");

$magic->name = "John";
$magic->age = 25;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Object-Oriented Programming - Complete Guide</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 PHP Object-Oriented Programming</h1>
            <p>Complete Guide to OOP Concepts with Clear Examples</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../07-database/">← Database</a>
            <a href="../09-error-handling/">Error Handling →</a>
        </div>

        <div class="content">
            <!-- Prerequisites Section -->
            <div class="prerequisites">
                <h3>📚 Prerequisites - What You Should Know Before Learning OOP</h3>
                <ul>
                    <li><strong>PHP Basics:</strong> Variables, data types, operators, and basic syntax</li>
                    <li><strong>Functions:</strong> How to create and use functions, parameters, and return values</li>
                    <li><strong>Arrays:</strong> Working with indexed and associative arrays</li>
                    <li><strong>Control Structures:</strong> If statements, loops, and switch cases</li>
                    <li><strong>Scope:</strong> Understanding variable scope and lifetime</li>
                    <li><strong>Error Handling:</strong> Basic try-catch and error management</li>
                </ul>
            </div>

            <div class="section">
                <h2>🎯 What is Object-Oriented Programming (OOP)?</h2>
                <p>OOP is a programming paradigm that organizes code into objects that contain both data and code. Think of objects as real-world entities with properties (attributes) and behaviors (methods).</p>
                
                <div class="concept-box">
                    <h4>🤔 Why OOP?</h4>
                    <ul>
                        <li><strong>Reusability:</strong> Write code once, use it many times</li>
                        <li><strong>Maintainability:</strong> Easier to modify and update code</li>
                        <li><strong>Scalability:</strong> Build complex applications systematically</li>
                        <li><strong>Organization:</strong> Code is well-structured and logical</li>
                    </ul>
                </div>
            </div>

            <div class="section">
                <h2>🏗️ 1. Classes and Objects</h2>
                <p>A <strong>class</strong> is a blueprint, and an <strong>object</strong> is an instance of that class.</p>
                
                <div class="code-block">
<pre><code>&lt;?php
// Class Definition (Blueprint)
class Person {
    // Properties (attributes)
    public $name;
    public $age;
    private $email;
    
    // Constructor (special method called when creating object)
    public function __construct( 24name,  24age,  24email) {
        24this->name =  24name;
        24this->age =  24age;
        24this->email =  24email;
    }
    
    // Methods (behaviors)
    public function getInfo() {
        return "Name: { 24this->name}, Age: { 24this->age}";
    }
    
    public function getEmail() {
        return  24this->email;
    }
}

// Creating Objects (instances)
 24person1 = new Person("John Doe", 30, "john@example.com");
 24person2 = new Person("Jane Smith", 25, "jane@example.com");
?&gt;</code></pre>
                </div>

                <div class="output">
                    <strong>Live Example:</strong><br>
                    <?php
                    echo "Person 1: " . $person1->getInfo() . "<br>";
                    echo "Person 2: " . $person2->getInfo() . "<br>";
                    echo "Person 1 Email: " . $person1->getEmail() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔒 2. Encapsulation</h2>
                <p>Encapsulation bundles data and methods that operate on that data within a single unit (class). It controls access to data through access modifiers.</p>
                
                <div class="concept-box">
                    <h4>Access Modifiers:</h4>
                    <ul>
                        <li><strong>public:</strong> Accessible from anywhere</li>
                        <li><strong>private:</strong> Only accessible within the class</li>
                        <li><strong>protected:</strong> Accessible within the class and its subclasses</li>
                    </ul>
                </div>

                <div class="code-block">
<pre><code>class BankAccount {
    private $balance = 0;  // Private property
    private $accountNumber;
    
    public function __construct($accountNumber) {
        $this->accountNumber = $accountNumber;
    }
    
    // Getter method (public interface)
    public function getBalance() {
        return $this->balance;
    }
    
    // Setter method with validation
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            return true;
        }
        return false;
    }
    
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }
}
</code></pre>
                </div>
            </div>

            <div class="section">
                <h2>🔄 3. Inheritance</h2>
                <p>Inheritance allows a class to inherit properties and methods from another class. The class being inherited from is called the <strong>parent class</strong>, and the class that inherits is called the <strong>child class</strong>.</p>
                
                <div class="code-block">
<pre><code>// Parent class
class Person {
    public $name;
    public $age;
    
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
    
    public function getInfo() {
        return "Name: {$this->name}, Age: {$this->age}";
    }
}

// Child class inherits from Person
class Student extends Person {
    private $studentId;
    private $courses = [];
    
    public function __construct($name, $age, $studentId) {
        parent::__construct($name, $age);  // Call parent constructor
        $this->studentId = $studentId;
    }
    
    public function addCourse($course) {
        $this->courses[] = $course;
    }
    
    public function getInfo() {
        return parent::getInfo() . ", Student ID: {$this->studentId}";
    }
}
</code></pre>
                </div>

                <div class="output">
                    <strong>Live Example:</strong><br>
                    <?php
                    echo "Student Info: " . $student1->getInfo() . "<br>";
                    echo "Courses: " . implode(", ", $student1->getCourses()) . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎭 4. Polymorphism</h2>
                <p>Polymorphism means "many forms" - the same method can behave differently in different classes.</p>
                
                <div class="code-block">
<pre><code>// Abstract class (cannot be instantiated directly)
abstract class Shape {
    protected $color;
    
    public function __construct($color) {
        $this->color = $color;
    }
    
    // Abstract method (must be implemented by child classes)
    abstract public function getArea();
    
    public function getColor() {
        return $this->color;
    }
}

// Different implementations of getArea()
class Circle extends Shape {
    private $radius;
    
    public function __construct($color, $radius) {
        parent::__construct($color);
        $this->radius = $radius;
    }
    
    public function getArea() {
        return pi() * $this->radius * $this->radius;
    }
}

class Rectangle extends Shape {
    private $width;
    private $height;
    
    public function __construct($color, $width, $height) {
        parent::__construct($color);
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getArea() {
        return $this->width * $this->height;
    }
}
</code></pre>
                </div>

                <div class="output">
                    <strong>Live Example:</strong><br>
                    <?php
                    echo "Circle Area: " . round($circle->getArea(), 2) . " (Color: " . $circle->getColor() . ")<br>";
                    echo "Rectangle Area: " . $rectangle->getArea() . " (Color: " . $rectangle->getColor() . ")<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>📋 5. Interfaces</h2>
                <p>Interfaces define a contract that classes must follow. They specify what methods a class must implement without providing the implementation.</p>
                
                <div class="code-block">
<pre><code>// Interface definition
interface Logger {
    public function log($message);
    public function getLogs();
}

// Class implementing the interface
class FileLogger implements Logger {
    private $logs = [];
    
    public function log($message) {
        $this->logs[] = date('Y-m-d H:i:s') . ": " . $message;
    }
    
    public function getLogs() {
        return $this->logs;
    }
}
</code></pre>
                </div>

                <div class="output">
                    <strong>Live Example:</strong><br>
                    <?php
                    echo "Logs: " . implode("<br>", $logger->getLogs()) . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>⚡ 6. Static Methods and Properties</h2>
                <p>Static methods and properties belong to the class itself, not to instances of the class. They can be called without creating an object.</p>
                
                <div class="code-block">
<pre><code>class MathUtils {
    public static function add($a, $b) {
        return $a + $b;
    }
    
    public static function multiply($a, $b) {
        return $a * $b;
    }
    
    public static function getPi() {
        return pi();
    }
}

// Using static methods
$result = MathUtils::add(5, 3);
$pi = MathUtils::getPi();
</code></pre>
                </div>

                <div class="output">
                    <strong>Live Example:</strong><br>
                    <?php
                    echo "5 + 3 = " . MathUtils::add(5, 3) . "<br>";
                    echo "5 × 3 = " . MathUtils::multiply(5, 3) . "<br>";
                    echo "Pi = " . MathUtils::getPi() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔮 7. Magic Methods</h2>
                <p>Magic methods are special methods that are automatically called in certain situations. They start with double underscores.</p>
                
                <div class="code-block">
<pre><code>class MagicExample {
    private $data = [];
    
    // Called when setting a property
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    // Called when getting a property
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    // Called when object is used as string
    public function __toString() {
        return "MagicExample with " . count($this->data) . " properties";
    }
}

$magic = new MagicExample();
$magic->name = "John";  // Calls __set()
echo $magic->name;      // Calls __get()
echo $magic;            // Calls __toString()
</code></pre>
                </div>

                <div class="output">
                    <strong>Live Example:</strong><br>
                    <?php
                    echo "Magic object: " . $magic . "<br>";
                    echo "Name: " . $magic->name . "<br>";
                    echo "Age: " . $magic->age . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key OOP Principles</h2>
                <div class="concept-box">
                    <h4>SOLID Principles:</h4>
                    <ul>
                        <li><strong>S - Single Responsibility:</strong> Each class should have one reason to change</li>
                        <li><strong>O - Open/Closed:</strong> Open for extension, closed for modification</li>
                        <li><strong>L - Liskov Substitution:</strong> Child classes should be substitutable for parent classes</li>
                        <li><strong>I - Interface Segregation:</strong> Many specific interfaces are better than one general interface</li>
                        <li><strong>D - Dependency Inversion:</strong> Depend on abstractions, not concrete classes</li>
                    </ul>
                </div>
            </div>

            <!-- Project Ideas Section -->
            <div class="project-ideas">
                <h3>🚀 Small Project Ideas to Improve OOP Skills</h3>
                <ul>
                    <li><strong>Calculator Class:</strong> Create a calculator with different operations as methods</li>
                    <li><strong>Book Library:</strong> Manage books with different categories and borrowing system</li>
                    <li><strong>Bank Account System:</strong> Multiple account types with different interest rates</li>
                    <li><strong>Student Management:</strong> Track students, courses, and grades</li>
                    <li><strong>Online Store:</strong> Products, categories, shopping cart, and orders</li>
                    <li><strong>Blog System:</strong> Posts, comments, users, and categories</li>
                    <li><strong>Task Manager:</strong> Projects, tasks, priorities, and deadlines</li>
                    <li><strong>Contact Manager:</strong> Store contacts with different types (personal, business)</li>
                    <li><strong>File Manager:</strong> Organize files with different types and permissions</li>
                    <li><strong>Quiz System:</strong> Questions, answers, categories, and scoring</li>
                </ul>
                
                <h4>🎯 Advanced Project Ideas:</h4>
                <ul>
                    <li><strong>MVC Framework:</strong> Build a simple MVC structure</li>
                    <li><strong>ORM System:</strong> Create a basic Object-Relational Mapping</li>
                    <li><strong>Plugin System:</strong> Design an extensible plugin architecture</li>
                    <li><strong>Event System:</strong> Implement an event-driven architecture</li>
                    <li><strong>Factory Pattern:</strong> Create objects using factory methods</li>
                </ul>
            </div>

            <div class="section">
                <h2>📚 Next Steps</h2>
                <p>Now that you understand OOP concepts, try building the projects above. Start with simple ones and gradually move to more complex applications. Remember:</p>
                <ul>
                    <li>Practice regularly with real-world examples</li>
                    <li>Focus on code organization and reusability</li>
                    <li>Learn design patterns for advanced applications</li>
                    <li>Study existing PHP frameworks to see OOP in action</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 