<?php
include 'conn/dbase.php';

try {
    $query = "SELECT c_num, c_head, c_date, c_sec, c_file FROM c_tbl WHERE confirm=1 order by c_date desc";
    $stmt = $conn->query($query);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>චක්‍රලේඛ කළමනාකරණ පද්ධතිය</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-color: #f8f9fa;
            --text-color: #2c3e50;
        }
        
        body {
            font-family: 'Arial Unicode MS', 'Iskoola Pota', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
        }
        
        .navbar {
            background-color: var(--primary-color) !important;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-brand img {
            height: 40px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem;
        }
        
        .form-control {
            height: 45px;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background-color: #95a5a6;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
            transform: translateY(-2px);
        }
        
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        
        .table thead th {
            background-color: white;
            color: var(--text-color);
            border: 1px solid #dee2e6;
            padding: 1rem;
            font-weight: bold;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }
        
        .table tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        
        .logo_1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .search-section {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/get.png" alt="Logo" class="me-2">
                චක්‍රලේඛ කළමනාකරණ පද්ධතිය
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-user me-1"></i> චක්‍රලේඛ ඇතුලත් කිරීම
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ao_login.php">
                            <i class="fas fa-user-shield me-1"></i> අනුමත කිරීමේ නිලධාරී පිවිසුම
                        </a>
                    </li>
                </ul>
            </div>
        </div> 
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
                <div class="logo_1">චක්‍රලේඛ</div>
        
        <!-- Search Section -->
        <div class="search-section">
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <select id="searchCircularYear" class="form-control">
                        <option value="">වර්ෂය තෝරන්න</option>
                        <?php 
                            $query = "SELECT DISTINCT YEAR(c_date) AS year FROM c_tbl ORDER BY year DESC";
                            $stmt = $conn->query($query);
                            $years = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($years as $year): 
                        ?>
                            <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
            
                <div class="col-md-6 mb-3">
                    <select id="searchCircularSection" class="form-control">
                            <option value="">චක්‍රලේඛ අයත් අංශය තෝරන්න</option>
                            <option value="පාලන අංශය">පාලන අංශය</option>
                            <option value="ආයතන අංශය">ආයතන අංශය</option>
                            <option value="පිරිස් අංශය">පිරිස් අංශය</option>
                        <option value="මුදල් දෙපාර්තමේන්තුව">මුදල් දෙපාර්තමේන්තුව</option>
                            <option value="අයවැය දෙපාර්තමේන්තුව">අයවැය දෙපාර්තමේන්තුව</option>
                            <option value="ගිණුම් හා ගෙවීම් දෙපාර්තමේන්තුව">ගිණුම් හා ගෙවීම් දෙපාර්තමේන්තුව</option>
                        <option value="සංවර්ධන අංශය">සංවර්ධන අංශය</option>
                        <option value="තොරතුරු තාක්ෂණ අංශය">තොරතුරු තාක්ෂණ අංශය</option>
                        <option value="නීති අංශය">නීති අංශය</option>
                        <option value="ගිණුම් අංශය">ගිණුම් අංශය</option>
                        <option value="සැපයුම් අංශය">සැපයුම් අංශය</option>
                        <option value="රාජ්‍ය පරිපාලන චක්‍රලේඛ">රාජ්‍ය පරිපාලන චක්‍රලේඛ</option>
                        </select>
                        </div>
                    </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                        <div class="input-group">
                        <input type="text" id="searchCircularIndex" class="form-control" placeholder="චක්‍රලේඛ අංකය තෝරන්න">
                        <button class="btn btn-primary" id="btnSearchCircularIndex">
                            <i class="fas fa-search me-1"></i> සොයන්න
                        </button>
                    </div>
                </div>
            
                <div class="col-md-4 mb-3">
                    <button id="refreshButton" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt me-1"></i> යලි සකසන්න
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">චක්‍රලේඛ ලැයිස්තුව</h3>
  </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped">
            <thead>
                <tr>
                    <th>චක්‍රලේඛ අංකය</th>
                    <th>චක්‍රලේඛ ශීර්ෂය</th>
                    <th>නිකුත්කල දිනය</th>
                    <th>චක්‍රලේඛ අයත් අංශය</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['c_num'] ?></td>
                                <td>
                                    <a href="uploads/<?=$row['c_file']?>" target="_blank">
                                        <i class="fas fa-file-pdf me-1"></i>
                                        <?= $row['c_head'] ?>
                                    </a>
                                </td>
                                <td><?= date('Y-m-d', strtotime($row['c_date'])) ?></td>
                    <td><?= $row['c_sec'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        </div>          
    </div>
</div>
                     
    <!-- Footer -->
    <footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
                    <p class="mb-0">© 2024 ප්‍රධාන ලේකම් කාර්යාලය, දකුණු පළාත</p>
				</div>
                <div class="col-md-6 text-end">
                    <a href="login.php" class="text-white">චක්රලේඛය ඇතුළු කිරීමසහ තහවුරු කිරීමේ පද්ධතිය</a>
				</div>
			</div>
		</div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Initialize DataTable
            var dataTable = $('#dataTable').DataTable({
                language: {
                    search: "සොයන්න:",
                    lengthMenu: "_MENU_ Show entries",
                    info: "Showing  _START_ to _END_ of _TOTAL_entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                order: [[2, 'desc']] // Sort by date column by default
            });

            // Year filter
            $('#searchCircularYear').on('change', function() {
                var year = $(this).val();
                dataTable.column(2).search(year).draw();
            });

            // Section filter
            $('#searchCircularSection').on('change', function() {
                var section = $(this).val();
                dataTable.column(3).search(section).draw();
            });

            // Circular number search
            $('#btnSearchCircularIndex').on('click', function() {
                var searchTerm = $('#searchCircularIndex').val();
                dataTable.column(0).search(searchTerm).draw();
            });

            // Reset filters
            $('#refreshButton').on('click', function() {
                $('#searchCircularYear').val('');
                $('#searchCircularSection').val('');
                $('#searchCircularIndex').val('');
                dataTable.search('').columns().search('').draw();
            });

            // Enter key for search
            $('#searchCircularIndex').on('keypress', function(e) {
                if(e.which == 13) {
                    $('#btnSearchCircularIndex').click();
                }
            });
        });
    </script>
</body>
</html>