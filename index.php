<?php
/**
 * Created by PhpStorm.
 * User: luca leen
 * Date: 21/04/2017
 * Time: 16:10
 */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


function get_data($path)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

$host = get_data("rancher-metadata/latest/self/host/name") ?: "something different than rancher";
$service = get_data("rancher-metadata/latest/self/service/name") ?: "not identified";
$container = get_data("rancher-metadata/latest/self/container/name") ?: "ghost";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>Rancher Scale Tester</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://getbootstrap.com/examples/cover/cover.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }

        .lead {
            line-height: 1.5;
            font-size: 3rem;
        }

        h1 {
            font-size: 6.5rem;
            margin-bottom: 60px;
        }

        .masthead, .mastfoot, .cover-container {
            width: 100% !important;
        }
    </style>
</head>
<body>
<div class="site-wrapper">

    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="inner cover">
                <h1 class="cover-heading">Hey, friend!</h1>
                <p class="lead">My name is <b><?php echo $container; ?></b>, <br/> part of
                    <b><?php echo $service; ?></b> service.</p>
                <p class="lead">
                    <i>I'm alive thanks to <b><?php echo $host; ?></b>, that is hosting me.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
