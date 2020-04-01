<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL_BASE . "" ?>assets/img/favicon.ico">
        <title>Crm Unisystem</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!--alerts CSS -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/sweetalert/sweetalert.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/plugins/iCheck/all.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/select2/dist/css/select2.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/dist/css/AdminLTE.min.css">
        <!-- fullCalendar -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

        <!-- AdminLTE Skins. Choose a skin from the css/skins
                 folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/dist/css/skins/_all-skins.min.css">
        <link href="<?php echo URL_BASE . "" ?>asse/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    </head>
	

    <!-- INICIO DA VALIDA SESSÃO --> 
    <?php
    if (!isset($_SESSION["usuarioLogado"]->NOME_USUARIO)) {
        header("location: " . URL_BASE);
    } else {
        ?>

        <body class="sidebar-mini wysihtml5-supported skin-blue-light sidebar-collapse">

            <!-- layout preferido abaixo 
                    <body class="sidebar-mini wysihtml5-supported skin-black-light sidebar-collapse"> -->

            <div class="wrapper">

                <!-- 	CABEÇALHO  -->
                <header class="main-header">
                    <?php include "cabecalho.php"; ?>
                </header>		  

                <!--           MENU           -->
                <aside class="main-sidebar">
                    <section class="sidebar">
                        <?php include "menu.php"; ?>
                    </section>
                </aside>

                <!-- AQUI CARREGA O CONTEUDO PRINCIPAL  -->
                <div class="content-wrapper">
                    <?php $this->load($view, $viewDados) ?>
                </div>

                <!-- RODAPÉ DA PAGINA -->
                <?php include "rodape.php"; ?>

            </div>

            <!-- AQUI habilita as ferramentas da Engrenagem Superior Direita.  -->
            <?php //include "ferramentas.php";?>

    <?php } ?> 
        <!-- FIM DA VALIDA SESSÃO --> 
       
        <!-- jQuery 3 -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <!-- Sweet-Alert  -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo URL_BASE . "" ?>assets/dist/js/adminlte.min.js"></script>
        <!-- Sparkline -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- jvectormap  -->
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- ChartJS -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/chart.js/Chart.js"></script>
       <!-- AdminLTE for demo purposes -->
        <script src="<?php echo URL_BASE . "" ?>assets/dist/js/demo.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <!-- fullCalendar -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/moment/moment.js"></script>
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script async="" src="//www.google-analytics.com/analytics.js"></script>
        <!-- Ck Editor -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/ckeditor/ckeditor.js"></script>
        <!-- NicEdit -->
        <script src="<?php echo URL_BASE . "" ?>assets/bower_components/nicEdit/nicEdit.js"></script>
        <script type="text/javascript" src="<?php echo URL_BASE . "" ?>assets/bower_components/nicEdit/nicEdit-latest.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo URL_BASE . "" ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

        <!-- Necessario para Data Tables -->
        <script rel="stylesheet" href="<?php echo URL_BASE . "" ?>assets/bower_components/datatables/jquery.dataTables.min.js"></script>

        <!-- start - This is for export functionality only -->
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        <!-- end - This is for export functionality only -->

        <!-- NicEdit -->
    </script> <script type="text/javascript">
//<![CDATA[
bkLib.onDomLoaded(function () {
nicEditors.allTextAreas()
});
//]]>
    </script>

    <!-- page script -->
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>


    <script>
        $('#example1').DataTable({
            dom: 'Bfrtip'
            , buttons: ['excel']
                    //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'] botoes padroes, comentado por adoir para nao esquecer quais sao.
        });
    </script>

    <!-- Page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 1, format: 'MM/DD/YYYY h:mm A'})
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                    {
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function (start, end) {
                        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>

     <script src="<?php echo URL_BASE . "" ?>app/views/grafico.js"></script>

</body>
</html>
