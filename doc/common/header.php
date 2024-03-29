<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Daxslab">
    <title><?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/default.css" rel="stylesheet">

    <style>
        body {
            padding-top: 5rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">noCaptcha</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Examples</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="css_hidden_field_honeypot.php">CSS hidden field honeypot</a>
                    <a class="dropdown-item" href="javascript_generated_hidden_field_honeypot.php">JavaScript generated hidden field honeypot</a>
                    <a class="dropdown-item" href="javascript_filled_input.php">JavaScript filled input</a>
                    <a class="dropdown-item" href="session_time_trap.php">Session based time trap</a>
                    <a class="dropdown-item" href="form_time_trap.php">Form based time trap</a>
                    <a class="dropdown-item" href="cookie_check.php">Cookie check</a>
                    <a class="dropdown-item" href="multiple_rules.php">Multiple rules</a>
                    <a class="dropdown-item" href="random_field_name.php">Random field name</a>
                    <a class="dropdown-item" href="multiple_random_field_names.php">Multiple random field names</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">
