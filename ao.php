<?php
session_start();
include 'conn/dbase.php';

// Check if AO is logged in
if (!isset($_SESSION['aname'])) {
    header("Location: ao_login.php");
    exit();
}

// Handle approval/rejection
if (isset($_POST['action']) && isset($_POST['id'])) {
    $action = $_POST['action'];
    $id = $_POST['id'];
    $confirm = ($action === 'approve') ? 1 : 2; // 1 for approved, 2 for rejected
    
    $sql = "UPDATE c_tbl SET confirm = ? WHERE c_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$confirm, $id])) {
        $success = ($confirm == 1) ? "චක්‍රලේඛය අනුමත කරන ලදී" : "චක්‍රලේඛය ප්‍රතික්ෂේප කරන ලදී";
    } else {
        $error = "ක්‍රියාව අසාර්ථක විය";
    }
}

// Fetch pending circulars
$sql = "SELECT c_id, c_num, c_head, c_date, c_sec, c_file FROM c_tbl WHERE confirm = 0 ORDER BY c_id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$circulars = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>අනුමත කිරීමේ නිලධාරී පුවරුව</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .table {
            border: 1px solid #dee2e6;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }
        .action-buttons .btn {
            margin: 0 2px;
        }
        .search-section {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .table-header {
            background-color: #37474f;
            color: white;
            padding: 15px;
            margin-bottom: 0;
            border-radius: 5px 5px 0 0;
        }
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }
        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2>චක්‍රලේඛ</h2>
            </div>
            <div class="col-md-4 text-end">
                <a href="select.php" class="btn btn-outline-primary me-2">
                    <i class="fas fa-home"></i> මුල් පිටුව
                </a>
                <a href="includes/logout.inc.php" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> පිටවීම
                </a>
            </div>
        </div>

        <!-- Messages -->
        <?php if(isset($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Search Section -->
        <div class="search-section">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <select class="form-select" id="entriesSelect">
                        <option value="10">Show entries</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-md-10">
                    <div class="d-flex justify-content-end">
                        <input type="search" class="form-control w-50" placeholder="සොයන්න..." id="searchInput">
                    </div>
                </div>
            </div>
        </div>

        <!-- Circulars Table -->
        <div class="card">
            <h5 class="table-header">අනුමැතිය අවශ්‍ය චක්‍රලේඛ</h5>
            <div class="card-body p-0">
                <table id="circularsTable" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>චක්‍රලේඛ අංකය</th>
                            <th>මාතෘකාව</th>
                            <th>දිනය</th>
                            <th>අංශය</th>
                            <th>PDF</th>
                            <th>ක්‍රියාමාර්ග</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($circulars as $circular): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($circular['c_num']); ?></td>
                                <td><?php echo htmlspecialchars($circular['c_head']); ?></td>
                                <td><?php echo date('Y-m-d', strtotime($circular['c_date'])); ?></td>
                                <td><?php echo htmlspecialchars($circular['c_sec']); ?></td>
                                <td>
                                    <a href="uploads/<?php echo htmlspecialchars($circular['c_file']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                                <td class="action-buttons">
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $circular['c_id']; ?>">
                                        <button type="submit" name="action" value="approve" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> අනුමත කරන්න
                                        </button>
                                        <button type="submit" name="action" value="reject" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i> ප්‍රතික්ෂේප කරන්න
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Info -->
        <div class="row mt-3">
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                       
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#circularsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/si.json'
                },
                order: [[2, 'desc']], // Sort by date descending
                pageLength: 10,
                responsive: true,
                dom: 'rt<"row"<"col-md-6"i><"col-md-6"p>>'
            });

            // Custom search
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Custom page length
            $('#entriesSelect').on('change', function() {
                table.page.len(this.value).draw();
            });
        });
    </script>
</body>
</html>