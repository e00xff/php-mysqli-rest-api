<?php
ob_start();
?>
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
                <h4 class="mb-4">file_get_contents</h4>

                <?php

                    $pay_load = json_encode([
                        "title" => "Updated title",
                    ]);

                    $headers = [
                        "Content-type: application/json; charset=UTF-8",
                        "Accept-language: en"
                    ];

                    $ch = curl_init();

                    $url = "https://jsonplaceholder.typicode.com/users";

                    /*
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $pay_load);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    */

                    curl_setopt_array($ch, [
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_POSTFIELDS => $pay_load,
                        CURLOPT_HTTPHEADER => $headers,
//                        CURLOPT_HEADER => true,
                    ]);

                    $data = curl_exec($ch);
                    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    var_dump($status_code);
                    var_dump($data);

                ?>

            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

    });
</script>

</body>
</html>