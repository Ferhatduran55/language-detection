<?php
require_once "Classes/Main.php";
?>
<!DOCTYPE html>
<html lang="<?= Language::GetLanguage() ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Language::GetValue("title") ?></title>
    <meta name="description" content="<?= Language::GetValue("description") ?>">
    <meta name="author" content="<?= Language::GetValue("author") ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body style="background-color:black">
    <div class="container-fluid">
        <div style="background-color:aquamarine;padding:10px; text-align:center;border-radius:5px;box-shadow:0 0 5px aquamarine,0 0 15px aqua,0 0 30px aquamarine; display:block;margin:5px auto;max-width: fit-content;font:bolder 11pt Consolas;color:black;">
            <?= date(Language::GetValue("dateformat")) ?> <br>
            <?= Language::GetValue("text", "author") ?> <?= Language::GetValue("author") ?> <br>
            <?= Language::GetValue("text", "author") ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-10 col-lg-7 mx-auto mt-2">
                    <div class="card bg-dark text-danger border border-danger rounded-0">
                        <div class="card-header border-danger p-2">JSON - <?= Language::GetLanguage() ?></div>
                        <div class="card-body">
                            <?php
                            echo "<pre>";
                            print_r(Language::$langs);
                            echo "</pre>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>