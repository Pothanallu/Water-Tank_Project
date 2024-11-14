<?php
session_start();

// Retrieve user ID
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "<script>alert('Please log in or register first.'); 
          window.location.href='signup.html';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Options</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            margin: auto;
        }

        h2 {
            color: #333333;
            margin-bottom: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #45a049;
        }

        #doneButton {
            width: 48%;
            font-size: 14px;
        }

        #proceedButton {
            width: 80%;
            margin-left: 4%;
            padding: 12px;
            font-size: 18px;
        }

        #cashOnDeliveryMessage {
            color: #333;
            margin-top: 15px;
            font-size: 14px;
        }

        #qrCode {
            margin-top: 15px;
        }

        .checkmark-animation {
            display: none;
            margin-top: 20px;
            color: #4CAF50;
            font-size: 48px;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script>
        function redirectToPayment() {
            window.location.href = 'thankyou.html';
        }

        function doneAction() {
            const selectedPayment = document.querySelector('input[name="payment_option"]:checked').value;
            const cashOnDeliveryMessage = document.getElementById("cashOnDeliveryMessage");
            const qrCodeDiv = document.getElementById("qrCode");

            console.log("Selected Payment Option: " + selectedPayment); // Debugging line

            if (selectedPayment === 'pay_now') {
                qrCodeDiv.innerHTML = "<img src='https://api.qrserver.com/v1/create-qr-code/?data=https://your-payment-gateway-url.com&size=150x150' alt='QR Code for Payment'>";
                cashOnDeliveryMessage.textContent = "";
            } else {
                qrCodeDiv.innerHTML = "";
                cashOnDeliveryMessage.textContent = "Cash on Delivery selected. You can pay upon receiving the order.";
            }

            setTimeout(function() {
                document.querySelector('.checkmark-animation').style.display = 'block';
            }, 2000);
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Choose Payment Method</h2>
        <form id="paymentForm">
            <div class="payment-option">
                <input type="radio" id="cash_on_delivery" name="payment_option" value="cash_on_delivery" checked />
                <label for="cash_on_delivery">Cash on Delivery</label>
            </div>
            <div class="payment-option">
                <input type="radio" id="pay_now" name="payment_option" value="pay_now" />
                <label for="pay_now">Pay Now</label>
            </div>
            <button type="button" id="doneButton" onclick="doneAction()">Done</button>
        </form>
        <p id="cashOnDeliveryMessage"></p>
        <div id="qrCode"></div>
        
        <div class="checkmark-animation">&#10004;</div> <!-- Green checkmark animation -->
        <button type="button" id="proceedButton" onclick="redirectToPayment()">Proceed</button>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Packed Drinking Water. All rights reserved.</p>
    </footer>
</body>
</html>
