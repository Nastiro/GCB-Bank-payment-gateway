<?php
//Initialize the session
session_start();

//Check if user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: http://localhost/gateway/api/client_website/frontend/login.php");
    exit;
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../css/homepage.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>EventDeb</title>
</head>


<body>

    <table class="table" id="transaction-table">
        <thead>
            <tr>
                <th scope="col">Item</th>
                <th scope="col">Price</th>
                <th scope="col">Request Refund</th>
            </tr>
        </thead>
        <tbody id="transaction-body">
            <tr>
                <th scope="row">Bag</th>
                <td>$80</td>
                <td><button type="button" class="btn btn-dark" id="bag">Refund</button></td>
            </tr>
            <tr>
                <th scope="row">TextBook</th>
                <td>$50</td>
                <td><button type="button" class="btn btn-dark" id="textbook">Refund</button></td>
            </tr>
            <tr>
                <th scope="row">Uniform</th>
                <td>$40</td>
                <td><button type="button" class="btn btn-dark" id="uniform">Refund</button></td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>

    <script>
    const bag = document.querySelector('#bag');
    const uniform = document.querySelector('#uniform');
    const books = document.querySelector('#textbook');

    const data = new Object();
    data.index_number = '1234567';

    const result = JSON.stringify(data);
    console.log(result);

    fetch('http://localhost/gateway/api/gateway/getTransactions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: result
        })
        .then((res) => {
            return res.json();
        })
        .then((data) => {
            const tableBody = document.getElementById('transaction-body');
            let innerHTML = "";
            tableBody.innerHTML = "";
            data.forEach((data) => {
                innerHTML += `<tr>
               <td>${data.product_name} </td>
               <td>${data.amount} </td>
               <td><button onclick="makeRefund(${data.id}, ${data.amount})" type="button" class="btn btn-dark" id="textbook">Refund</button> </td>
                </tr>`
            });

            tableBody.innerHTML = innerHTML
        })
        .catch((err) => console.log(err));

    //refunds
    async function makeRefund(id, amount) {
        let req = await fetch('http://localhost/gateway/api/gateway/refund.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                amount: amount,
                card_number: '0000111122223333'
            })
        })
        let res = await res.json();
        if (req.ok) {
            alert('Success');
        }
        alert('sucess');
    }
    </script>
</body>

</html>