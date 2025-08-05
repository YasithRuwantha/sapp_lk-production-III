                                    <?php $tag_index = 1; ?>   
                                    <?php
                                    for($ikey=$_SESSION['ikey']; $ikey< ($_SESSION['ikey']+2); $ikey++)
                                    {
                                    ?>
                                    <div class="row" id="entry-item-<?php echo $ikey; ?>-wrap">
                                        <div class="col-md-3 mb-3">
                                            <?php $field_name = "debit_credit[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Dr/Cr</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2 entity_dr_cr" data-plugin="select2" id="entity_<?php $tag_index+1; echo $ikey; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($opening_balance as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dkey; ?>"<?php if(isset($ival[$field_name]) && $ival[$field_name]==$dkey){ ?> selected<?php } ?>><?php echo $dval; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <?php $field_name = "ledger_id[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Ledger</label>
                                            <select name="<?php echo $field_name; ?>" class="form-control select2 entity_ledger" data-plugin="select2" id="ledger_entity_<?php $tag_index+1; echo $ikey; ?>">
                                                <option value="">--Select--</option>
                                                <?php
                                                foreach($ledgers as $dkey=>$dval)
                                                {
                                                ?>
                                                <option value="<?php echo $dval['id']; ?>"<?php if(isset($ival[$field_name]) && $ival[$field_name]==$dval['id']){ ?> selected<?php } ?>><?php echo $dval['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <?php $field_name = "d_amount[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Dr Amount</label>
                                            <input name="<?php echo $field_name; ?>" value="" type="text" class="form-control entity_dr" id="dr_entity_<?php $tag_index+1; echo $ikey; ?>" placeholder="">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <?php $field_name = "c_amount[" . $ikey . "]"; ?>
                                            <label for="validationCustom<?php echo $tag_index; ?>">Cr Amount</label>
                                            <input name="<?php echo $field_name; ?>" value="" type="text" class="form-control entity_cr" id="cr_entity_<?php $tag_index+1; echo $ikey; ?>" placeholder="">
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
                                    ?>
                                    <?php $_SESSION['ikey'] = $ikey; ?>