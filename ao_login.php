<?php
session_start();
include 'conn/dbase.php';

if(isset($_POST['submit'])) {
    $aname = $_POST['aname'];
    $apw = $_POST['apw'];
    
    $sql = "SELECT * FROM ao WHERE aname = ? AND apw = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$aname, $apw]);
    
    if($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $_SESSION['aname'] = $row['aname'];
        header("Location: ao.php");
        exit();
    } else {
        $error = "නම හෝ මුරපදය වැරදියි";
    }
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>අනුමත කිරීමේ නිලධාරී පිවිසුම</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>අනුමත කිරීමේ නිලධාරී පිවිසුම</h4>
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
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary w-100">පිවිසෙන්න</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>ගිණුමක් නොමැතිද? <a href="ao_register.php">ලියාපදිංචි වන්න</a></p>
                    <a href="select.php" class="btn btn-link">ආපසු යන්න</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 