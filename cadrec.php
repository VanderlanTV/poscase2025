<?php

namespace App\Controllers;
//view listinput
?>
<?php
$this->extend('templates/header');
?>

<?php $this->section('content') ?>

<!-- ativar este menu apenas quando usuarios direitos de acccos estiver ok -->
<!-- <= $this->include('Estoque/menu_estoqcom.php') ?> -->

<?= $this->include('Estoque/Cadrec/headcadrec.php') ?>

<!-- Inventários, Estoque mínimo, CFOP, CST, CSOSN, CST, ICMS, NCM etc -->
<?= $this->include($viewIncludeDetail) ?>
<!-- <= $this->include($divreportcadpro)
 //reports/v_estoque/divreportcadpro.php?>  -->



<script src="<?php echo base_url('public/js/jquery-3.6.0.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- <script  src="<php echo base_url("public/dataTables-1.10.21/js/jquery.dataTables.js") ?>"></script> -->
<script src="<?php echo base_url("public/dataTables-1.10.21/js/jquery.dataTables.js") ?>"></script>
<script src="<?php echo base_url('public/js/custom.js') ?>"></script>


<script>
    //  dataTables.net
    //https://dataTables.net/examples/basic_init/scroll_xy.html
    $(document).ready(function() {
        $('#mastertable').DataTable({
            "scrollY": 350,
            // "scrollX": false,
            "pageLength": 11,
            "ordering": false,
            "scrollCollapse": true,
            "paging": false,
            "searching": false,
            "info": false
        });
        // "deferRender": true
    });
</script>






<!-- <script>
    function tabE(obj, e) {
        var e = (typeof event != 'undefined') ? window.event : e; // IE : Moz
        if (e.keyCode == 13) {
            var ele = document.forms[0].elements;
            for (var i = 0; i < ele.length; i++) {
                var q = (i == ele.length - 1) ? 0 : i + 1; // if last element : if any other
                if (obj == ele[i]) {
                    ele[q].focus();
                    break
                }
            }
            return false;
        }
    }
</script> -->


<script>
    $(document).ready(function() {
        $('[data-toggle="pca_tooltip"]').tooltip();
    });
</script>

<?php $this->endSection() ?>