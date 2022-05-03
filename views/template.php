<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=TXT_APP_NAME?> - <?=$title;?></title>
    <link rel="shortcut icon" href="public/images/favicon.png" />
    <?= $headerStyle; ?>
</head>

<body>
<div class="container-scroller">
    <!-- header Start -->
    <?=(isset($header))?$header:null?>
    <!-- header End -->

    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <?=(isset($content))?$content:null?>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <?= (isset($footer))?$footer:null?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- Start Script -->
<?= $footerScript?>
<!-- End Script -->
</body>

</html>