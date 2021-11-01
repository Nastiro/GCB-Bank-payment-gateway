<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<style>
body {
    background: grey;
}
</style>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box">
                        <h2>Visa</h2>
                        <p class="text-muted"> Please enter your credentials</p>
                        <input type="text" id="card_name" name="card_name" placeholder="name">
                        <input type="text" id="card_number" name="card_number" placeholder="**** **** **** 4123">
                        <input type="text" id="card_expire_date" name="card_expire_date" placeholder="09/2020">
                        <input type="password" id="card_cvv" name="card_cvv" placeholder="cvv: ***">
                        <input type="submit" id="submit" value="submit" href="#">
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>

    <script>
    const submit = document.querySelector('#submit');


    submit.addEventListener('click', (e) => {
        e.preventDefault();
        let search = window.location.search;
        let urlParams = new URLSearchParams(search);
        const card_number = document.querySelector('#card_number');
        const card_name = document.querySelector('#card_name');
        const card_expire_date = document.querySelector('#card_expire_date');
        const card_cvv = document.querySelector('#card_cvv');
        const data = new Object();
        data.card_number = card_number.value;
        data.card_name = card_name.value;
        data.card_expire_date = card_expire_date.value;
        data.card_cvv = card_cvv.value;
        data.cost = urlParams.get('cost');

        const data2 = JSON.stringify(data);
        console.log(data2);

        fetch('http://localhost/gateway/api/gateway/logTransaction.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'product_name': urlParams.get('product'),
                'amount': urlParams.get('cost'),
                'index_number': '1234567'
            })
        }).then((res) => {
            console.log(res);
        }).catch((err) => {
            console.log(err);
        })


        console.log(urlParams.get('product'));

        fetch('http://localhost/gateway/api/gateway/gateway.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: data2
            })
            .then((res) => {
                return res.text();
            })
            .then((data) => {
                alert(data);
                location.href = 'http://localhost/gateway/api/client_website/frontend/homepage.php';
            })
    });
    </script>
</body>

</html>