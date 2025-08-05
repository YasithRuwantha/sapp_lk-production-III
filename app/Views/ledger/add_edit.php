<?php
$form_url = base_url("/ledger/add_edit/" . $id);
$lock_url = base_url("/ledger/add_edit/" . $id . "/1");
?><!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('common/html_head') ?>

    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/fonts/md-fonts/css/materialdesignicons.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/fonts/font-awesome-4.7.0/css/font-awesome.min.css"); ?>">
    <!-- animate css -->
    <link rel="stylesheet" href="<?php echo base_url("/theme/oct/libs/animate.css/animate.min.css"); ?>">

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

                    <div class="col-md-12">
                        <div class="clearfix">
                            <div class="float-left">
                                <h3 class="text-theme">Ledger</h3>
                                <p>A ledger is a collection of accounts in which account transactions are recorded.</p>
                            </div>
                            <!-- float-left -->
                            <?php if(!$entity_lock['is_locked'] && $id>0){ ?>
                            <div class="float-right">
                                <a href="<?php echo $lock_url; ?>" class="btn btn-danger btn-round">
                                    <i class="mdi mdi-lock-open"></i> UNLOCK</a>
                            </div>
                            <?php } ?>  
                        </div>
                        <?php if(!$entity_lock['is_locked']){ ?>
                        <form method="post" action="<?php echo $form_url; ?>" enctype="multipart/form-data" id="needs-validation" novalidate>
                        <?php } ?>    
                            <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">
                            <div class="card card-accent-theme">
                                <div class="card-header text-theme">
                                    <strong>Ledger</strong>
                                    Detail
                                </div>
                                <div class="card-body">
                                    <?php $tag_index = 1; ?>                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "name"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Ledger label</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="Ledger label">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "code"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Ledger code</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="Ledger code">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "opening_balance"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Opening balance</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="0.00">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "opening_balance_debit_credit"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Opening balance (credit / debit)</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" data-plugin="select2" id="validationCustom<?php echo $tag_index+1; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($opening_balance as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dkey; ?>"<?php if(isset($details[$field_name]) && $details[$field_name]==$dkey){ ?> selected<?php } ?>><?php echo $dval; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block">Asserts or expenses always have Dr balance. Liabilities or income always have Cr balance.</span>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "group_id"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Group</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" data-plugin="select2" id="validationCustom<?php echo $tag_index+1; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($list_all as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dval['id']; ?>"<?php if(isset($details[$field_name]) && $details[$field_name]==$dval['id']){ ?> selected<?php } ?>><?php echo str_repeat (' ----',$dval['depth']); ?><?php if($dval['depth']>0){ echo ">"; } ?><?php echo $dval['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "notes"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Remarks</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="Remarks">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>                                
                                <!-- end card-body -->
                                <div class="card-footer">
                                    <?php if(!$entity_lock['is_locked']){ ?>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                                        <button type="reset" class="btn btn-sm btn-danger">
                                            <i class="fa fa-ban"></i> Reset</button>
                                    <?php }else{ ?>
                                        <a href="" class="btn btn-secondary btn-round">
                                            <i class="mdi mdi-refresh"></i> REFRESH</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- end card -->
                        <?php if(!$entity_lock['is_locked']){ ?>
                        </form> 
                        <?php } ?>                           
                    </div>                        
                    <!-- end col -->
                </div>
                <!-- end animated fadeIn -->
            </div>
            <br>
            <!-- end container-fluid -->
        </main>
        <!-- end main -->
        
            <?= $this->include('common/aside') ?>
            <!-- end aside -->
    
        </div>
        <!-- end app-body -->
        
    <?= $this->include('common/footer') ?>

    <?= $this->include('common/html_footer') ?>
    
    <!-- bootstrap form validation -->
    <script src="<?php echo base_url("/theme/oct/js/bootstrap-form-validation.js"); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url("/theme/oct/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"); ?>"></script>
    <!--select 2 -->
    <script src="<?php echo base_url("/theme/oct/libs/select2/dist/js/select2.min.js"); ?>"></script>

    <!--Alertify js -->
    <script src="<?php echo base_url("/theme/oct/libs/Alertify/js/alertify.js"); ?>"></script>

    <script>
        $(function () {

            $('.select2').select2({});

            <?php if($id > 0 && !$entity_lock['is_locked']){ ?>
            setInterval(function(){ 
                alertify.confirm("This entity locked for long time. Do you want to extend the locked time? This will block others from editing this entity.", function () {
                    alertify.logPosition("top right");                    
                    alertify.error("Extending the locked duration. It will block others from editing this record.");
                    window.location.href = "<?php echo $form_url; ?>";
                }, function () {
                    alertify.logPosition("top right");
                    alertify.success("Lock released on this record.");
                    window.location.href = "<?php echo $lock_url; ?>";
                });
            }, <?php echo get_config(3)-60; ?>000);
            setTimeout(function(){ 
                window.location.href = "<?php echo $lock_url; ?>";
             }, <?php echo get_config(3); ?>000);
            <?php } ?>
        });
    </script>
</body>

</html>