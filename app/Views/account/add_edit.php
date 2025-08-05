<?php
$form_url = base_url("/account/add_edit/" . $id);
$lock_url = base_url("/account/add_edit/" . $id . "/1");
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
                                <h3 class="text-theme">Account</h3>
                                <p>Account will group the transactions based on financial year and group.</p>
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
                                    <strong>Account</strong>
                                    Detail
                                </div>    
                                <div class="card-body">
                                    <?php $tag_index = 1; ?>                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "label"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Account label</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="Account label">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "currency_symbol"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Currency symbol</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="Rs.">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "fy_start"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Financial year start</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="fy_start form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="<?php echo date('Y') . "-04-01"; ?>">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "fy_end"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Financial year end</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="fy_end form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="<?php echo (date('Y')+1) . "-03-31"; ?>">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "date_format"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Date format</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" data-plugin="select2" id="validationCustom<?php echo $tag_index+1; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($date_formats as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dkey; ?>"<?php if(isset($details[$field_name]) && $details[$field_name]==$dkey){ ?> selected<?php } ?>><?php echo $dval; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "status"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Status</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" data-plugin="select2" id="validationCustom<?php echo $tag_index+1; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($account_status as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dkey; ?>"<?php if(isset($details[$field_name]) && $details[$field_name]==$dkey){ ?> selected<?php } ?>><?php echo $dval; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="text-theme">Grant access</h6>
                                    <small>Select the users whom you want to manage this account</small>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "users[]"; ?>
                                            <?php $wp_users = json_decode(json_encode(get_users()),TRUE); ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Users</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" data-plugin="select2" multiple>
                                                <?php
                                                foreach($wp_users as $ukey=>$uval)
                                                {
                                                ?>
                                                <option value="<?php echo $uval['ID']; ?>"<?php if(isset($details1[$field_name]) && in_array($uval['ID'],$details1[$field_name])){ ?> selected<?php } ?>><?php echo $uval['data']['display_name']; ?></option>
                                                <?php } ?>
                                            </select>
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
            $('.fy_start').datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(e){
                $(this).datepicker('hide');
            });
            $('.fy_end').datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(e){
                $(this).datepicker('hide');
            });

            $(".fy_start, .fy_end").keydown(function(event) { 
                return false;
            });

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