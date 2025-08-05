                    <div id="filter_inputs" class="card filter-card"<?php if(isset($_GET) && count($_GET) < 1){ ?> style="display: block;"<?php } ?>>
						<div class="card-body pb-0">
							<div class="row">
                                <?php 
                                    if(isset($filters) && is_array($filters)){
                                        foreach($filters as $fval){
                                ?>

                                <?php if($fval['type']=="text"){ ?>
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<label><?php echo $fval['label']; ?></label>
										<input name="<?php echo $fval['field']; ?>" value="<?php if(isset($_GET[$fval['field']])){ echo $_GET[$fval['field']]; } ?>" type="text" class="<?php echo $fval['field']; ?> form-control">
									</div>
								</div>
                                <?php  } ?>
                                <?php if($fval['type']=="select"){ ?>
                                <div class="col-sm-6 col-md-3">
								    <div class="form-group">
										<label><?php echo $fval['label']; ?></label>
										<select class="search-select <?php echo $fval['field']; ?> form-select" name="<?php echo $fval['field']; ?>">
											<option value="">-- Select --</option>
                                            <?php foreach($fval['options'] as $fokey=>$foval){ ?>
                                                <option value="<?php echo $fokey; ?>" <?php if(isset($_GET[$fval['field']]) && $_GET[$fval['field']]==$fokey){ echo "selected"; } ?>><?php echo $foval; ?></option>
                                            <?php } ?>
										</select>
									</div>
								</div>
                                <?php } ?>
								<?php if($fval['type']=="select_dynamic"){ ?>
                                <div class="col-sm-6 col-md-3">
								    <div class="form-group">
										<label><?php echo $fval['label']; ?></label>
										<select class="search-select <?php echo $fval['field']; ?> form-select" name="<?php echo $fval['field']; ?>">
											<option value="">-- Select --</option>
                                            <?php foreach(sql_fetch($fval['options']) as $fokey=>$foval){ ?>
                                                <option value="<?php echo $foval['val']; ?>" <?php if(isset($_GET[$fval['field']]) && $_GET[$fval['field']]==$foval['val']){ echo "selected"; } ?>><?php echo $foval['label']; ?></option>
                                            <?php } ?>
										</select>
									</div>
								</div>
                                <?php } ?>
								<?php if($fval['type']=="date"){ ?>
                                <div class="col-sm-6 col-md-3">
								    <div class="form-group">
									<label><?php echo $fval['label']; ?></label>
										<input name="<?php echo $fval['field']; ?>" value="<?php if(isset($_GET[$fval['field']])){ echo $_GET[$fval['field']]; } ?>" type="text" class="datepicker <?php echo $fval['field']; ?> form-control">
									</div>
								</div>
                                <?php } ?>
                                <?php }} ?>
							</div>
                            <div class="row">								
								<div class="col-sm-6 col-md-3">
									<div class="form-group">
										<input type="reset" onclick="location.href = '<?php if(isset($filter) && isset($query)){ echo base_url("/reports/dynamic/" . $filter . "/" . $query . "/"); } ?>';" value="Reset" class="reset-btn btn btn-primary">
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>
