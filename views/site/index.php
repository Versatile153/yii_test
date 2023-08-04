<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Yii Assessment!</h1>
        <p class="lead">Nigeria Election done and dusted, check results below.</p>
        <p><a class="btn btn-lg btn-success" href="<?= Yii::$app->urlManager->createUrl(['/elections/scores']) ?>">view Results</a></p>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>versatile153</h2>
                <p>I am a web developer, passionate about tech skills, i am open for work bothe online, remote and physical.</p>
                <p><a class="btn btn-outline-secondary" href="https://versatile153.netlify.app/">View Profile&raquo;</a></p>
            </div>

            <div class="col-lg-4 mb-3">
                <h2>Heading 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p><a class="btn btn-outline-secondary" href="https://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>

            <div class="col-lg-4">
    <img style="width: 300px;height:200px;" src="https://versatile153.netlify.app/assets/images/vers7.jpeg" alt="Image Description">
    <p>Eze celestine uwakwe</p>
    <p><a class="btn btn-outline-secondary" href="https://github.com/Versatile153">My github &raquo;</a></p>
</div>


        </div>
    </div>
</div>

<style>
    /* Add custom CSS here to style the view */

    .jumbotron {
        background-color: #f8f9fa;
        border-radius: 0;
    }

    .jumbotron h1 {
        font-weight: bold;
        color: #007bff;
    }

    .jumbotron p {
        font-size: 18px;
    }

    .col-lg-4 {
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 5px;
        background-color: #fff;
    }

    .col-lg-4 h2 {
        color: #343a40;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .col-lg-4 p {
        color: #6c757d;
        font-size: 16px;
    }

    .btn-outline-secondary {
        color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-secondary:hover {
        color: #fff;
        background-color: #007bff;
    }
</style>
