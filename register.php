<?php
session_start();
include 'conn/dbase.php';

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if email already exists
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->execute([$email]);
    
    if($check_stmt->rowCount() > 0) {
        $error = "විද්‍යුත් තැපෑල දැනටමත් භාවිතා කර ඇත";
    } elseif($password !== $confirm_password) {
        $error = "මුරපද නොගැලපේ";
    } elseif(strlen($password) < 6) {
        $error = "මුරපදය අක්ෂර 6කට වැඩි විය යුතුය";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        try {
            $stmt->execute([$fname, $lname, $email, $password]);
            $_SESSION['success'] = "ලියාපදිංචිය සාර්ථකයි. දැන් ඔබට පිවිසිය හැකිය.";
            header("Location: login.php");
            exit();
        } catch(PDOException $e) {
            $error = "ලියාපදිංචිය අසාර්ථකයි. නැවත උත්සාහ කරන්න.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>පරිශීලක ලියාපදිංචිය</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>පරිශීලක ලියාපදිංචිය</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">මුල් නම</label>
                                <input type="text" name="fname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">අවසන් නම</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">විද්‍යුත් තැපෑල</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">මුරපදය</label>
                                <input type="password" name="password" class="form-control" required>
                                <small class="text-muted">අවම වශයෙන් අක්ෂර 6ක් විය යුතුය</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">මුරපදය තහවුරු කරන්න</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary w-100">ලියාපදිංචි වන්න</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>දැනටමත් ගිණුමක් තිබේද? <a href="login.php">පිවිසෙන්න</a></p>
                    <a href="select.php" class="btn btn-link">ආපසු යන්න</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 