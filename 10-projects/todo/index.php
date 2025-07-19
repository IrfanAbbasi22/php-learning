<?php
session_start();

// Initialize todos array in session if it doesn't exist
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                if (!empty($_POST['task'])) {
                    $newTodo = [
                        'id' => time() . rand(100, 999),
                        'task' => trim($_POST['task']),
                        'completed' => false,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $_SESSION['todos'][] = $newTodo;
                }
                break;
                
            case 'toggle':
                if (isset($_POST['id'])) {
                    foreach ($_SESSION['todos'] as &$todo) {
                        if ($todo['id'] == $_POST['id']) {
                            $todo['completed'] = !$todo['completed'];
                            break;
                        }
                    }
                }
                break;
                
            case 'delete':
                if (isset($_POST['id'])) {
                    $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) {
                        return $todo['id'] != $_POST['id'];
                    });
                }
                break;
                
            case 'clear_completed':
                $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) {
                    return !$todo['completed'];
                });
                break;
        }
    }
}

// Get statistics
$totalTodos = count($_SESSION['todos']);
$completedTodos = count(array_filter($_SESSION['todos'], function($todo) {
    return $todo['completed'];
}));
$pendingTodos = $totalTodos - $completedTodos;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App - PHP Learning</title>
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
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #667eea;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #667eea;
        }
        .stat-label {
            color: #666;
            font-size: 0.9em;
        }
        .add-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .form-group {
            display: flex;
            gap: 10px;
        }
        .form-group input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn {
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #5a6fd8;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #218838;
        }
        .todo-list {
            margin-bottom: 20px;
        }
        .todo-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 10px;
            background: white;
            transition: all 0.2s;
        }
        .todo-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .todo-item.completed {
            background: #f8f9fa;
            opacity: 0.7;
        }
        .todo-item.completed .todo-text {
            text-decoration: line-through;
            color: #666;
        }
        .todo-checkbox {
            margin-right: 15px;
            transform: scale(1.2);
        }
        .todo-text {
            flex: 1;
            font-size: 16px;
        }
        .todo-date {
            color: #666;
            font-size: 0.8em;
            margin-right: 15px;
        }
        .todo-actions {
            display: flex;
            gap: 5px;
        }
        .btn-small {
            padding: 5px 10px;
            font-size: 12px;
        }
        .empty-state {
            text-align: center;
            color: #666;
            padding: 40px 20px;
        }
        .empty-state h3 {
            margin-bottom: 10px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📝 Todo App</h1>
            <p>Simple task management with PHP</p>
        </div>
        
        <div class="nav">
            <a href="../../index.html">← Back to Learning Hub</a>
        </div>

        <div class="content">
            <!-- Statistics -->
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number"><?php echo $totalTodos; ?></div>
                    <div class="stat-label">Total Tasks</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $pendingTodos; ?></div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo $completedTodos; ?></div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>

            <!-- Add Todo Form -->
            <div class="add-form">
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="form-group">
                        <input type="text" name="task" placeholder="What needs to be done?" required>
                        <button type="submit" class="btn">Add Task</button>
                    </div>
                </form>
            </div>

            <!-- Todo List -->
            <div class="todo-list">
                <?php if (empty($_SESSION['todos'])): ?>
                    <div class="empty-state">
                        <h3>No tasks yet!</h3>
                        <p>Add your first task above to get started.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($_SESSION['todos'] as $todo): ?>
                        <div class="todo-item <?php echo $todo['completed'] ? 'completed' : ''; ?>">
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="toggle">
                                <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                                <input type="checkbox" class="todo-checkbox" <?php echo $todo['completed'] ? 'checked' : ''; ?> 
                                       onchange="this.form.submit()">
                            </form>
                            
                            <span class="todo-text"><?php echo htmlspecialchars($todo['task']); ?></span>
                            
                            <span class="todo-date"><?php echo date('M j', strtotime($todo['created_at'])); ?></span>
                            
                            <div class="todo-actions">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-small" 
                                            onclick="return confirm('Are you sure you want to delete this task?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Clear Completed Button -->
            <?php if ($completedTodos > 0): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="clear_completed">
                    <button type="submit" class="btn btn-success">Clear Completed (<?php echo $completedTodos; ?>)</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Auto-submit form when checkbox is clicked
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.todo-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    this.form.submit();
                });
            });
        });
    </script>
</body>
</html> 