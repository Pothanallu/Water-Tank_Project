<?php
session_start();

date_default_timezone_set('Asia/Kolkata'); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pothan";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_name'])) {
    echo "<script>alert('Please log in or register first.'); window.location.href='signup.html';</script>";
    exit;
}

$user_name = $_SESSION['user_name'];

$sql_user = "SELECT * FROM user WHERE Name = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $user_name);
$stmt_user->execute();
$result = $stmt_user->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>alert('User not found!'); window.location.href='signup.html';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $updated_name = $_POST['name'];
    $updated_phone = $_POST['phone'];
    $updated_email = $_POST['email'];
    $updated_address = $_POST['address'];
    $updated_landmark = $_POST['landmark'];

    $update_sql = "UPDATE user SET Name = ?, PhoneNo = ?, Email = ?, Address = ?, Landmark = ? WHERE Id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $updated_name, $updated_phone, $updated_email, $updated_address, $updated_landmark, $user['Id']);

    if ($update_stmt->execute()) {
        $_SESSION['user_name'] = $updated_name;

        echo "<script>
                alert('User details updated successfully!');
                window.location.href = 'order.php'; // Redirect to the order page to show updated details
              </script>";
    } else {
        echo "<script>alert('Failed to update details. Please try again.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $trays = $_POST['trays'];
    $tanker_size = $_POST['tanker'];
    $num_tankers = $_POST['number_of_tankers'];

    $amount_per_tray = 300;
    $amount_per_tanker = 1000; 
    $total_amount = ($trays * $amount_per_tray) + ($num_tankers * $amount_per_tanker);

    $insert_sql = "INSERT INTO `order` (UserId, LiterType, Trays, NoofTankers, Amount)
                   VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);

    $insert_stmt->bind_param("isiii", $user['Id'], $tanker_size, $trays, $num_tankers, $total_amount);

    if ($insert_stmt->execute()) {
        echo "<script>
                alert('Order placed successfully!');
                window.location.href = 'payment.php'; // Redirect to payment page
              </script>";
    } else {
        echo "<script>alert('Failed to place the order. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page - Packed Drinking Water</title>
    <link rel="stylesheet" href="ordernow.css">
</head>
<body>
    <div class="container">
        <h2>Your Details</h2>
        <?php if ($user): ?>
            <p>Name: <?php echo htmlspecialchars($user['Name']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($user['PhoneNo']); ?></p>
            <p>Email: <?php echo htmlspecialchars($user['Email']); ?></p>
            <p>Address: <?php echo htmlspecialchars($user['Address']); ?></p>
            <p>Landmark: <?php echo htmlspecialchars($user['Landmark']); ?></p>
            <button id="updateDetailsBtn" onclick="toggleUpdateForm()">Update Details</button>

            <div id="updateForm" style="display: none;">
                <form method="POST">
                    <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user['Name']); ?>" required>
                    <input type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($user['PhoneNo']); ?>" required>
                    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                    <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($user['Address']); ?>" required>
                    <input type="text" name="landmark" placeholder="Landmark" value="<?php echo htmlspecialchars($user['Landmark']); ?>" required>
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        <?php else: ?>
            <p>User details could not be retrieved.</p>
        <?php endif; ?>

        <h2>Place Your Order</h2>
        <form method="POST">
            <label for="trays">Number of Trays:</label>
            <input type="number" name="trays" id="trays" required min="1" oninput="calculateAmount()" />

            <label for="tanker">Tanker Size:</label>
            <select name="tanker" id="tanker" required onchange="calculateAmount()">
                <option value="5">5 Liters</option>
                <option value="10">10 Liters</option>
            </select>

            <label for="number_of_tankers">Number of Tankers:</label>
            <input type="number" name="number_of_tankers" id="number_of_tankers" value="0" min="0" oninput="calculateAmount()" />

            <p>Total Amount: ₹<span id="totalAmount">0</span></p>

            <button type="submit" name="place_order">Place Order</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Packed Drinking Water. All rights reserved.</p>
    </footer>

    <script>
        function toggleUpdateForm() {
            const form = document.getElementById("updateForm");
            const button = document.getElementById("updateDetailsBtn");

            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
                button.innerText = "Cancel"; 
            } else {
                form.style.display = "none";
                button.innerText = "Update Details"; 
            }
        }

        function calculateAmount() {
            const trays = parseInt(document.getElementById("trays").value) || 0;
            const tankers = parseInt(document.getElementById("number_of_tankers").value) || 0;
            const tankerSize = document.getElementById("tanker").value;

            const amountPerTray = 300; 
            const amountPerTanker = 1000; 

            const totalAmount = trays * amountPerTray + tankers * amountPerTanker;
            
            document.getElementById("totalAmount").innerText = totalAmount;
        }
    </script>
</body>
</html>
