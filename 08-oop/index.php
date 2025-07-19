<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Object-Oriented Programming</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PHP Object-Oriented Programming</h1>
            <p>Classes, Objects, Inheritance, and Encapsulation</p>
        </div>
        
        <div class="nav">
            <a href="../index.html">← Back to Learning Hub</a>
            <a href="../07-database/">Database</a>
            <a href="../09-error-handling/">Error Handling</a>
        </div>

        <div class="content">
            <div class="section">
                <h2>🎯 What is OOP?</h2>
                <p>Object-Oriented Programming (OOP) is a programming paradigm that organizes code into objects that contain data and code. PHP supports OOP with classes, objects, inheritance, and more.</p>
                
                <div class="code-block">
// Basic class structure
class ClassName {
    // Properties (variables)
    public $property;
    private $privateProperty;
    
    // Methods (functions)
    public function methodName() {
        // Method code
    }
    
    // Constructor
    public function __construct() {
        // Initialization code
    }
}
                </div>
            </div>

            <div class="section">
                <h2>📝 Basic Classes and Objects</h2>
                <p>Let's start with a simple class:</p>
                
                <div class="code-block">
&lt;?php
// Define a simple class
class Person {
    // Properties
    public $name;
    public $age;
    private $email;
    
    // Constructor
    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }
    
    // Method to get person info
    public function getInfo() {
        return "Name: {$this->name}, Age: {$this->age}";
    }
    
    // Method to get email (private property access)
    public function getEmail() {
        return $this->email;
    }
    
    // Method to set email
    public function setEmail($email) {
        $this->email = $email;
    }
}

// Create objects (instances)
$person1 = new Person("John Doe", 30, "john@example.com");
$person2 = new Person("Jane Smith", 25, "jane@example.com");

// Access properties and methods
echo $person1->name . "&lt;br&gt;";
echo $person1->getInfo() . "&lt;br&gt;";
echo $person1->getEmail() . "&lt;br&gt;";

$person1->setEmail("john.updated@example.com");
echo "Updated email: " . $person1->getEmail() . "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    class Person {
                        public $name;
                        public $age;
                        private $email;
                        
                        public function __construct($name, $age, $email) {
                            $this->name = $name;
                            $this->age = $age;
                            $this->email = $email;
                        }
                        
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

                    $person1 = new Person("John Doe", 30, "john@example.com");
                    $person2 = new Person("Jane Smith", 25, "jane@example.com");

                    echo $person1->name . "<br>";
                    echo $person1->getInfo() . "<br>";
                    echo $person1->getEmail() . "<br>";

                    $person1->setEmail("john.updated@example.com");
                    echo "Updated email: " . $person1->getEmail() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔒 Encapsulation</h2>
                <p>Encapsulation is the bundling of data and methods that operate on that data within a single unit (class):</p>
                
                <div class="code-block">
&lt;?php
class BankAccount {
    private $balance = 0;
    private $accountNumber;
    
    public function __construct($accountNumber) {
        $this->accountNumber = $accountNumber;
    }
    
    // Getter method
    public function getBalance() {
        return $this->balance;
    }
    
    public function getAccountNumber() {
        return $this->accountNumber;
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

// Create bank account
$account = new BankAccount("123456789");

echo "Account: " . $account->getAccountNumber() . "&lt;br&gt;";
echo "Initial balance: $" . $account->getBalance() . "&lt;br&gt;";

$account->deposit(1000);
echo "After deposit: $" . $account->getBalance() . "&lt;br&gt;";

$account->withdraw(500);
echo "After withdrawal: $" . $account->getBalance() . "&lt;br&gt;";

// This would cause an error (private property)
// echo $account->balance;
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    class BankAccount {
                        private $balance = 0;
                        private $accountNumber;
                        
                        public function __construct($accountNumber) {
                            $this->accountNumber = $accountNumber;
                        }
                        
                        public function getBalance() {
                            return $this->balance;
                        }
                        
                        public function getAccountNumber() {
                            return $this->accountNumber;
                        }
                        
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

                    $account = new BankAccount("123456789");

                    echo "Account: " . $account->getAccountNumber() . "<br>";
                    echo "Initial balance: $" . $account->getBalance() . "<br>";

                    $account->deposit(1000);
                    echo "After deposit: $" . $account->getBalance() . "<br>";

                    $account->withdraw(500);
                    echo "After withdrawal: $" . $account->getBalance() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔄 Inheritance</h2>
                <p>Inheritance allows a class to inherit properties and methods from another class:</p>
                
                <div class="code-block">
&lt;?php
// Parent class
class Animal {
    protected $name;
    protected $species;
    
    public function __construct($name, $species) {
        $this->name = $name;
        $this->species = $species;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getSpecies() {
        return $this->species;
    }
    
    public function makeSound() {
        return "Some animal sound";
    }
    
    public function getInfo() {
        return "Name: {$this->name}, Species: {$this->species}";
    }
}

// Child class inheriting from Animal
class Dog extends Animal {
    private $breed;
    
    public function __construct($name, $breed) {
        parent::__construct($name, "Dog");
        $this->breed = $breed;
    }
    
    public function getBreed() {
        return $this->breed;
    }
    
    // Override parent method
    public function makeSound() {
        return "Woof!";
    }
    
    // Override parent method and extend it
    public function getInfo() {
        return parent::getInfo() . ", Breed: {$this->breed}";
    }
}

// Another child class
class Cat extends Animal {
    private $color;
    
    public function __construct($name, $color) {
        parent::__construct($name, "Cat");
        $this->color = $color;
    }
    
    public function getColor() {
        return $this->color;
    }
    
    public function makeSound() {
        return "Meow!";
    }
    
    public function getInfo() {
        return parent::getInfo() . ", Color: {$this->color}";
    }
}

// Create objects
$dog = new Dog("Buddy", "Golden Retriever");
$cat = new Cat("Whiskers", "Orange");

echo $dog->getInfo() . "&lt;br&gt;";
echo "Sound: " . $dog->makeSound() . "&lt;br&gt;";

echo $cat->getInfo() . "&lt;br&gt;";
echo "Sound: " . $cat->makeSound() . "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    class Animal {
                        protected $name;
                        protected $species;
                        
                        public function __construct($name, $species) {
                            $this->name = $name;
                            $this->species = $species;
                        }
                        
                        public function getName() {
                            return $this->name;
                        }
                        
                        public function getSpecies() {
                            return $this->species;
                        }
                        
                        public function makeSound() {
                            return "Some animal sound";
                        }
                        
                        public function getInfo() {
                            return "Name: {$this->name}, Species: {$this->species}";
                        }
                    }

                    class Dog extends Animal {
                        private $breed;
                        
                        public function __construct($name, $breed) {
                            parent::__construct($name, "Dog");
                            $this->breed = $breed;
                        }
                        
                        public function getBreed() {
                            return $this->breed;
                        }
                        
                        public function makeSound() {
                            return "Woof!";
                        }
                        
                        public function getInfo() {
                            return parent::getInfo() . ", Breed: {$this->breed}";
                        }
                    }

                    class Cat extends Animal {
                        private $color;
                        
                        public function __construct($name, $color) {
                            parent::__construct($name, "Cat");
                            $this->color = $color;
                        }
                        
                        public function getColor() {
                            return $this->color;
                        }
                        
                        public function makeSound() {
                            return "Meow!";
                        }
                        
                        public function getInfo() {
                            return parent::getInfo() . ", Color: {$this->color}";
                        }
                    }

                    $dog = new Dog("Buddy", "Golden Retriever");
                    $cat = new Cat("Whiskers", "Orange");

                    echo $dog->getInfo() . "<br>";
                    echo "Sound: " . $dog->makeSound() . "<br>";

                    echo $cat->getInfo() . "<br>";
                    echo "Sound: " . $cat->makeSound() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Polymorphism</h2>
                <p>Polymorphism allows objects of different classes to be treated as objects of a common parent class:</p>
                
                <div class="code-block">
&lt;?php
// Abstract class (cannot be instantiated directly)
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

// Polymorphism in action
$shapes = [
    new Circle("Red", 5),
    new Rectangle("Blue", 4, 6),
    new Circle("Green", 3)
];

foreach ($shapes as $shape) {
    echo "Color: " . $shape->getColor() . ", Area: " . round($shape->getArea(), 2) . "&lt;br&gt;";
}
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    abstract class Shape {
                        protected $color;
                        
                        public function __construct($color) {
                            $this->color = $color;
                        }
                        
                        abstract public function getArea();
                        
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

                    $shapes = [
                        new Circle("Red", 5),
                        new Rectangle("Blue", 4, 6),
                        new Circle("Green", 3)
                    ];

                    foreach ($shapes as $shape) {
                        echo "Color: " . $shape->getColor() . ", Area: " . round($shape->getArea(), 2) . "<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🔧 Static Methods and Properties</h2>
                <p>Static methods and properties belong to the class itself, not to instances:</p>
                
                <div class="code-block">
&lt;?php
class MathUtils {
    // Static property
    public static $pi = 3.14159;
    
    // Static method
    public static function add($a, $b) {
        return $a + $b;
    }
    
    public static function multiply($a, $b) {
        return $a * $b;
    }
    
    public static function getPi() {
        return self::$pi;
    }
}

class User {
    private static $userCount = 0;
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
        self::$userCount++;
    }
    
    public static function getUserCount() {
        return self::$userCount;
    }
    
    public function getName() {
        return $this->name;
    }
}

// Using static methods and properties
echo "PI: " . MathUtils::$pi . "&lt;br&gt;";
echo "5 + 3 = " . MathUtils::add(5, 3) . "&lt;br&gt;";
echo "4 * 7 = " . MathUtils::multiply(4, 7) . "&lt;br&gt;";

// Using static property in class
echo "PI from method: " . MathUtils::getPi() . "&lt;br&gt;";

// User count example
echo "Initial user count: " . User::getUserCount() . "&lt;br&gt;";

$user1 = new User("John");
$user2 = new User("Jane");
$user3 = new User("Bob");

echo "Current user count: " . User::getUserCount() . "&lt;br&gt;";
echo "User 1 name: " . $user1->getName() . "&lt;br&gt;";
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    class MathUtils {
                        public static $pi = 3.14159;
                        
                        public static function add($a, $b) {
                            return $a + $b;
                        }
                        
                        public static function multiply($a, $b) {
                            return $a * $b;
                        }
                        
                        public static function getPi() {
                            return self::$pi;
                        }
                    }

                    class User {
                        private static $userCount = 0;
                        private $name;
                        
                        public function __construct($name) {
                            $this->name = $name;
                            self::$userCount++;
                        }
                        
                        public static function getUserCount() {
                            return self::$userCount;
                        }
                        
                        public function getName() {
                            return $this->name;
                        }
                    }

                    echo "PI: " . MathUtils::$pi . "<br>";
                    echo "5 + 3 = " . MathUtils::add(5, 3) . "<br>";
                    echo "4 * 7 = " . MathUtils::multiply(4, 7) . "<br>";
                    echo "PI from method: " . MathUtils::getPi() . "<br>";

                    echo "Initial user count: " . User::getUserCount() . "<br>";

                    $user1 = new User("John");
                    $user2 = new User("Jane");
                    $user3 = new User("Bob");

                    echo "Current user count: " . User::getUserCount() . "<br>";
                    echo "User 1 name: " . $user1->getName() . "<br>";
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Interfaces</h2>
                <p>Interfaces define a contract that classes must implement:</p>
                
                <div class="code-block">
&lt;?php
// Define an interface
interface Logger {
    public function log($message);
    public function getLogs();
}

interface Database {
    public function connect();
    public function query($sql);
    public function disconnect();
}

// Class implementing multiple interfaces
class FileLogger implements Logger {
    private $logs = [];
    
    public function log($message) {
        $this->logs[] = date('Y-m-d H:i:s') . ": " . $message;
    }
    
    public function getLogs() {
        return $this->logs;
    }
}

class DatabaseLogger implements Logger, Database {
    private $logs = [];
    private $connection;
    
    public function connect() {
        $this->connection = "Connected to database";
        $this->log("Database connected");
    }
    
    public function query($sql) {
        $this->log("Executing query: " . $sql);
        return "Query result";
    }
    
    public function disconnect() {
        $this->log("Database disconnected");
        $this->connection = null;
    }
    
    public function log($message) {
        $this->logs[] = date('Y-m-d H:i:s') . ": " . $message;
    }
    
    public function getLogs() {
        return $this->logs;
    }
}

// Using the classes
$fileLogger = new FileLogger();
$fileLogger->log("Application started");
$fileLogger->log("User logged in");

$dbLogger = new DatabaseLogger();
$dbLogger->connect();
$dbLogger->query("SELECT * FROM users");
$dbLogger->disconnect();

echo "File Logger Logs:&lt;br&gt;";
foreach ($fileLogger->getLogs() as $log) {
    echo "- $log&lt;br&gt;";
}

echo "&lt;br&gt;Database Logger Logs:&lt;br&gt;";
foreach ($dbLogger->getLogs() as $log) {
    echo "- $log&lt;br&gt;";
}
?&gt;
                </div>

                <div class="output">
                    <strong>Output:</strong><br>
                    <?php
                    interface Logger {
                        public function log($message);
                        public function getLogs();
                    }

                    interface Database {
                        public function connect();
                        public function query($sql);
                        public function disconnect();
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

                    class DatabaseLogger implements Logger, Database {
                        private $logs = [];
                        private $connection;
                        
                        public function connect() {
                            $this->connection = "Connected to database";
                            $this->log("Database connected");
                        }
                        
                        public function query($sql) {
                            $this->log("Executing query: " . $sql);
                            return "Query result";
                        }
                        
                        public function disconnect() {
                            $this->log("Database disconnected");
                            $this->connection = null;
                        }
                        
                        public function log($message) {
                            $this->logs[] = date('Y-m-d H:i:s') . ": " . $message;
                        }
                        
                        public function getLogs() {
                            return $this->logs;
                        }
                    }

                    $fileLogger = new FileLogger();
                    $fileLogger->log("Application started");
                    $fileLogger->log("User logged in");

                    $dbLogger = new DatabaseLogger();
                    $dbLogger->connect();
                    $dbLogger->query("SELECT * FROM users");
                    $dbLogger->disconnect();

                    echo "File Logger Logs:<br>";
                    foreach ($fileLogger->getLogs() as $log) {
                        echo "- $log<br>";
                    }

                    echo "<br>Database Logger Logs:<br>";
                    foreach ($dbLogger->getLogs() as $log) {
                        echo "- $log<br>";
                    }
                    ?>
                </div>
            </div>

            <div class="section">
                <h2>🎯 Key Points to Remember</h2>
                <ul>
                    <li>Use <code>class</code> keyword to define classes</li>
                    <li>Use <code>new</code> keyword to create objects</li>
                    <li>Use <code>public</code>, <code>private</code>, <code>protected</code> for visibility</li>
                    <li>Use <code>extends</code> for inheritance</li>
                    <li>Use <code>implements</code> for interfaces</li>
                    <li>Use <code>abstract</code> for abstract classes and methods</li>
                    <li>Use <code>static</code> for class-level properties and methods</li>
                    <li>Use <code>$this</code> to refer to current object</li>
                    <li>Use <code>parent::</code> to call parent class methods</li>
                    <li>Use <code>self::</code> to access static members</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html> 