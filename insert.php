<?php
// session_start();

// // If not logged in
// if(!isset($_SESSION["user_email"])){
//     header("location: ./login.php");
//     exit();
// }
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
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
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
        
        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .card {
                margin: 1rem;
            }
        }
        
        .what_text {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .main {
            margin-bottom: 25px;
        }
        
        .input-group {
            width: 100%;
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
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        select.form-control {
            background-color: white;
            cursor: pointer;
        }
        
        .find_bt {
            padding: 12px 35px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 5px;
            background-color: #27ae60;
            border: none;
            transition: all 0.3s;
        }
        
        .find_bt:hover {
            background-color: #219a52;
            transform: translateY(-2px);
        }

        #alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .alert-success {
            background-color: #27ae60;
            color: white;
        }

        .alert-danger {
            background-color: #e74c3c;
            color: white;
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
                        <a class="nav-link" href="select.php">
                            <i class="fas fa-home me-1"></i> මුල් පිටුව
                        </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="ao_login.php">
                            <i class="fas fa-check-circle me-1"></i> අනුමත කිරීම්
                        </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Form Card -->
        <div class="card mb-5">
            <div class="card-header">
                <h3 class="mb-0">නව චක්‍රලේඛය එක් කිරීම</h3>
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="circularForm" action="upload.php">
                    <div class="row">
                    <div class="col-md-6">
                        <h1 class="what_text">චක්‍රලේඛ අයත් අංශය</h1>
                        <div class="main">
                            <div class="input-group">
                                    <select name="c_sec" id="c_sec" class="form-control" required>
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
                    </div>

                    <div class="col-md-6">
                        <h1 class="what_text">චක්‍රලේඛ අංකය</h1>
                            <div class="main">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="චක්‍රලේඛ අංකය ඇතුලත් කරන්න" 
                                        name="c_num" id="c_num" required>
                                </div>
                            </div>
                        </div>

                    <div class="col-md-6">
                        <h1 class="what_text">චක්‍රලේඛ ශීර්ෂය</h1>
                            <div class="main">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="චක්‍රලේඛ ශීර්ෂය ඇතුලත් කරන්න"
                                        name="c_head" id="c_head" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h1 class="what_text">නිකුත්කල දිනය</h1>
                            <div class="main">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="c_date" id="c_date" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h1 class="what_text">චක්‍රලේඛ ගොනුව</h1>
                            <div class="main">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="c_file" id="c_file" required>
                                </div>
                            </div>
                        </div>

                        <div id="alert-container"></div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-success find_bt">save</button>
                    </div>
                </form>
                </div>
                </div>

        <!-- Data Table Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">චක්‍රලේඛ ලැයිස්තුව</h3>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>අංකය</th>
                                <th>අංශය</th>
                            <th>චක්‍රලේඛ අංකය</th>
                                <th>ශීර්ෂය</th>
                                <th>දිනය</th>
                                <th>ගොනුව</th>
                                <th>ක්‍රියා</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include("conn/dbase.php");
                            $str1 = "SELECT c_id, c_sec, c_num, c_head, c_date, c_file FROM c_tbl where confirm=0 order by c_id desc";
                        $rs1 = $conn->query($str1) or die("Error");
                        $i = 1;

                        while ($row1 = $rs1->fetch()) {
                                echo "<tr cid='$row1[0]'>
                                    <td>$i</td>
                                    <td>$row1[1]</td>
                                    <td>$row1[2]</td>
                                    <td>$row1[3]</td>
                                    <td>" . date('Y-m-d', strtotime($row1[4])) . "</td>
                                    <td>
                                        <a href='uploads/$row1[5]' target='_blank' class='btn btn-sm btn-info'>
                                            <i class='fas fa-file-pdf'></i>
                                        </a>
                                    </td>
                                    <td>
                                        <button class='btn btn-sm btn-danger delete-button' id='$row1[0]' 
                                                onclick='delete_record(this.id)'>
                                            <i class='fas fa-trash'></i>
                                        </button>
                                    </td>
                        </tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">© 2024 ප්‍රධාන ලේකම් කාර්යාලය, දකුණු පළාත</p>
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
            var table = $('#dataTable').DataTable({
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
                }
            });

            // Form submission
            $('#circularForm').on('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('චක්‍රලේඛය සාර්ථකව එක් කරන ලදී!');
                        $('#circularForm')[0].reset();
                        location.reload();
                    },
                    error: function() {
                        alert('දෝෂයක් ඇති විය. නැවත උත්සාහ කරන්න.');
                    }
                });
            });
        });

        // Delete record function
        function delete_record(id) {
            if (!confirm("Do you want to delete this record?")) return;

            const data = {
                type: "del",
                id: id
            };

            $.ajax({
                url: "deletedata.php",
                type: "POST",
                data: data,
                success: function(resp) {
                    if (resp == "success") {
                        alert("සාර්ථකව මකා දමන ලදී!");
                        window.location.reload();
                    } else {
                        alert("මකා දැමීමේ දෝෂයකි. නැවත උත්සාහ කරන්න.");
                    }
                }
            });
        }
    </script>
</body>
</html>