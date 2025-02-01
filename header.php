<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index page</title>
    <link rel="stylesheet" href="style.css">
    <?php session_start() ?>
</head>
<body>
    <header>
        <h1><a href="index.php">my company</a></h1>
        <div class="links">
           
        <?php 
        if(isset($_SESSION['loggedin']))
        { ?>
        <a href="logout.php">logout</a>
        <a href="customers.php">customers</a>
        <a href="teststripe.php">test stripe</a>
        <?php
        } else
        { ?><a href="login.php">log in</a> <?php } ?>
        </div>
    </header>