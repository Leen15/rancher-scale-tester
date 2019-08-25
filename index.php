<?php

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

$host = get_data("rancher-metadata/latest/self/host/name") ?: "an unknown host";
$service = get_data("rancher-metadata/latest/self/service/name") ?: "not identified";
$container = get_data("rancher-metadata/latest/self/container/name") ?: "ghost";

if (getenv('K8S_NODE'))
  $host = getenv('K8S_NODE');

if (getenv('K8S_NAMESPACE'))
  $service = getenv('K8S_NAMESPACE');

if (getenv('K8S_POD'))
  $container = getenv('K8S_POD');

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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/cover.css" rel="stylesheet">
    <style>
        body {
            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .lead {
            line-height: 1.5;
            font-size: 1.8rem;
        }

        h1 {
            font-size: 4rem;
            margin-bottom: 60px;
        }

        .masthead, .mastfoot, .cover-container {
        }
    </style>
</head>
<body class="text-center" cz-shortcut-listen="true">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
    </div>
  </header>

  <main role="main" class="inner cover">
    <h1 class="cover-heading">Hey, friend!</h1>
    <p class="lead">My name is <b><?php echo $container; ?></b>, <br/> part of
        <b><?php echo $service; ?></b> service.</p>
    <p class="lead">
      <i>I'm alive thanks to <b><?php echo $host; ?></b>,<br/> that is hosting me.</i>
    </p>
    <p class="lead">
      <button type="submit" onClick="window.location.reload(true)"
      class="btn btn-lg btn-secondary">Reload</button>
   </p>
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
    </div>
  </footer>
</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
