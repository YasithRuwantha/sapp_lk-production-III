            <?php if(!isset($active_module)){ $active_module=""; } ?>
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"><span>SAPP</span></li>
							<?php if(is_auth(7)){ ?>
							<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> User Mgt</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/user/add_edit/"); ?>" href="<?php echo base_url("/user/add_edit/"); ?>">Add Users</a></li>
									<li><a class="<?php active_module($active_module,"/user/list_all/"); ?>" href="<?php echo base_url("/user/list_all/"); ?>">List Users</a></li>									
								</ul>
							</li>
							<?php } ?>

							<?php if(is_auth(43)){ ?>
							<li class="submenu">
								<a href="#"><i class="fa fa-desktop"></i><span> HR & A</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/fixed_assert/add_edit/"); ?>" href="<?php echo base_url("/fixed_assert/add_edit/"); ?>">Add Inventory</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/fixed_assert/list_all/"); ?>">List Inventory</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">List PMU Staff</a></li>
									<?php if(is_auth(37)){ ?>	
									<li><a class="<?php active_module($active_module,"/staff_leave/add_edit/"); ?>" href="<?php echo base_url("/staff_leave/add_edit/"); ?>">Schedule Leave</a></li>
									<li><a class="<?php active_module($active_module,"/staff_leave/list_all/"); ?>" href="<?php echo base_url("/staff_leave/list_all/"); ?>">List Leave</a></li>	
									<?php } ?>	
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Performance</a></li>							
								</ul>
							</li>
							<?php } ?>

							<li class="submenu">
								<a href="#"><i class="fa fa-store"></i><span> Procurement</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Add Contract</a></li>	
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">List Contract</a></li>
									<li><a class="<?php active_module($active_module,"/procurement/add_edit/"); ?>" href="<?php echo base_url("/procurement/add_edit/"); ?>">Add Supplier</a></li>
									<li><a class="<?php active_module($active_module,"/procurement/list_all/"); ?>" href="<?php echo base_url("/procurement/list_all/"); ?>">List Supplier</a></li>						
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fa fa-book-open"></i><span> M&E</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/nsc_meeting/add_edit/"); ?>" href="<?php echo base_url("/nsc_meeting/add_edit/"); ?>">Add NSC</a></li>	
									<li><a class="<?php active_module($active_module,"/nsc_meeting/list_all/"); ?>" href="<?php echo base_url("/nsc_meeting/list_all/"); ?>">List NSC</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Add Survey</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">List Survey</a></li>						
									<?php if(is_auth(25)){ ?>
									<li><a class="<?php active_module($active_module,"/training/add_edit/"); ?>" href="<?php echo base_url("/training/add_edit/"); ?>">Schedule Training</a></li>
									<li><a class="<?php active_module($active_module,"/training/list_all/"); ?>" href="<?php echo base_url("/training/list_all/"); ?>">List Training</a></li>
									<?php } ?>
								</ul>
							</li>

							<li class="menu-title"><span>Project Mgt</span></li>

							<li class="submenu">
								<a href="#"><i class="fa fa-truck"></i><span> EOI</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/eoi/add_edit/"); ?>" href="<?php echo base_url("/eoi/add_edit/"); ?>">Add EOI</a></li>
									<li><a class="<?php active_module($active_module,"/eoi/list_all/"); ?>" href="<?php echo base_url("/eoi/list_all/"); ?>">List EOI</a></li>
									<li><a class="<?php active_module($active_module,"/eoi_applicant/add_edit/"); ?>" href="<?php echo base_url("/eoi_applicant/add_edit/"); ?>">Add EOI Applicant</a></li>
									<li><a class="<?php active_module($active_module,"/eoi_applicant/list_all/"); ?>" href="<?php echo base_url("/eoi_applicant/list_all/"); ?>">List EOI Applicant</a></li>
								</ul>
							</li>
							<?php if(is_auth(19)){ ?>
							<li class="submenu">
								<a href="#"><i class="fa fa-bullhorn"></i><span> Promoter</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/promoter/add_edit/"); ?>" href="<?php echo base_url("/promoter/add_edit/"); ?>">Add Promoter</a></li>
									<li><a class="<?php active_module($active_module,"/promoter/list_all/"); ?>" href="<?php echo base_url("/promoter/list_all/"); ?>">List Promoters</a></li>									
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(13)){ ?>
							<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i><span> Projects</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/project/add_edit/"); ?>" href="<?php echo base_url("/project/add_edit/"); ?>">Add Project</a></li>
									<li><a class="<?php active_module($active_module,"/project/list_all/"); ?>" href="<?php echo base_url("/project/list_all/"); ?>">List Projects</a></li>									
									<li><a class="<?php active_module($active_module,"/off_farm_development/add_edit/"); ?>" href="<?php echo base_url("/off_farm_development/add_edit/"); ?>">Add off-farm</a></li>
									<li><a class="<?php active_module($active_module,"/off_farm_development/list_all/"); ?>" href="<?php echo base_url("/off_farm_development/list_all"); ?>">List off-farm</a></li>
								</ul>
							</li>
							<?php } ?>
							<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i><span> IS</span> <span class="menu-arrow"></span></a>
								<ul>								
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Add IS</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">List IS</a></li>
								</ul>
							</li>



							<li class="menu-title"><span>Beneficiary Mgt</span></li>
							<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> Beneficiary</span> <span class="menu-arrow"></span></a>
								<ul>	
								<?php if(is_auth(7)){ ?>
									<li><a class="<?php active_module($active_module,"/user/add_edit/farmer/"); ?>" href="<?php echo base_url("/user/add_edit?user_type=2"); ?>">Add Beneficiary</a></li>
								<?php } ?>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Bulk Upload</a></li>
								<?php if(is_auth(7)){ ?>
									<li><a class="<?php active_module($active_module,"/user/farmer_project/"); ?>" href="<?php echo base_url("/user/farmer_project?user_type=2"); ?>">List Beneficiary</a></li>
								<?php } ?>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="fa fa-coins"></i><span> Loan</span> <span class="menu-arrow"></span></a>
								<ul>	
									<li><a class="<?php active_module($active_module,"/loan/add_edit/"); ?>" href="<?php echo base_url("/loan/add_edit/"); ?>">Add Loan Scheme</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Bulk Assign </a></li>
									<li><a class="<?php active_module($active_module,"/loan/list_all/"); ?>" href="<?php echo base_url("/loan/list_all/"); ?>">List Loan Scheme</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="fa fa-money-bill"></i><span> Grant</span> <span class="menu-arrow"></span></a>
								<ul>	
									<li><a class="<?php active_module($active_module,"/grant/add_edit/"); ?>" href="<?php echo base_url("/grant/add_edit/"); ?>">Add Grant  Scheme</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Bulk Assign </a></li>
									<li><a class="<?php active_module($active_module,"/grant/list_all/"); ?>" href="<?php echo base_url("/grant/list_all/"); ?>">List Grant  Scheme</a></li>
								</ul>
							</li>




							<li class="menu-title"><span>DASHBOARD</span></li>
							<li class="submenu">
								<a href="#"><i class="fa fa-chart-pie"></i><span> Dashboard</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/dashboard/training_summary/"); ?>" href="<?php echo base_url("/dashboard/farmer_summary/"); ?>">Beneficiary  </a></li>
								<?php if(is_auth(7)){ ?>
									<li><a class="<?php active_module($active_module,"/dashboard/users/"); ?>" href="<?php echo base_url("/dashboard/users/"); ?>">User</a></li>
								<?php } ?>
								<?php if(is_auth(25)){ ?>
									<li><a class="<?php active_module($active_module,"/dashboard/training_summary/"); ?>" href="<?php echo base_url("/dashboard/training_summary/"); ?>">Training </a></li>
								<?php } ?>
								<?php if(is_auth(19)){ ?>
									<li><a class="<?php active_module($active_module,"/dashboard/promoter_summary/"); ?>" href="<?php echo base_url("/dashboard/promoter_summary/"); ?>">Promoter</a></li>
								<?php } ?>
								<?php if(is_auth(13)){ ?>
									<li><a class="<?php active_module($active_module,"/dashboard/project_location/"); ?>" href="<?php echo base_url("/dashboard/project_location/"); ?>">Project</a></li>
								<?php } ?>
								</ul>
							</li>




							<li class="menu-title"><span>REPORTS</span></li>
							<li class="submenu">
								<a href="#"><i class="fa fa-signal"></i><span> Monthly Report</span> <span class="menu-arrow"></span></a>
								<ul>	
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Add Monthly Report</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">List Monthly Report</a></li>
								</ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="fa fa-signal"></i><span> Annual Report</span> <span class="menu-arrow"></span></a>
								<ul>	
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">Add Annual Report</a></li>
									<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/dashboard/underconstruction/"); ?>">List Annual Report</a></li>
								</ul>
							</li>

						</ul>
					</div>
				</div>
			</div>