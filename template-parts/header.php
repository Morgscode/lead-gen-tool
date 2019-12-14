<?php 
/**
 * Template Name: Header.php
 * 
 */

?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lead Generation Tool</title>
    <meta name="description" content="A tool for tracking leads">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="localhost/leadGenTool/style.css">
</head>

<body>
    <div class="site-bg container-fluid bg-light p-0">
        <header>
            <div class="container-fluid navBg bg-dark">
                <nav class="navbar container">
                    <h2 class="navbar-brand text-light">Lead Gen Tool</h2>
                    <ul class="navlinks-wrapper d-flex align-items-center">
                        <li class="nav-link">
                            <a href="/leadGenTool" class="nav-item">Home</a>
                        </li>
                        <?php if (!isset($_POST['company-name'])) : ?>
                        <li class="nav-link">
                            <a href="/leadGenTool/add-lead" id="formDisplay" class="nav-item mb-0">Add
                                Lead</a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="site-container container" style="background: #f9f9f9">