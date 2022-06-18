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

                    $url = "https://jsonplaceholder.typicode.com/albums/1";

                    $play_load = json_encode([
                       'title' => 'Update title'
                    ]);

                    $options = [
                        "http" => [
                            "method" => "PATCH",
                            "header" => "Content-type: application/json; charset=UTF-8\r\n",
                                        "Accept-language: en",
                            "content" => $play_load,
                        ],
                    ];

                    $context = stream_context_create($options);
                    $data = file_get_contents($url, false, $context);

                    // allow_url_fopen (should be on)
                    // print_r($http_response_header);
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