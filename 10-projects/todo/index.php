<?php
// Session management for todo app
session_start();

// Initialize todos array if not exists
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $task = trim($_POST['task']);
                if (!empty($task)) {
                    $_SESSION['todos'][] = [
                        'id' => uniqid(),
                        'task' => $task,
                        'completed' => false,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
                break;
                
            case 'toggle':
                $id = $_POST['id'];
                foreach ($_SESSION['todos'] as &$todo) {
                    if ($todo['id'] === $id) {
                        $todo['completed'] = !$todo['completed'];
                        break;
                    }
                }
                break;
                
            case 'delete':
                $id = $_POST['id'];
                $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) use ($id) {
                    return $todo['id'] !== $id;
                });
                break;

            case 'clear_completed':
                $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) {
                    return !$todo['completed'];
                });
                break;
        }
    }
}

// After processing todos and before HTML output
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
    <title>Todo App - PHP Project</title>
    <link rel="stylesheet" href="../../style.css">
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