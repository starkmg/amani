<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="public/images/favicon.ico" rel="icon" />
    <title>RLMS 2.0 - <?=$title;?></title>
    <meta name="description" content="Chargement des ACL">
    <meta name="author" content="dsi.orangerdc.cd">

    <!-- Web Fonts
    ============================================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

    <!-- Stylesheet
    ============================================= -->
    <?= $headerStyle; ?>
</head>
<body>

<!-- Begin page -->
<div class="wrapper-page">
    <!-- Start container-fluid -->
    <?=(isset($content))?$content:null?>
    <!-- End container-fluid -->
</div>
<!-- END wrapper -->
<!-- Start Script -->
<?= $footerScript?>

<!-- End Script -->

</body>

</html>
