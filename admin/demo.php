<!DOCTYPE html>
<html>
<head>
    <title>Kachumbari Travel Tour – Admin Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }
        .box {
            background: #fff;
            padding: 25px;
            max-width: 400px;
            margin: auto;
            border-radius: 6px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            background: #1a73e8;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .success {
            background: #e6ffea;
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #2ecc71;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Admin Test Page</h2>
    <p><strong>Kachumbari Travel Tour</strong></p>

    <form method="POST">
        <label>Customer Phone (07XXXXXXXX)</label>
        <input type="text" name="phone" placeholder="0712345678" required>

        <label>Amount (KES)</label>
        <input type="number" name="amount" placeholder="32000" required>

        <button type="submit">Test Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $phone  = $_POST['phone'];
        $amount = $_POST['amount'];

        echo "<div class='success'>";
        echo "<h3>✅ TEST MODE SUCCESS</h3>";
        echo "<p><strong>Phone Entered:</strong> $phone</p>";
        echo "<p><strong>Amount Entered:</strong> KES $amount</p>";
        echo "<p>The admin page is working correctly.</p>";
        echo "<p><em>No M-PESA request sent.</em></p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
✅ NOW TEST

Open browser
👉 https://kachumbaritraveltour.com/office/

Enter:

Phone: 0712345678

Amount: 100

Click Send STK Push