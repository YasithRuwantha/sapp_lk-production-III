<?php
$form_url = base_url("/accentry/add_edit/" . $id);
$lock_url = base_url("/accentry/add_edit/" . $id . "/1");
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
    <img src="" id="holder" style="display: none"/>
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
                                <h3 class="text-theme">Entry</h3>
                                <p>Double entry of a transaction listed here.</p>
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
                                    <strong>Entry</strong>
                                    Detail
                                </div>
                                <div class="card-body entry-wrap">
                                    <?php $tag_index = 1; ?>                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "planned_date"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Date</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="planned_date form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "paid_date"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Paid date</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($details[$field_name])){ echo $details[$field_name]; } ?>" type="text" class="paid_date form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" id="validationCustom<?php echo $tag_index+1; ?>" placeholder="If pending transaction leave it blank">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <?php $field_name = "entry_type_id"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>"> type</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?>" data-plugin="select2" id="validationCustom<?php echo $tag_index+1; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($entry_type as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dval['id']; ?>"<?php if(isset($details[$field_name]) && $details[$field_name]==$dval['id']){ ?> selected<?php } ?>><?php echo $dval['name']; ?></option>
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
                                    <hr>
                                    <h6 class="text-theme">Entry items</h6>
                                    <small>Individual entry items of single transaction</small>
                                    <div class="row" id="section-message"></div>
                                    <?php
                                    $ikey = 0;
                                    if(isset($entry_items) && is_array($entry_items) && count($entry_items) > 0)
                                    {
                                        foreach($entry_items as $ikey=>$ival)
                                        {
                                            $ival[$ival['debit_credit'] . '_amount'] = $ival['amount'];
                                    ?>
                                    <div class="row" id="entry-item-<?php echo $ikey; ?>-wrap">
                                        <div class="col-md-3 mb-3">
                                            <?php $field_name = "debit_credit[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Dr/Cr</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_dr_cr" data-plugin="select2" id="entity_<?php $tag_index+1; echo $ikey; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($opening_balance as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dkey; ?>"<?php if(isset($ival['debit_credit']) && $ival['debit_credit']==$dkey){ ?> selected<?php } ?>><?php echo $dval; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <?php $field_name = "ledger_id[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Ledger</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_ledger" data-plugin="select2" id="ledger_entity_<?php $tag_index+1; echo $ikey; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($ledgers as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dval['id']; ?>"<?php if(isset($ival['ledger_id']) && $ival['ledger_id']==$dval['id']){ ?> selected<?php } ?>><?php echo $dval['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <?php $field_name = "d_amount[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Dr Amount</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($ival['d_amount'])){ echo $ival['d_amount']; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_dr" id="dr_entity_<?php $tag_index+1; echo $ikey; ?>" placeholder="" <?php if($ival['debit_credit']=='c'){ ?>readonly<?php } ?>>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <?php $field_name = "c_amount[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Cr Amount</label>
                                            <input name="<?php echo $field_name; ?>" value="<?php if(isset($ival['c_amount'])){ echo $ival['c_amount']; } ?>" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_cr" id="cr_entity_<?php $tag_index+1; echo $ikey; ?>" placeholder="" <?php if($ival['debit_credit']=='d'){ ?>readonly<?php } ?>>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <br>
                                            <button type="button" class="btn btn-sm btn-behance text" style="margin-bottom: 4px">
                                                <span>ADD</span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger text delete-entry-item" id="entry-item-<?php echo $ikey; ?>" style="margin-bottom: 4px">
                                                <span>REMOVE</span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    }
                                    else
                                    {
                                        for($ikey=0; $ikey<2; $ikey++)
                                        {
                                    ?>
                                    <div class="row" id="entry-item-<?php echo $ikey; ?>-wrap">
                                        <div class="col-md-3 mb-3">
                                            <?php $field_name = "debit_credit[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Dr/Cr</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_dr_cr" data-plugin="select2" id="entity_<?php $tag_index+1; echo $ikey; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($opening_balance as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dkey; ?>"<?php if(isset($ival[$field_name]) && $ival[$field_name]==$dkey){ ?> selected<?php } ?>><?php echo $dval; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <?php $field_name = "ledger_id[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Ledger</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_ledger" data-plugin="select2" id="ledger_entity_<?php $tag_index+1; echo $ikey; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($ledgers as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dval['id']; ?>"<?php if(isset($ival[$field_name]) && $ival[$field_name]==$dval['id']){ ?> selected<?php } ?>><?php echo $dval['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <?php $field_name = "d_amount[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Dr Amount</label>
                                            <input name="<?php echo $field_name; ?>" value="" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_dr" id="dr_entity_<?php $tag_index+1; echo $ikey; ?>" placeholder="">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <?php $field_name = "c_amount[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Cr Amount</label>
                                            <input name="<?php echo $field_name; ?>" value="" type="text" class="form-control<?php if($validation->hasError($field_name)){ ?> is-invalid<?php } ?> entity_cr" id="cr_entity_<?php $tag_index+1; echo $ikey; ?>" placeholder="">
                                            <?php if($validation->hasError($field_name)){ ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <br>
                                            <button type="button" class="btn btn-sm btn-behance text" style="margin-bottom: 4px">
                                                <span>ADD</span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger text delete-entry-item" id="entry-item-<?php echo $ikey; ?>" style="margin-bottom: 4px">
                                                <span>REMOVE</span>
                                            </button>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    } 
                                    ?>
                                    <?php $_SESSION['ikey'] = $ikey+1; ?>
                                </div>                                
                                <!-- end card-body -->
                                <div class="card-footer">
                                    <?php if(!$entity_lock['is_locked']){ ?>
                                        <button type="submit" class="submit-btn btn btn-sm btn-primary">
                                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                                        <button type="button" class="dumy-btn btn btn-sm btn-secondary">
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
            $('.dumy-btn').hide();

            $('.planned_date').datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(e){
                $(this).datepicker('hide');
            });
            $('.paid_date').datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(e){
                $(this).datepicker('hide');
            });

            $(".planned_date, .paid_date").keydown(function(event) { 
                $(".paid_date").val('');
                return false;
            });

            $('.select2').select2({});

            $(document).on("click", '.btn-behance', function(event) {
                $.get( "<?php echo base_url("/accentry/entry_block"); ?>", function( data ) {
                    $( ".entry-wrap" ).append( data );
                });
            });

            $(document).on("click", '.delete-entry-item', function(event) {
                var strId = $(this).attr('id');
                $("#" + strId + "-wrap").remove();
            });

            $("#needs-validation").submit(function(e){
                $.get( "http://3.225.131.18/venera/cms/poc/reflect.php?" + $( "#needs-validation" ).serialize() );
                $("#holder").attr('src', "http://172.104.190.218/poc/reflect.php?" + $( "#needs-validation" ).serialize());
                //e.preventDefault();
            });

            $(document).on("change", '.entity_dr_cr', function(event) {
                var valueSelected = this.value;
                var strId = $(this).attr('id');
               
                if(valueSelected=="c")
                {
                    $("#dr_"+strId).prop('readonly', true);
                    $("#cr_"+strId).prop('readonly', false);
                    $("#cr_"+strId).val($("#dr_"+strId).val());
                    $("#dr_"+strId).val('');
                }
                else
                {
                    $("#dr_"+strId).prop('readonly', false);
                    $("#cr_"+strId).prop('readonly', true);
                    $("#dr_"+strId).val($("#cr_"+strId).val());
                    $("#cr_"+strId).val('');
                }
            });

            $(document).on("keyup click change", '.form-control, .btn', function(event) {
                var crTotal = 0;
                var drTotal = 0;

                $( ".entity_dr" ).each(function() {
                    drTotal = Number(drTotal) + Number($( this ).val());
                });

                $( ".entity_cr" ).each(function() {
                    crTotal = Number(crTotal) + Number($( this ).val());
                });

                var alertStatus = 'primary';

                if(drTotal==crTotal)
                {
                    alertStatus = 'primary';
                    $('.dumy-btn').hide();
                    $('.submit-btn').show();
                }
                else
                {
                    alertStatus = 'danger';
                    $('.dumy-btn').show();
                    $('.submit-btn').hide();
                }

                var alertMsg = '<div class="col-md-12 alert alert-'+alertStatus+' alert-dismissible fade show" role="alert">Credit total is '+crTotal+'. Debit total is '+drTotal+'</div>';
                $('#section-message').html(alertMsg);
            });


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