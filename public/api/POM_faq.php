<?php
include("POM_config.php");
$sqluser = mysqli_query($conn, "SELECT * FROM faqs WHERE  banned='1'");
// echo "<pre>";
// print_r($sqluser);
// echo "</pre>";
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .accordion-button {
            font-size: 100% !important;
            font-weight: 600;
        }

        p {
            font-size: 28px !important;
        }
    </style>
</head>

<body>
    <div class="m-4">
        <div class="accordion" id="myAccordion">
            <?php while ($marketData = mysqli_fetch_assoc($sqluser)) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne<?= $marketData['id'] ?>">
                        <button type="button" class="accordion-button collapsed " data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $marketData['id'] ?>">
                            <?= $marketData['title']; ?></button>
                    </h2>
                    <div id="collapseOne<?= $marketData['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                        <div class="card-body">
                            <p><?= $marketData['description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">2. What is Bootstrap?</button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#myAccordion">
                    <div class="card-body">
                        <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                    </div>
                </div>
            </div> -->
            <!-- <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree">3. What is CSS?</button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                    <div class="card-body">
                        <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>

</html>