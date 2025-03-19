<?php
session_start();
include 'conn/dbase.php';

if(isset($_POST['submit'])) {
    $aname = $_POST['aname'];
    $apw = $_POST['apw'];
    $confirm_apw = $_POST['confirm_apw'];
    
    if($apw !== $confirm_apw) {
        $error = "මුරපද නොගැලපේ";
    } elseif(strlen($apw) < 6) {
        $error = "මුරපදය අක්ෂර 6කට වැඩි විය යුතුය";
    } else {
        // Insert new AO
        $sql = "INSERT INTO ao (aname, apw) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        
        try {
            $stmt->execute([$aname, $apw]);
            $_SESSION['success'] = "ලියාපදිංචිය සාර්ථකයි. දැන් ඔබට පිවිසිය හැකිය.";
            header("Location: ao_login.php");
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
    <title>අනුමත කිරීමේ නිලධාරී ලියාපදිංචිය</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>අනුමත කිරීමේ නිලධාරී ලියාපදිංචිය</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">නම</label>
                                <input type="text" name="aname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">මුරපදය</label>
                                <input type="password" name="apw" class="form-control" required>
                                <small class="text-muted">අවම වශයෙන් අක්ෂර 6ක් විය යුතුය</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">මුරපදය තහවුරු කරන්න</label>
                                <input type="password" name="confirm_apw" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary w-100">ලියාපදිංචි වන්න</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>දැනටමත් ගිණුමක් තිබේද? <a href="ao_login.php">පිවිසෙන්න</a></p>
                    <a href="select.php" class="btn btn-link">ආපසු යන්න</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 