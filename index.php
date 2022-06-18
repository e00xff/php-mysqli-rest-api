<!doctype html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main role="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h4 class="mb-4">API - Application Program Interface</h4>

                <h5>Web APIs</h5>
                <ul>
                    <li>Open APIs</li>
                    <li>Partner APIs</li>
                    <li>Internal APIs</li>
                </ul>

                <h5>Web Service APIs</h5>
                <ul>
                    <li>SOAP</li>
                    <li>XML-RPC</li>
                    <li>JSON-RPC</li>
                    <li>REST</li>
                </ul>

                <h5>REST API</h5>
                <ul class="mb-0">
                    <li>REST - Representational State Transfer</li>
                    <li>Formats: JSON, XML, text, user-defined</li>
                    <li>HTTP Methods:
                        <ul>
                            <li>GET (Read Data)</li>
                            <li>PUT (Update Data)</li>
                            <li>POST (Insert or Create Data)</li>
                            <li>DELETE (Delete Data)</li>
                        </ul>
                    </li>
                    <li>
                        Restful API with PHP:
                        <ul>
                            <li>header('Content-Type: application/json');</li>
                            <li>header('Access-Control-Allow-Methods: PUT');</li>
                            <li>header('Access-Control-Allow-Origin: *');</li>
                            <li>header('Access-Control-Allow-Headers: < header-name >');</li>
                        </ul>
                    </li>
                    <li><a href="https://en.wikipedia.org/wiki/List_of_HTTP_header_fields" target="_blank">List of HTTP header fields</a></li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>