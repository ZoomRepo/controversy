<?php
// Database connection
$servername = "localhost";
$username = "root"; // Update with your MySQL username
$password = "A1-cxurnk"; // Update with your MySQL password
$dbname = "controversial_deaths";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch deaths in chronological order
$sql = "SELECT * FROM deaths WHERE hide != 1 ORDER BY death_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controversial Deaths</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="custom.css" rel="stylesheet">
    <link rel="icon"  sizes="32x32" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
    <div class="container my-5">
        <header class="text-center mb-4">
            <h1 class="display-4">Controversial Deaths</h1>
            <p class="lead">Unveiling the hidden truths behind eerie fates</p>
        </header>
        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-12 mb-4">
                    <div class="card shadow-sm">
                            <?php if (!empty($row['image'])): ?>
                                <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Image of <?php echo htmlspecialchars($row['name']); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h2 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h2>
                                <p><strong>Background:</strong> <?php echo htmlspecialchars($row['background']); ?></p>
                                <?php if (!empty($row['court_dates'])): ?>
                                    <p><strong>Court Dates:</strong> <?php echo htmlspecialchars($row['court_dates']); ?></p>
                                <?php endif; ?>
                                <p><strong>Tragic End:</strong> <?php echo htmlspecialchars($row['tragic_end']); ?></p>
                                <p><strong>Possible Motives:</strong> <?php echo htmlspecialchars($row['motives']); ?></p>
                                <p><strong>Date of Death:</strong> <?php echo htmlspecialchars($row['death_date']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No data available.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
