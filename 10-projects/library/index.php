<?php
session_start();

// Abstract base class for library items
abstract class LibraryItem {
    protected $id;
    protected $title;
    protected $isAvailable;
    protected $borrowedBy;
    protected $borrowedDate;
    
    public function __construct($id, $title) {
        $this->id = $id;
        $this->title = $title;
        $this->isAvailable = true;
        $this->borrowedBy = null;
        $this->borrowedDate = null;
    }
    
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function isAvailable() { return $this->isAvailable; }
    public function getBorrowedBy() { return $this->borrowedBy; }
    public function getBorrowedDate() { return $this->borrowedDate; }
    
    public function borrow($memberName) {
        if ($this->isAvailable) {
            $this->isAvailable = false;
            $this->borrowedBy = $memberName;
            $this->borrowedDate = date('Y-m-d H:i:s');
            return true;
        }
        return false;
    }
    
    public function return() {
        if (!$this->isAvailable) {
            $this->isAvailable = true;
            $this->borrowedBy = null;
            $this->borrowedDate = null;
            return true;
        }
        return false;
    }
    
    abstract public function getType();
    abstract public function getDetails();
}

// Book class extending LibraryItem
class Book extends LibraryItem {
    private $author;
    private $isbn;
    private $pages;
    
    public function __construct($id, $title, $author, $isbn, $pages) {
        parent::__construct($id, $title);
        $this->author = $author;
        $this->isbn = $isbn;
        $this->pages = $pages;
    }
    
    public function getAuthor() { return $this->author; }
    public function getIsbn() { return $this->isbn; }
    public function getPages() { return $this->pages; }
    
    public function getType() {
        return 'Book';
    }
    
    public function getDetails() {
        return "Author: {$this->author}, ISBN: {$this->isbn}, Pages: {$this->pages}";
    }
}

// DVD class extending LibraryItem
class DVD extends LibraryItem {
    private $director;
    private $duration;
    private $rating;
    
    public function __construct($id, $title, $director, $duration, $rating) {
        parent::__construct($id, $title);
        $this->director = $director;
        $this->duration = $duration;
        $this->rating = $rating;
    }
    
    public function getDirector() { return $this->director; }
    public function getDuration() { return $this->duration; }
    public function getRating() { return $this->rating; }
    
    public function getType() {
        return 'DVD';
    }
    
    public function getDetails() {
        return "Director: {$this->director}, Duration: {$this->duration} min, Rating: {$this->rating}";
    }
}

// Library class to manage items
class Library {
    private $items = [];
    private $members = [];
    
    public function addItem(LibraryItem $item) {
        $this->items[$item->getId()] = $item;
    }
    
    public function removeItem($id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
            return true;
        }
        return false;
    }
    
    public function getItem($id) {
        return $this->items[$id] ?? null;
    }
    
    public function getAllItems() {
        return $this->items;
    }
    
    public function getAvailableItems() {
        return array_filter($this->items, function($item) {
            return $item->isAvailable();
        });
    }
    
    public function getBorrowedItems() {
        return array_filter($this->items, function($item) {
            return !$item->isAvailable();
        });
    }
    
    public function searchItems($query) {
        $results = [];
        foreach ($this->items as $item) {
            if (stripos($item->getTitle(), $query) !== false) {
                $results[] = $item;
            }
        }
        return $results;
    }
    
    public function addMember($name, $email) {
        $memberId = uniqid();
        $this->members[$memberId] = [
            'name' => $name,
            'email' => $email,
            'joined_date' => date('Y-m-d H:i:s')
        ];
        return $memberId;
    }
    
    public function getMembers() {
        return $this->members;
    }
}

// Initialize library with sample data
if (!isset($_SESSION['library'])) {
    $library = new Library();
    
    // Add some books
    $library->addItem(new Book('B001', 'The Great Gatsby', 'F. Scott Fitzgerald', '978-0743273565', 180));
    $library->addItem(new Book('B002', 'To Kill a Mockingbird', 'Harper Lee', '978-0446310789', 281));
    $library->addItem(new Book('B003', '1984', 'George Orwell', '978-0451524935', 328));
    $library->addItem(new Book('B004', 'Pride and Prejudice', 'Jane Austen', '978-0141439518', 432));
    
    // Add some DVDs
    $library->addItem(new DVD('D001', 'The Shawshank Redemption', 'Frank Darabont', 142, 'R'));
    $library->addItem(new DVD('D002', 'The Godfather', 'Francis Ford Coppola', 175, 'R'));
    $library->addItem(new DVD('D003', 'Pulp Fiction', 'Quentin Tarantino', 154, 'R'));
    
    $_SESSION['library'] = $library;
} else {
    $library = $_SESSION['library'];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'borrow':
                $itemId = $_POST['item_id'] ?? '';
                $memberName = $_POST['member_name'] ?? '';
                if ($itemId && $memberName) {
                    $item = $library->getItem($itemId);
                    if ($item && $item->borrow($memberName)) {
                        $_SESSION['message'] = "Item '{$item->getTitle()}' borrowed successfully by $memberName";
                    } else {
                        $_SESSION['error'] = "Item is not available for borrowing";
                    }
                }
                break;
                
            case 'return':
                $itemId = $_POST['item_id'] ?? '';
                if ($itemId) {
                    $item = $library->getItem($itemId);
                    if ($item && $item->return()) {
                        $_SESSION['message'] = "Item '{$item->getTitle()}' returned successfully";
                    } else {
                        $_SESSION['error'] = "Item is already available";
                    }
                }
                break;
                
            case 'add_item':
                $type = $_POST['type'] ?? '';
                $title = $_POST['title'] ?? '';
                $id = uniqid(substr($type, 0, 1));
                
                if ($type === 'book') {
                    $author = $_POST['author'] ?? '';
                    $isbn = $_POST['isbn'] ?? '';
                    $pages = $_POST['pages'] ?? '';
                    $library->addItem(new Book($id, $title, $author, $isbn, $pages));
                } elseif ($type === 'dvd') {
                    $director = $_POST['director'] ?? '';
                    $duration = $_POST['duration'] ?? '';
                    $rating = $_POST['rating'] ?? '';
                    $library->addItem(new DVD($id, $title, $director, $duration, $rating));
                }
                $_SESSION['message'] = "New $type added successfully";
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - OOP Project</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Library Management System</h1>
            <p>Object-Oriented Programming Project</p>
        </div>
        
        <div class="nav">
            <a href="../../index.html">← Back to Learning Hub</a>
        </div>

        <div class="content">
            <!-- Messages -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="message success"><?php echo htmlspecialchars($_SESSION['message']); ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="message error"><?php echo htmlspecialchars($_SESSION['error']); ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Statistics -->
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($library->getAllItems()); ?></div>
                    <div class="stat-label">Total Items</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($library->getAvailableItems()); ?></div>
                    <div class="stat-label">Available</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($library->getBorrowedItems()); ?></div>
                    <div class="stat-label">Borrowed</div>
                </div>
            </div>

            <!-- Add New Item -->
            <div class="section">
                <h2>➕ Add New Item</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add_item">
                    <div class="form-group">
                        <label for="type">Item Type:</label>
                        <select id="type" name="type" required>
                            <option value="">Select type</option>
                            <option value="book">Book</option>
                            <option value="dvd">DVD</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div id="book-fields" style="display: none;">
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" id="author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN:</label>
                            <input type="text" id="isbn" name="isbn">
                        </div>
                        <div class="form-group">
                            <label for="pages">Pages:</label>
                            <input type="number" id="pages" name="pages">
                        </div>
                    </div>
                    
                    <div id="dvd-fields" style="display: none;">
                        <div class="form-group">
                            <label for="director">Director:</label>
                            <input type="text" id="director" name="director">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration (minutes):</label>
                            <input type="number" id="duration" name="duration">
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <input type="text" id="rating" name="rating" placeholder="G, PG, R, etc.">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn">Add Item</button>
                </form>
            </div>

            <!-- Library Items -->
            <div class="section">
                <h2>📚 Library Items</h2>
                <div class="item-grid">
                    <?php foreach ($library->getAllItems() as $item): ?>
                        <div class="item-card <?php echo $item->isAvailable() ? 'available' : 'borrowed'; ?>">
                            <h3><?php echo htmlspecialchars($item->getTitle()); ?></h3>
                            <div class="item-details">
                                <strong>Type:</strong> <?php echo $item->getType(); ?><br>
                                <strong>ID:</strong> <?php echo $item->getId(); ?><br>
                                <?php echo $item->getDetails(); ?>
                            </div>
                            
                            <div class="item-status <?php echo $item->isAvailable() ? 'status-available' : 'status-borrowed'; ?>">
                                Status: <?php echo $item->isAvailable() ? 'Available' : 'Borrowed'; ?>
                            </div>
                            
                            <?php if ($item->isAvailable()): ?>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="borrow">
                                    <input type="hidden" name="item_id" value="<?php echo $item->getId(); ?>">
                                    <input type="text" name="member_name" placeholder="Member name" required style="width: 120px; padding: 5px; margin-right: 5px;">
                                    <button type="submit" class="btn btn-success">Borrow</button>
                                </form>
                            <?php else: ?>
                                <div style="margin-bottom: 10px;">
                                    <strong>Borrowed by:</strong> <?php echo htmlspecialchars($item->getBorrowedBy()); ?><br>
                                    <strong>Date:</strong> <?php echo $item->getBorrowedDate(); ?>
                                </div>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="return">
                                    <input type="hidden" name="item_id" value="<?php echo $item->getId(); ?>">
                                    <button type="submit" class="btn btn-danger">Return</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- OOP Concepts Demonstrated -->
            <div class="section">
                <h2>🎯 OOP Concepts Demonstrated</h2>
                <ul>
                    <li><strong>Abstraction:</strong> Abstract LibraryItem class defines common interface</li>
                    <li><strong>Inheritance:</strong> Book and DVD classes extend LibraryItem</li>
                    <li><strong>Encapsulation:</strong> Private properties with public getters</li>
                    <li><strong>Polymorphism:</strong> Different item types handled uniformly</li>
                    <li><strong>Composition:</strong> Library class contains items and members</li>
                    <li><strong>Method Overriding:</strong> Each subclass implements getType() and getDetails()</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Show/hide form fields based on item type
        document.getElementById('type').addEventListener('change', function() {
            const bookFields = document.getElementById('book-fields');
            const dvdFields = document.getElementById('dvd-fields');
            
            if (this.value === 'book') {
                bookFields.style.display = 'block';
                dvdFields.style.display = 'none';
            } else if (this.value === 'dvd') {
                bookFields.style.display = 'none';
                dvdFields.style.display = 'block';
            } else {
                bookFields.style.display = 'none';
                dvdFields.style.display = 'none';
            }
        });
    </script>
</body>
</html> 