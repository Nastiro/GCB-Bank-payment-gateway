<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="#" class="box" id="form">
                        <h1>Login</h1>
                        <p class="text-muted"> Please enter your login and password!</p>
                        <input type="text" id="index" name="index" placeholder="text">
                        <input type="password" id="password" name="password" placeholder="Password">
                        <a class="forgot text-muted" href="#">Forgot password?</a>
                        <input type="submit" name="" value="Login" href="#">

                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
    <!-- Custom javascript -->
    <script>
    const login = document.querySelector('input[type="submit"]');

    var status;

    login.addEventListener('click', (e) => {
        e.preventDefault();
        const index = document.querySelector('#index');
        const password = document.querySelector('#password');

        //Create a javascript object and parse the values to it
        const data = new Object();
        data.index_number = index.value;
        data.password = password.value;

        const result = JSON.stringify(data);
        console.log(result);

        fetch('http://localhost/gateway/api/client_website/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: result
            })
            .then((res) => {
                status = res.status;
                return res.text();
            })
            .then((data) => {
                alert(data);
                if (status == 200) {
                    location.href =
                        'http://localhost/gateway/api/client_website/frontend/homepage.php';
                }
            })
            .catch((err) => {
                console.log(err);
            });
    });
    </script>
</body>

</html>