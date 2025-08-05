<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('common/html_head') ?>

    <!-- Select2 CSS -->
    <link rel="stylesheet"
          href="<?php

    use function PHPUnit\Framework\isEmpty;

 echo base_url("/public/theme/html-files/template/assets/plugins/select2/css/select2.min.css"); ?>">

    <!-- Datepicker CSS -->
    <link rel="stylesheet"
          href="<?php echo base_url("/public/theme/html-files/template/assets/css/bootstrap-datetimepicker.min.css"); ?>">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
    <?= $this->include('common/header') ?>
    <!-- /Header -->

    <!-- Sidebar -->
    <?= $this->include('common/left_bar') ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Grant Disbursement</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url("/dashboard/default/"); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url("/grant/list_all/"); ?>">Grant Claim Group</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="<?php echo base_url("/grant_disbursement/group_list_all/" . $entity_id); ?>">Grant
                                    Disbursement</a></li>
                            <li class="breadcrumb-item active">Grant Disbursement Details</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="<?php echo base_url('grant_disbursement/generate_template/' . $entity_id) ?>">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Template</button>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="<?php echo base_url('grant_disbursement/resource_generate/' . $entity_id) ?>">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-download"></i> Resource</button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Grant Disbursement Details</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $inc = 1;
                            ?>
                            <form name="form-grant-disbursement-details" method="post"
                                  action="<?php echo base_url("/grant_disbursement/group_add_edit/" . $entity_id . "/" . $id); ?>"
                                  enctype="multipart/form-data">
                                <input name="csrf" value="<?php echo $csrf; ?>" type="hidden">

                                <div class="row form-group">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Farmer
                                        Category</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "farmer_category"; ?>
                                        <select class="search-select farm-cat form-select<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                                id="field-label-<?php echo $inc++; ?>"
                                                name="<?php echo $field_name; ?>">
                                            <?php if (!isset($record[$field_name])) { ?>
                                                <option value="">-- Select --</option>
                                            <?php } ?>
                                            <?php foreach ($farmer_category as $key => $val) { ?>
                                                <option class="entity"
                                                        <?php if (isset($record[$field_name]) && $val['id'] == $record[$field_name]){ ?>selected<?php } ?>
                                                        value="<?php echo $val['id']; ?>"><?php echo $val['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Farmer</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "farmer_id"; ?>
                                        <select onchange="calculate()" multiple
                                                class="search-select farmer-multiselect form-select<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                                id="field-label-farmers" name="<?php echo $field_name; ?>[]">
                                            <?php
                                            if (isset($farmer_list) && is_array($farmer_list)) {
                                                foreach ($farmer_list as $key => $val) {
                                                    ?>
                                                    <option class="entity options-farmers"
                                                            <?php if (isset($selected_farmers) && in_array($val['id'], $selected_farmers)){ ?>selected<?php } ?>
                                                            value="<?php echo $val['id']; ?>"><?php echo $val['farmer']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Item</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "project_target_item_id"; ?>
                                        <select class="search-select item-select form-select<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                                id="field-label-item"
                                                name="<?php echo $field_name; ?>[]">
                                            <?php if (!isset($record[$field_name])) { ?>
                                                <option value="">-- Select --</option>
                                            <?php } ?>
                                            <?php foreach ($item_list as $key => $val) { ?>
                                                <option class="entity"
                                                        <?php if (isset($selected_items) && in_array($val['id'], $selected_items)){ ?>selected<?php } ?>
                                                        value="<?php echo $val['id']; ?>"><?php echo $val['item_description']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Price as per project target</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "price_as_per_project_target"; ?>
                                        <input disabled  type="number" step="any" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php echo $price_as_per_project_target; ?>">
                                            
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Actual price as per unit</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "actual_price_per_unit"; ?>
                                        <input onkeyup="calculate()" type="number" step="any" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php echo $selected_items_actual_price; ?>">
                                            
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Per
                                        Farmer QTY</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "qty"; ?>
                                        <input max="???" min="???" type="number" step="any" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $field_name; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($item_record[$field_name])) {
                                                   echo $item_record[$field_name];
                                               } ?>" onkeyup="calculate()">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Total
                                        Amount</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "total-amount"; ?>
                                        <input disabled onload="calculate()" type="number" step="0.01" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($item_record[$field_name])) {
                                                   echo $item_record[$field_name];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!--
                                        <div class="form-group row">
                                            <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Price (LKR)</label>
											<div class="col-sm-10">
                                                <?php $field_name = "price"; ?>
												<input type="number" step="0.01" placeholder="" class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>" id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>" value="<?php if (isset($item_record[$field_name])) {
                                    echo $item_record[$field_name];
                                } ?>">
                                                <?php if ($validation->hasError($field_name)) { ?>
                                                <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                                <?php } ?>
                                            </div>
										</div>
												-->
                                <div class="form-group row">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Date of
                                        grant</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "date_of_grant"; ?>
                                        <input type="text" placeholder=""
                                               class="datepicker form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($record[$field_name])) {
                                                   echo $record[$field_name];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Status</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "disbursement_status"; ?>
                                        <select class="search-select form-select<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?> entity-type"
                                                id="field-label-status" name="<?php echo $field_name; ?>">
                                            <?php if (!isset($record[$field_name])) { ?>
                                                <option disabled value="">-- Select --</option>
                                            <?php } ?>
                                            <?php foreach ($disbursement_status as $key => $val) { ?>
                                                <option
                                                    <?php if (isset($record[$field_name]) && $key == $record[$field_name]){ ?>selected<?php } ?>
                                                    value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Remarks</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "remarks"; ?>
                                        <input type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($record[$field_name])) {
                                                   echo $record[$field_name];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row" id="schedule-by-field" style="display:none;">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Schedule By</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "schedule_by"; ?>
                                        <input readonly type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($user['fname'])) {
                                                   echo $user['fname'] . ' ' . $user['lname'];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="
                                               invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>


                                <div class="form-group row" id="schedule-on-field" style="display:none;">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Schedule On</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "schedule_on"; ?>
                                        <input readonly type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($record[$field_name])) {
                                                   echo $record[$field_name];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row" id="disbursed-by-field" style="display:none;">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Disbursed By</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "disbursed_by"; ?>
                                        <input readonly type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($user['fname'])) {
                                                   echo $user['fname'] . ' ' . $user['lname'];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row" id="hold-by-field" style="display:none;">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Hold By</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "hold_by"; ?>
                                        <input readonly type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($user['fname'])) {
                                                   echo $user['fname'] . ' ' . $user['lname'];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group row" id="hold-on-field" style="display:none;">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Hold On</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "hold_on"; ?>
                                        <input readonly type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($record[$field_name])) {
                                                   echo $record[$field_name];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group row" id="hold-reason-field" style="display:none;">
                                    <label for="field-label-<?php echo $inc; ?>"
                                           class="col-form-label col-md-2">Reason for Holding</label>
                                    <div class="col-sm-10">
                                        <?php $field_name = "hold_reason"; ?>
                                        <input type="text" placeholder=""
                                               class="form-control<?php if ($validation->hasError($field_name)) { ?> is-invalid<?php } ?>"
                                               id="field-label-<?php echo $inc++; ?>" name="<?php echo $field_name; ?>"
                                               value="<?php if (isset($record[$field_name])) {
                                                   echo $record[$field_name];
                                               } ?>">
                                        <?php if ($validation->hasError($field_name)) { ?>
                                            <div class="invalid-feedback"><?php echo $validation->getError($field_name); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>

                            <br>
                            <!--Bulk Upload Option-->
                            <form action="<?php echo base_url('grant_disbursement/bulk_upload/'. $entity_id) ?>" method="POST"
                                  enctype="multipart/form-data">
                                <div class="form-group ">
                                    <label for="field-label-<?php echo $inc; ?>" class="col-form-label col-md-2">Bulk
                                        upload</label>
                                    <input type="file" name="excel_file" accept=".xlsx, .xls" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/jquery-3.6.0.min.js"); ?>"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/bootstrap.bundle.min.js"); ?>"></script>

<!-- Feather Icon JS -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/feather.min.js"); ?>"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/slimscroll/jquery.slimscroll.min.js"); ?>"></script>

<!-- Custom JS -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/js/script.js"); ?>"></script>

<script src="//code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<!-- Select 2 -->
<script src="<?php echo base_url("/public/theme/html-files/template/assets/plugins/select2/js/select2.min.js"); ?>"></script>

<script>
    $(function () {
        <?php $field_name = "date_of_grant"; ?>
        $(".datepicker").datepicker({minDate: "-100Y", maxDate: "+5Y", changeMonth: true, changeYear: true});
        $(".datepicker").datepicker("option", "dateFormat", "yy-mm-dd");
        setTimeout($(".datepicker").val("<?php if (isset($record[$field_name])) {
            echo $record[$field_name];
        } ?>"), 200);

        $('.farm-cat').on('change', function () {
            $.post("<?php echo base_url("grant_disbursement/get_farmer_list/" . $entity_id . "/"); ?>" + "/" + $(this).find(":selected").val(), {entity: "<?php echo $entity_id; ?>"})
                .done(function (resData) {
                    $('.farmer-multiselect').html(resData);
                });

            $.post("<?php echo base_url("grant_disbursement/get_item_list/" . $entity_id . "/"); ?>" + "/" + $(this).find(":selected").val(), {entity: "<?php echo $entity_id; ?>"})
                .done(function (resData) {
                    $('.item-select').html(resData);
                });
            
            // $.post("<?php echo base_url("grant_disbursement/get_maximum_no_of_grant_item/" . $entity_id . "/"); ?>" + "/" + $(this).find(":selected").val(), {entity: "<?php echo $entity_id; ?>"})
            //     .done(function (resData){
            //         // Set maximum grant item to the input field
            //         $("#field-label-qty").attr({
            //         "max" : resData,        // max value
            //         "min" : 0          // min value
            //         }); 
            //     });
        });

        $('#field-label-item').on('change', function () {
            $.post("<?php echo base_url("grant_disbursement/get_maximum_no_of_grant_item/" . $entity_id . "/"); ?>" + "/" + $(this).find(":selected").val(), {entity: "<?php echo $entity_id; ?>"})
                .done(function (resData){
                    // Set maximum grant item to the input field
                    $("#field-label-qty").attr({
                    "max" : resData,        // max value
                    "min" : 0          // min value
                    }); 
                });
        });

        $(".search-select").select2();

    });
</script>

<script>
    $(document).ready(function () {
        // console.log(window.location.href.slice(window.location.href.indexOf('?') + 1));
        QueryString = (new URL(location.href)).searchParams.get('mode');

        if(QueryString){
            $('.btn').hide();
            $('.form-control').attr("disabled", "disabled");
			$('.form-control').removeAttr("placeholder");
			$('.form-select').attr("disabled", "disabled");
        }


        $.post("<?php echo base_url("grant_disbursement/get_maximum_no_of_grant_item/" . $entity_id . "/"); ?>" + "/" + $('#field-label-item').find(":selected").val(), {entity: "<?php echo $entity_id; ?>"})
            .done(function (resData){
                    // Set maximum grant item to the input field
                    $("#field-label-qty").attr({
                    "max" : resData,        // max value
                    "min" : 0          // min value
                    }); 
                });

        // on load
        if ($('#field-label-status').val() === '1') {
            $('#schedule-by-field, #schedule-on-field, #disbursed-by-field, #hold-by-field, #hold-on-field, #hold-reason-field').hide();
        } else if ($('#field-label-status').val() === '2') {
            $('#schedule-by-field, #schedule-on-field').show();
        } else if ($('#field-label-status').val() === '3') {
            $('#disbursed-by-field').show();
        } else {
            $('#hold-by-field, #hold-on-field, #hold-reason-field').show();
        }

        // on load status dropdown access
        <?php if(is_group(32)){?>
        console.log("VCM");
        $('#field-label-status option[value="3"], #field-label-status option[value="4"]').prop('disabled', true);
        <?php }elseif (is_group(33)){?>
        console.log("RPC");
        $('#field-label-status option[value="3"], #field-label-status option[value="4"]').prop('disabled', true);
        <?php }elseif (is_group(36)){?>
        console.log("Officer");
        $('#field-label-status option[value="1"], #field-label-status option[value="2"]').prop('disabled', true);
        <?php }else{?>
        console.log("else");
        $('#field-label-status option[value="1"], #field-label-status option[value="2"], #field-label-status option[value="3"], #field-label-status option[value="4"]').prop('disabled', true);
        <?php }?>

        <?php if (is_group(2)){?>
        console.log("admin");
        $('#field-label-status option[value="3"], #field-label-status option[value="4"]').removeAttr('disabled');
        <?php }?>

        // cal default values to the Total amount field
        calculate()

        // when change status
        $('#field-label-status').change(function () {
            if ($(this).val() === '1') {
                $('#schedule-by-field, #schedule-on-field, #disbursed-by-field, #hold-by-field, #hold-on-field, #hold-reason-field').hide();
            } else if ($(this).val() === '2') {
                $('#disbursed-by-field, #hold-by-field, #hold-on-field, #hold-reason-field').hide();
                // $('#schedule-by-field, #schedule-on-field').show();
                // $('#schedule-by-field, #schedule-on-field').show();
                // farmer-multiselect class convert to readonly field
                // $('.farmer-multiselect').attr('readonly', true);
            } else if ($(this).val() === '3') {
                $('#schedule-by-field, #schedule-on-field, #hold-by-field, #hold-on-field, #hold-reason-field').hide();
                // $('#disbursed-by-field').show();
            } else {
                $('#schedule-by-field, #schedule-on-field, #disbursed-by-field').hide();
                // $('#hold-by-field, #hold-on-field, #hold-reason-field').show();
                $('#hold-reason-field').show();
            }
        });

        // set values to the actual unit price when changing item in the dropdown list
        $("#field-label-item").on("change", function () {
            var selectedOption = $(this).find(":selected");
            var selVal = selectedOption.val();

            <?php foreach ($item_list as $key => $val){?>
            if (<?php echo $val['id'] ?> == selVal
        )
            {
                $('input[name="price_as_per_project_target"]').val(<?php echo $val['amount']?>);
            }
            <?php }?>
        });
    })
</script>

<script type="text/javascript">
    function calculate() {
        if (isNaN(document.forms["form-grant-disbursement-details"]["actual_price_per_unit"].value) || document.forms["form-grant-disbursement-details"]["actual_price_per_unit"].value == "") {
            var actual_price_unit = 0;
        } else {
            var actual_price_unit = parseFloat(document.forms["form-grant-disbursement-details"]["actual_price_per_unit"].value);
        }
        if (!isNumeric(document.forms["form-grant-disbursement-details"]["qty"].value) || document.forms["form-grant-disbursement-details"]["qty"].value == "") {
            var per_farmer_qty = 0;
        } else {
            var per_farmer_qty = parseFloat(document.forms["form-grant-disbursement-details"]["qty"].value);
        }

        var no_of_farmers = $('#field-label-farmers option:selected').length;
        document.forms["form-grant-disbursement-details"]["total-amount"].value = (no_of_farmers * per_farmer_qty * actual_price_unit).toFixed(2);
    }

    function isNumeric(value) { 
      return /^-?\d+(\.\d+)?$/.test(value); 
    } 
</script>

</body>
</html>