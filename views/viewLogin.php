<?php
$title = "Login";
require_once("views/commons/alertMessage.php");
ob_start();
?>
<!-- Start Login -->


<div class="card overflow-hidden account-card mx-3">
    <div class="bg-dark p-4 text-white text-center position-relative">
        <h4 class="font-20 m-b-5">Welcome Back !</h4>
        <p class="text-white-50 mb-4">Sign in to continue to <span class="text-light">RLMS</span> <span class="text-warning">2.0</span>.</p>
        <a class="logo logo-admin"><img src="public/images/logo.png" height="47" alt="logo"></a>
    </div>
    <div class="account-card-content">
        <form class="form-horizontal m-t-30" method="post" autocomplete="off">
            <?=$alertMessage?>
            <div class="form-group">
                <label for="username">Username</label>
                <input name="cuid" type="text" class="form-control" id="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="userpassword">Password</label>
                <input name="password" type="password" class="form-control" id="userpassword" placeholder="Enter password">
            </div>
            <div class="form-group row m-t-20">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6 text-right">
                    <button name="loginMe" class="btn btn-warning w-md waves-effect waves-light" type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="m-t-40 text-center">
    <p>Don't have an account ? <span class="font-500 text-warning"> Just Sign In and conctact the Admin </span> </p>
    <p>©2021 <span class="font-500 text-warning">RLMS 2.0</span> <span class="d-none d-sm-inline-block"> - Crafted with </span><i class="mdi mdi-heart text-danger"></i> <span class="font-500 text-warning">by DSF</span></p>
</div>

<!-- end wrapper-page -->
<!-- Login End -->

<?php
$content = ob_get_clean();
//    require("layouts/header.php");
//    require("layouts/footer.php");
require("layouts/footerScript.php");
require("layouts/headerStyle.php");
require("views/template-old2.php");
?>
<script>

    $(document).ready(function() {
        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            select: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'colvis'],
            "ajax": {
                "type"   : "POST",
                "url"    : 'dataTableLoader',
                "data"   : {
                    "methode" : "getLodHistoryDT",
                    "status" : "<?=$status?>",
                    "debut" : "<?=$debut?>",
                    "fin" : "<?=$fin?>"
                }
            },
            "columnDefs": [
                {
                    "targets": [ 9 ],
                    "visible": false
                }
            ]
            // "ajax": "public/ajax/data/chargement.txt"
        });
        setInterval( function () {
            table.ajax.reload();
        }, 30000 );
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    } );

</script>