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
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
                <title>HOMEPAGE</title>
</head>

<style>
/* #footer li {
    list-style-type: none;
}

#footer .row {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 0px;
} */
.landing {
    background: url('./images/bank.jpg');
    background-position: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    margin-top: 55px;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.intro {
    color: white;
    width: 70vw;
    text-align: center;

}

.intro h1 {
    font-size: 5em;
}
.container mb-5{
    background-color: aqua;
}
</style>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="homepage.html">Ghana Commercial Bank</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link active text-white" id="paybills" href=""><i class="fa fa-plus"
                                aria-hidden="true"></i>
                            Pay Bills</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active text-white" id="listTrans" href="#"><i class="fa fa-list"
                                aria-hidden="true"></i>
                            List Trasactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" id="logout" href="#"><i class="fa fa-user"
                                aria-hidden="true"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Landing -->
    <div class="landing">
        <!-- Introduction -->
        <div class="intro">
            <marquee style="color:black;"><h1>Welcome back!</h1></marquee>
        </div>
    </div>
    </div>

    <!-- Events -->
    <div class="container mb-5" style="background-color: rgb(240, 239, 239); position: absolute;  top:850px; left:90px; border: 5px solid rgb(0, 0, 0); border-radius: 5px;" >
        <div class="row">
            <h3>Dave's Shop</h3>
            <div class="col mb-5">
                <div class="card" style="width: 18rem; background-color: rgb(240, 239, 239);">
                    <img src="./images/rolex.jpg" height="250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Rolex</h5>
                        <span>Price: $8000.00</span><br>
                        <button type="submit" class="btn btn-dark w-100 mt-4" id="rolex">Buy</button>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card" style="width: 18rem; background-color: rgb(240, 239, 239);">
                    <img src="./images/macbook.jpg" height="250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">MacBook Pro</h5>
                        <span>Price: $1000.00</span><br>
                        <button type="submit" class="btn btn-dark w-100 mt-4" id="macbook">Buy</button>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card" style="width: 18rem; background-color: rgb(240, 239, 239);">
                    <img src="./images/camera.jpg" height="250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Red Camera</h5>
                        <span>Price: $500.00</span><br>
                        <button type="submit" class="btn btn-dark w-100 mt-4" id="camera">Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
                integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
                crossorigin="anonymous">
            </script>
            <script>
            const logout = document.querySelector('#logout');
            const rolex = document.querySelector('#rolex');
            const macbook = document.querySelector('#macbook');
            const camera = document.querySelector('#camera');
            const paybills = document.querySelector('#paybills');
            const listTrans = document.querySelector('#listTrans');

            logout.addEventListener('click', () => {
                fetch('http://localhost/gateway/api/client_website/logout.php', {
                        method: 'POST'
                    })
                    .then((res) => {
                        location.href = res.url;
                    })
                    .catch((err) => console.log(err));
            });

            rolex.addEventListener('click', () => {
                fetch('http://localhost/gateway/api/gateway/returnpage.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product: 'rolex',
                            cost: 8000
                        })
                    })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        window.location = data.redirectURL;
                    })
            });

            macbook.addEventListener('click', () => {
                fetch('http://localhost/gateway/api/gateway/returnpage.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product: 'MacBook M1 Pro',
                            cost: 1000
                        })
                    })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        window.location = data.redirectURL;
                    })
            });

            camera.addEventListener('click', () => {
                fetch('http://localhost/gateway/api/gateway/returnpage.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product: 'camera',
                            cost: 500
                        })
                    })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        window.location = data.redirectURL;
                    })
            });

            paybills.addEventListener('click', (e) => {
                e.preventDefault();
                fetch('http://localhost/gateway/api/gateway/returnpage.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            product: 'Bills',
                            cost: 1250
                        })
                    })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        window.location = data.redirectURL;
                    })
            });

            listTrans.addEventListener('click', (e) => {
                e.preventDefault();
                fetch('http://localhost/gateway/api/gateway/returntrans.php').then((res) => {
                        location.href = res.url;
                    })
                    .catch((err) => console.log(err));
            });
            </script>

</html>