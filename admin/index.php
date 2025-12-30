<!DOCTYPE html>
<html>
<head>
    <title>Kachumbari Travel Tour – STK Push</title>
</head>
<body>

<h2>Send M-PESA STK Push</h2>

<form method="POST">
    <label>Customer Phone (07XXXXXXXX)</label><br>
    <input type="text" name="phone" required><br><br>

    <label>Amount (KES)</label><br>
    <input type="number" name="amount" required><br><br>

    <button type="submit">Send STK Push</button>
</form>

<hr>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ===============================
       1. GET DATA YOU TYPE
    =============================== */
    $phone  = $_POST['phone'];
    $amount = $_POST['amount'];

    // Convert 07XXXXXXXX → 2547XXXXXXXX
    $phone = "254" . substr($phone, 1);

    /* ===============================
       2. YOUR M-PESA DETAILS
       ⚠️ REPLACE THESE
    =============================== */
    $consumerKey    = "REPLACE_WITH_CONSUMER_KEY";
    $consumerSecret = "REPLACE_WITH_CONSUMER_SECRET";
    $shortcode      = "REPLACE_WITH_PAYBILL_NUMBER";
    $passkey        = "REPLACE_WITH_PASSKEY";

    $callbackUrl = "https://kachumbaritraveltour.com/office/callback.php";

    /* ===============================
       3. GET ACCESS TOKEN
    =============================== */
    $credentials = base64_encode($consumerKey . ':' . $consumerSecret);

    $ch = curl_init("https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic $credentials"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $accessToken = json_decode($response)->access_token;

    /* ===============================
       4. CREATE PASSWORD
    =============================== */
    $timestamp = date("YmdHis");
    $password  = base64_encode($shortcode . $passkey . $timestamp);

    /* ===============================
       5. STK PUSH REQUEST
    =============================== */
    $stkData = [
        "BusinessShortCode" => $shortcode,
        "Password" => $password,
        "Timestamp" => $timestamp,
        "TransactionType" => "CustomerPayBillOnline",
        "Amount" => $amount,
        "PartyA" => $phone,
        "PartyB" => $shortcode,
        "PhoneNumber" => $phone,
        "CallBackURL" => $callbackUrl,
        "AccountReference" => "KACHUMBARI_TRAVEL_TOUR",
        "TransactionDesc" => "Tour Payment"
    ];

    $ch = curl_init("https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($stkData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>

</body>
</html>
