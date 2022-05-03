<?php
$title = "Accueil";
require_once("views/commons/alertMessage.php");
require("views/mainDashboard/mainStats.php");
require("views/mainDashboard/accueil.php");
ob_start();
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">Accueil</a>
        </li>
        <li class="active">Tableau de bord</li>
    </ul><!-- /.breadcrumb -->
</div>
<?=$alertMessage?>
<!-- Start Stat -->
<?=$mainStats;?>
<!-- Stat Historique de chargement -->
<?=$accueilContent;?>
<!-- Historique de chargement End -->

<?php
$content = ob_get_clean();
require("layouts/header.php");
require("layouts/footer.php");
require("layouts/footerScript.php");
require("layouts/headerStyle.php");
require("views/template.php");
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
                    "methode" : "getLaodHistoryDT",
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
        }, 300000 );
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    } );

</script>
