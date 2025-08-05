<?php
$gdiff1 = 0;
$gdiff2 = 0;

$ndiff1 = 0;
$ndiff2 = 0;

$glist_all1 = 0;
$glist_all2 = 0;

$nlist_all1 = 0;
$nlist_all2 = 0;

if(isset($list_all1) && is_array($list_all1))
{
    $grand_total = 0;
    foreach($list_all1 as $val){
        if($val['parent_id']<1 || $val['affects_gross']==1)
        {
            $glist_all1++;
        }
        if($val['parent_id']<1 || $val['affects_gross']==0)
        {
            $nlist_all1++;
        }
    }
}

if(isset($list_all2) && is_array($list_all2))
{
    $grand_total = 0;
    foreach($list_all2 as $val){
        if($val['parent_id']<1 || $val['affects_gross']==1)
        {
            $glist_all2++;
        }
        if($val['parent_id']<1 || $val['affects_gross']==0)
        {
            $nlist_all2++;
        }
    }
}

if($glist_all1 > $glist_all2)
{
    $gdiff2 = $glist_all1 - $glist_all2;
}
else
{
    $gdiff1 = $glist_all2 - $glist_all1;
}

if($nlist_all1 > $nlist_all2)
{
    $ndiff2 = $nlist_all1 - $nlist_all2;
}
else
{
    $ndiff1 = $nlist_all2 - $nlist_all1;
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('common/html_head') ?>

    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/fonts/md-fonts/css/materialdesignicons.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/fonts/font-awesome-4.7.0/css/font-awesome.min.css"); ?>">
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/libs/animate.css/animate.min.css"); ?>">

    <!-- data table -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/libs/tables-datatables/dist/datatables.min.css"); ?>">
     <!-- jquery-loading -->
     <link rel="stylesheet" href="<?php echo base_url("/theme/oct/libs/jquery-loading/dist/jquery.loading.min.css"); ?>">
    <!-- octadmin main style -->
    <link id="pageStyle" rel="stylesheet" href="<?php echo base_url("/theme/oct/css/style.css"); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="app sidebar-fixed aside-menu-off-canvas aside-menu-hidden header-fixed">
<?= $this->include('common/header') ?>
    <!-- end header -->

    <div class="app-body">
        <div class="sidebar" id="sidebar">
            <?= $this->include('common/left_bar') ?>
        </div>
        <!-- end sidebar -->

        <main class="main">
            <!-- Breadcrumb -->
            <?= $this->include('common/breadcrumb') ?>         


            <div class="container-fluid">

                
                <div class="animated fadeIn">

                    <div class="clearfix">
                        <div class="float-left">
                            <h3 class="text-theme">Profit and Loss Statement</h3>
                            <p>This is the profit and loss statement for selected account.</p>
                        </div>
                    </div>
                    <!-- end clearfix -->
                    
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <h4 class="text-theme">Gross Expenses</h4>
                                    <table id="exampleTableSearch" class="display table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Group / Ledger</th>
                                                <th class="fc-rtl">(Dr) Amount</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php
                                        if(isset($list_all1) && is_array($list_all1))
                                        {
                                            $grand_total = 0;
                                            foreach($list_all1 as $val){
                                                if($val['parent_id']<1 || $val['affects_gross']==1)
                                                {
                                        ?>
                                            <tr<?php if(isset($val['ledger'])){ ?> class="text-theme"<?php } ?>>
                                                <td><?php echo str_repeat (' ----',$val['depth']); ?><?php if($val['depth']>0){ echo ">"; } ?><?php echo $val['name']; ?></td>
                                                <td class="fc-rtl">
                                                    &nbsp;<?php if(isset($val['net_total'])){ echo number_format($val['net_total']); $grand_total += $val['net_total']; } ?>
                                                </td>
                                            </tr>
                                        <?php 
                                                }
                                            }
                                        }
                                        ?>
                                        <?php for($i=0;$i<$gdiff1;$i++){ ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th class="fc-rtl">&nbsp;<?php echo number_format($grand_total); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->


                        <div class="col-md-6">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <h4 class="text-theme">Gross Income</h4>
                                    <table id="exampleTableSearch" class="display table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Group / Ledger</th>
                                                <th class="fc-rtl">(Cr) Amount</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php
                                        if(isset($list_all2) && is_array($list_all2))
                                        {
                                            $grand_total = 0;
                                            foreach($list_all2 as $val){
                                                if($val['parent_id']<1 || $val['affects_gross']==1)
                                                {
                                        ?>
                                            <tr<?php if(isset($val['ledger'])){ ?> class="text-theme"<?php } ?>>
                                                <td><?php echo str_repeat (' ----',$val['depth']); ?><?php if($val['depth']>0){ echo ">"; } ?><?php echo $val['name']; ?></td>
                                                <td class="fc-rtl">
                                                    &nbsp;<?php if(isset($val['net_total'])){ echo number_format($val['net_total']); $grand_total += $val['net_total']; } ?>
                                                </td>
                                            </tr>
                                        <?php 
                                                }
                                            }
                                        }
                                        ?>
                                        <?php for($i=0;$i<$gdiff2;$i++){ ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th class="fc-rtl">&nbsp;<?php echo number_format($grand_total); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                    </div>
                    <!-- end row -->


                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <h4 class="text-theme">Net Expenses</h4>
                                    <table id="exampleTableSearch" class="display table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Group / Ledger</th>
                                                <th class="fc-rtl">(Dr) Amount</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php
                                        if(isset($list_all1) && is_array($list_all1))
                                        {
                                            $grand_total = 0;
                                            foreach($list_all1 as $val){
                                                if($val['parent_id']<1 || $val['affects_gross']==0)
                                                {
                                        ?>
                                            <tr<?php if(isset($val['ledger'])){ ?> class="text-theme"<?php } ?>>
                                                <td><?php echo str_repeat (' ----',$val['depth']); ?><?php if($val['depth']>0){ echo ">"; } ?><?php echo $val['name']; ?></td>
                                                <td class="fc-rtl">
                                                    &nbsp;<?php if(isset($val['net_total'])){ echo number_format($val['net_total']); $grand_total += $val['net_total']; } ?>
                                                </td>
                                            </tr>
                                        <?php 
                                                }
                                            }
                                        }
                                        ?>
                                        <?php for($i=0;$i<$ndiff1;$i++){ ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th class="fc-rtl">&nbsp;<?php echo number_format($grand_total); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                        <div class="col-md-6">
                            <div class="card card-accent-theme">
                                <div class="card-body">
                                    <h4 class="text-theme">Net Income</h4>
                                    <table id="exampleTableSearch" class="display table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Group / Ledger</th>
                                                <th class="fc-rtl">(Cr) Amount</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php
                                        if(isset($list_all2) && is_array($list_all2))
                                        {
                                            $grand_total = 0;
                                            foreach($list_all2 as $val){
                                                if($val['parent_id']<1 || $val['affects_gross']==0)
                                                {
                                        ?>
                                            <tr<?php if(isset($val['ledger'])){ ?> class="text-theme"<?php } ?>>
                                                <td><?php echo str_repeat (' ----',$val['depth']); ?><?php if($val['depth']>0){ echo ">"; } ?><?php echo $val['name']; ?></td>
                                                <td class="fc-rtl">
                                                    &nbsp;<?php if(isset($val['net_total'])){ echo number_format($val['net_total']); $grand_total += $val['net_total']; } ?>
                                                </td>
                                            </tr>
                                        <?php 
                                                }
                                            }
                                        }
                                        ?>
                                        <?php for($i=0;$i<$ndiff2;$i++){ ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th class="fc-rtl">&nbsp;<?php echo number_format($grand_total); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->

                    </div>
                    <!-- end row -->

                </div>
                <!-- end animated fadeIn -->
            </div>
            <!-- end container-fluid -->
        </main>
        <!-- end main -->

        <?= $this->include('common/aside') ?>
        <!-- end aside -->

    </div>
    <!-- end app-body -->
    
    <?= $this->include('common/footer') ?>

    <?= $this->include('common/html_footer') ?>

    <!--Alertify js -->
    <script src="<?php echo base_url("/theme/oct/libs/Alertify/js/alertify.js"); ?>"></script>

    <script>
        $(function () {
            $('.alert-confirm').click(function () {
                var delUrl = $( this ).attr( "data-url" );
                alertify.confirm("This action can't be reversed. Are you sure to delete this entity and associated records?", function () {
                    alertify.logPosition("top right");
                    alertify.success("Deleting the record");
                    window.location.href = delUrl;
                }, function () {
                    alertify.logPosition("top right");
                    alertify.error("Canceled the delete operation");
                });
            });
        });
    </script>
</body>

</html>