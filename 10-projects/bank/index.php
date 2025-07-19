<?php
session_start();

// Interface for account operations
interface AccountOperations {
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
    public function transfer($amount, $targetAccount);
}

// Abstract base class for all accounts
abstract class Account implements AccountOperations {
    protected $accountNumber;
    protected $holderName;
    protected $balance;
    protected $accountType;
    protected $transactions = [];
    
    public function __construct($accountNumber, $holderName, $initialBalance = 0) {
        $this->accountNumber = $accountNumber;
        $this->holderName = $holderName;
        $this->balance = $initialBalance;
        $this->addTransaction('Account opened', $initialBalance, 'credit');
    }
    
    public function getAccountNumber() { return $this->accountNumber; }
    public function getHolderName() { return $this->holderName; }
    public function getBalance() { return $this->balance; }
    public function getAccountType() { return $this->accountType; }
    public function getTransactions() { return $this->transactions; }
    
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            $this->addTransaction('Deposit', $amount, 'credit');
            return true;
        }
        return false;
    }
    
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            $this->addTransaction('Withdrawal', $amount, 'debit');
            return true;
        }
        return false;
    }
    
    public function transfer($amount, $targetAccount) {
        if ($this->withdraw($amount)) {
            $targetAccount->deposit($amount);
            $this->addTransaction("Transfer to {$targetAccount->getAccountNumber()}", $amount, 'debit');
            $targetAccount->addTransaction("Transfer from {$this->accountNumber}", $amount, 'credit');
            return true;
        }
        return false;
    }
    
    protected function addTransaction($description, $amount, $type) {
        $this->transactions[] = [
            'date' => date('Y-m-d H:i:s'),
            'description' => $description,
            'amount' => $amount,
            'type' => $type,
            'balance' => $this->balance
        ];
    }
    
    abstract public function getInterestRate();
    abstract public function calculateInterest();
}

// Savings Account class
class SavingsAccount extends Account {
    private $interestRate = 0.02; // 2% annual interest
    private $minimumBalance = 100;
    
    public function __construct($accountNumber, $holderName, $initialBalance = 0) {
        parent::__construct($accountNumber, $holderName, $initialBalance);
        $this->accountType = 'Savings';
    }
    
    public function getInterestRate() {
        return $this->interestRate;
    }
    
    public function calculateInterest() {
        return $this->balance * $this->interestRate;
    }
    
    public function withdraw($amount) {
        if ($this->balance - $amount >= $this->minimumBalance) {
            return parent::withdraw($amount);
        }
        return false;
    }
    
    public function addInterest() {
        $interest = $this->calculateInterest();
        $this->balance += $interest;
        $this->addTransaction('Interest earned', $interest, 'credit');
    }
}

// Checking Account class
class CheckingAccount extends Account {
    private $overdraftLimit = 500;
    private $monthlyFee = 10;
    
    public function __construct($accountNumber, $holderName, $initialBalance = 0) {
        parent::__construct($accountNumber, $holderName, $initialBalance);
        $this->accountType = 'Checking';
    }
    
    public function getInterestRate() {
        return 0.001; // 0.1% annual interest
    }
    
    public function calculateInterest() {
        return $this->balance * $this->getInterestRate();
    }
    
    public function withdraw($amount) {
        if ($this->balance + $this->overdraftLimit >= $amount) {
            return parent::withdraw($amount);
        }
        return false;
    }
    
    public function chargeMonthlyFee() {
        $this->balance -= $this->monthlyFee;
        $this->addTransaction('Monthly fee', $this->monthlyFee, 'debit');
    }
}

// Business Account class
class BusinessAccount extends Account {
    private $businessType;
    private $transactionLimit = 10000;
    
    public function __construct($accountNumber, $holderName, $businessType, $initialBalance = 0) {
        parent::__construct($accountNumber, $holderName, $initialBalance);
        $this->accountType = 'Business';
        $this->businessType = $businessType;
    }
    
    public function getInterestRate() {
        return 0.015; // 1.5% annual interest
    }
    
    public function calculateInterest() {
        return $this->balance * $this->getInterestRate();
    }
    
    public function getBusinessType() {
        return $this->businessType;
    }
    
    public function transfer($amount, $targetAccount) {
        if ($amount <= $this->transactionLimit) {
            return parent::transfer($amount, $targetAccount);
        }
        return false;
    }
}

// Bank class to manage all accounts
class Bank {
    private $accounts = [];
    private $bankName;
    
    public function __construct($bankName) {
        $this->bankName = $bankName;
    }
    
    public function getBankName() {
        return $this->bankName;
    }
    
    public function createAccount($accountType, $holderName, $businessType = null, $initialBalance = 0) {
        $accountNumber = $this->generateAccountNumber();
        
        switch ($accountType) {
            case 'savings':
                $account = new SavingsAccount($accountNumber, $holderName, $initialBalance);
                break;
            case 'checking':
                $account = new CheckingAccount($accountNumber, $holderName, $initialBalance);
                break;
            case 'business':
                $account = new BusinessAccount($accountNumber, $holderName, $businessType, $initialBalance);
                break;
            default:
                return null;
        }
        
        $this->accounts[$accountNumber] = $account;
        return $account;
    }
    
    public function getAccount($accountNumber) {
        return $this->accounts[$accountNumber] ?? null;
    }
    
    public function getAllAccounts() {
        return $this->accounts;
    }
    
    public function getAccountsByType($type) {
        return array_filter($this->accounts, function($account) use ($type) {
            return $account->getAccountType() === $type;
        });
    }
    
    private function generateAccountNumber() {
        return 'ACC' . date('Y') . rand(100000, 999999);
    }
    
    public function getTotalDeposits() {
        $total = 0;
        foreach ($this->accounts as $account) {
            $total += $account->getBalance();
        }
        return $total;
    }
    
    public function processMonthlyOperations() {
        foreach ($this->accounts as $account) {
            if ($account instanceof SavingsAccount) {
                $account->addInterest();
            } elseif ($account instanceof CheckingAccount) {
                $account->chargeMonthlyFee();
            }
        }
    }
}

// Initialize bank with sample data
if (!isset($_SESSION['bank'])) {
    $bank = new Bank('PHP Learning Bank');
    
    // Create sample accounts
    $bank->createAccount('savings', 'John Doe', null, 1000);
    $bank->createAccount('checking', 'Jane Smith', null, 500);
    $bank->createAccount('business', 'Tech Solutions Inc.', 'Technology', 5000);
    $bank->createAccount('savings', 'Bob Johnson', null, 2500);
    
    $_SESSION['bank'] = $bank;
} else {
    $bank = $_SESSION['bank'];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_account':
                $accountType = $_POST['account_type'] ?? '';
                $holderName = $_POST['holder_name'] ?? '';
                $businessType = $_POST['business_type'] ?? '';
                $initialBalance = (float)($_POST['initial_balance'] ?? 0);
                $account = $bank->createAccount($accountType, $holderName, $businessType, $initialBalance);
                if ($account) {
                    $_SESSION['message'] = "Account created successfully! Account number: {$account->getAccountNumber()}";
                } else {
                    $_SESSION['error'] = "Failed to create account. Please check your input.";
                }
                break;
            case 'deposit':
                $accountNumber = $_POST['account_number'] ?? '';
                $amount = (float)($_POST['amount'] ?? 0);
                $account = $bank->getAccount($accountNumber);
                if (!$account) {
                    $_SESSION['error'] = "Account not found. Please check the account number.";
                } elseif ($amount <= 0) {
                    $_SESSION['error'] = "Deposit amount must be greater than zero.";
                } elseif ($account->deposit($amount)) {
                    $_SESSION['message'] = "Deposited $amount to account {$accountNumber}";
                } else {
                    $_SESSION['error'] = "Failed to deposit. Please try again.";
                }
                break;
            case 'withdraw':
                $accountNumber = $_POST['account_number'] ?? '';
                $amount = (float)($_POST['amount'] ?? 0);
                $account = $bank->getAccount($accountNumber);
                if (!$account) {
                    $_SESSION['error'] = "Account not found. Please check the account number.";
                } elseif ($amount <= 0) {
                    $_SESSION['error'] = "Withdrawal amount must be greater than zero.";
                } elseif ($account->withdraw($amount)) {
                    $_SESSION['message'] = "Withdrew $amount from account {$accountNumber}";
                } else {
                    $_SESSION['error'] = "Failed to withdraw. Check balance or minimum requirements.";
                }
                break;
            case 'transfer':
                $fromAccount = $_POST['from_account'] ?? '';
                $toAccount = $_POST['to_account'] ?? '';
                $amount = (float)($_POST['amount'] ?? 0);
                $from = $bank->getAccount($fromAccount);
                $to = $bank->getAccount($toAccount);
                if (!$from) {
                    $_SESSION['error'] = "Source account not found.";
                } elseif (!$to) {
                    $_SESSION['error'] = "Destination account not found.";
                } elseif ($amount <= 0) {
                    $_SESSION['error'] = "Transfer amount must be greater than zero.";
                } elseif ($from->transfer($amount, $to)) {
                    $_SESSION['message'] = "Transferred $amount from {$fromAccount} to {$toAccount}";
                } else {
                    $_SESSION['error'] = "Failed to transfer. Check balance, limits, or account types.";
                }
                break;
            case 'process_monthly':
                $bank->processMonthlyOperations();
                $_SESSION['message'] = "Monthly operations processed successfully.";
                break;
            case 'reset_bank':
                unset($_SESSION['bank']);
                $_SESSION['message'] = "Bank data has been reset.";
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            case 'calculate_interest':
                $accountNumber = $_POST['account_number'] ?? '';
                $account = $bank->getAccount($accountNumber);
                if ($account && method_exists($account, 'addInterest')) {
                    $account->addInterest();
                    $_SESSION['message'] = "Interest added to account {$accountNumber}.";
                } else {
                    $_SESSION['error'] = "Interest calculation is only available for savings accounts.";
                }
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
    <title>Bank Management System - OOP Project</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏦 Bank Management System</h1>
            <p>Advanced OOP Project with Inheritance and Interfaces</p>
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

            <!-- Bank Statistics -->
            <div class="stats">
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($bank->getAllAccounts()); ?></div>
                    <div class="stat-label">Total Accounts</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">$<?php echo number_format($bank->getTotalDeposits(), 2); ?></div>
                    <div class="stat-label">Total Deposits</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($bank->getAccountsByType('Savings')); ?></div>
                    <div class="stat-label">Savings Accounts</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number"><?php echo count($bank->getAccountsByType('Checking')); ?></div>
                    <div class="stat-label">Checking Accounts</div>
                </div>
            </div>

            <!-- Create New Account -->
            <div class="section">
                <h2>➕ Create New Account</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="create_account">
                    <div class="form-group">
                        <label for="account_type">Account Type:</label>
                        <select id="account_type" name="account_type" required>
                            <option value="">Select account type</option>
                            <option value="savings">Savings Account</option>
                            <option value="checking">Checking Account</option>
                            <option value="business">Business Account</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="holder_name">Account Holder Name:</label>
                        <input type="text" id="holder_name" name="holder_name" required>
                    </div>
                    
                    <div class="form-group" id="business_type_group" style="display: none;">
                        <label for="business_type">Business Type:</label>
                        <input type="text" id="business_type" name="business_type" placeholder="e.g., Technology, Retail, etc.">
                    </div>
                    
                    <div class="form-group">
                        <label for="initial_balance">Initial Balance:</label>
                        <input type="number" id="initial_balance" name="initial_balance" value="0" min="0" step="0.01">
                    </div>
                    
                    <button type="submit" class="btn">Create Account</button>
                </form>
            </div>

            <!-- Account Operations -->
            <div class="section">
                <h2>💰 Account Operations</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    
                    <!-- Deposit -->
                    <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                        <h3>Deposit</h3>
                        <form method="POST">
                            <input type="hidden" name="action" value="deposit">
                            <div class="form-group">
                                <label for="deposit_account">Account Number:</label>
                                <input type="text" id="deposit_account" name="account_number" required>
                            </div>
                            <div class="form-group">
                                <label for="deposit_amount">Amount:</label>
                                <input type="number" id="deposit_amount" name="amount" min="0.01" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-success">Deposit</button>
                        </form>
                    </div>
                    
                    <!-- Withdraw -->
                    <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                        <h3>Withdraw</h3>
                        <form method="POST">
                            <input type="hidden" name="action" value="withdraw">
                            <div class="form-group">
                                <label for="withdraw_account">Account Number:</label>
                                <input type="text" id="withdraw_account" name="account_number" required>
                            </div>
                            <div class="form-group">
                                <label for="withdraw_amount">Amount:</label>
                                <input type="number" id="withdraw_amount" name="amount" min="0.01" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-danger">Withdraw</button>
                        </form>
                    </div>
                    
                    <!-- Transfer -->
                    <div style="border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
                        <h3>Transfer</h3>
                        <form method="POST">
                            <input type="hidden" name="action" value="transfer">
                            <div class="form-group">
                                <label for="from_account">From Account:</label>
                                <input type="text" id="from_account" name="from_account" required>
                            </div>
                            <div class="form-group">
                                <label for="to_account">To Account:</label>
                                <input type="text" id="to_account" name="to_account" required>
                            </div>
                            <div class="form-group">
                                <label for="transfer_amount">Amount:</label>
                                <input type="number" id="transfer_amount" name="amount" min="0.01" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Transfer</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- All Accounts -->
            <div class="section">
                <h2>📊 All Accounts</h2>
                <div class="account-grid">
                    <?php foreach ($bank->getAllAccounts() as $account): ?>
                        <div class="account-card">
                            <h3><?php echo htmlspecialchars($account->getHolderName()); ?></h3>
                            <div class="account-details">
                                <strong>Account Number:</strong> <?php echo $account->getAccountNumber(); ?><br>
                                <strong>Type:</strong> <?php echo $account->getAccountType(); ?><br>
                                <strong>Interest Rate:</strong> <?php echo number_format($account->getInterestRate() * 100, 1); ?>%<br>
                                <?php if ($account instanceof BusinessAccount): ?>
                                    <strong>Business Type:</strong> <?php echo $account->getBusinessType(); ?><br>
                                <?php endif; ?>
                            </div>
                            
                            <div class="balance">
                                Balance: $<?php echo number_format($account->getBalance(), 2); ?>
                            </div>
                            
                            <div>
                                <button class="btn" onclick="showTransactions('<?php echo $account->getAccountNumber(); ?>')">
                                    View Transactions
                                </button>
                                <button class="btn btn-success" onclick="calculateInterest('<?php echo $account->getAccountNumber(); ?>')">
                                    Calculate Interest
                                </button>
                            </div>
                            
                            <!-- Transactions Modal -->
                            <div id="transactions-<?php echo $account->getAccountNumber(); ?>" style="display: none; margin-top: 15px;">
                                <h4>Recent Transactions:</h4>
                                <div class="transaction-list">
                                    <?php foreach (array_slice($account->getTransactions(), -5) as $transaction): ?>
                                        <div class="transaction-item">
                                            <strong><?php echo $transaction['date']; ?></strong><br>
                                            <?php echo htmlspecialchars($transaction['description']); ?><br>
                                            <span class="transaction-<?php echo $transaction['type']; ?>">
                                                <?php echo $transaction['type'] === 'credit' ? '+' : '-'; ?>$<?php echo number_format($transaction['amount'], 2); ?>
                                            </span>
                                            (Balance: $<?php echo number_format($transaction['balance'], 2); ?>)
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Monthly Operations -->
            <div class="section">
                <h2>📅 Monthly Operations</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="process_monthly">
                    <button type="submit" class="btn btn-warning">Process Monthly Operations</button>
                </form>
                <p><small>This will add interest to savings accounts and charge monthly fees to checking accounts.</small></p>
            </div>

            <!-- Reset Bank Data Button -->
            <form method="POST" style="margin-bottom: 20px;">
                <input type="hidden" name="action" value="reset_bank">
                <button type="submit" class="btn btn-danger">Reset Bank Data</button>
            </form>

            <!-- OOP Concepts Demonstrated -->
            <div class="section">
                <h2>🎯 OOP Concepts Demonstrated</h2>
                <ul>
                    <li><strong>Interfaces:</strong> AccountOperations interface defines contract</li>
                    <li><strong>Abstract Classes:</strong> Account abstract class with common functionality</li>
                    <li><strong>Inheritance:</strong> SavingsAccount, CheckingAccount, BusinessAccount extend Account</li>
                    <li><strong>Encapsulation:</strong> Private properties with public methods</li>
                    <li><strong>Polymorphism:</strong> Different account types handled uniformly</li>
                    <li><strong>Method Overriding:</strong> Each account type implements different withdrawal logic</li>
                    <li><strong>Composition:</strong> Bank class manages multiple accounts</li>
                    <li><strong>Design Patterns:</strong> Strategy pattern for different account types</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Show/hide business type field
        document.getElementById('account_type').addEventListener('change', function() {
            const businessGroup = document.getElementById('business_type_group');
            if (this.value === 'business') {
                businessGroup.style.display = 'block';
            } else {
                businessGroup.style.display = 'none';
            }
        });
        function showTransactions(accountNumber) {
            const modal = document.getElementById('transactions-' + accountNumber);
            if (modal.style.display === 'none') {
                modal.style.display = 'block';
            } else {
                modal.style.display = 'none';
            }
        }
        function calculateInterest(accountNumber) {
            // Submit a hidden form to calculate interest
            const form = document.createElement('form');
            form.method = 'POST';
            form.style.display = 'none';
            form.innerHTML = '<input type="hidden" name="action" value="calculate_interest">' +
                '<input type="hidden" name="account_number" value="' + accountNumber + '">';
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html> 