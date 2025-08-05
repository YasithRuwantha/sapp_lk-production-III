			<?php $abbreviations = json_decode(get_config(76),TRUE); ?>
			<?php if(!isset($active_module)){ $active_module=""; } ?>
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu dark">
						<ul>
						<?php if(isset($_SESSION['user']['fname'])){ ?>
							<li class="menu-title"><span>SUMMARY</span></li>
							<?php if(is_auth(1)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">dashboard</span><span> Home</span> <span class="menu-arrow"></span></a>
								<?php if(is_auth(1)){ ?>
								<ul>
									<li><a class="<?php active_module($active_module,"/dashboard/default/"); ?>" href="<?php echo base_url("/dashboard/default/"); ?>">Overview</a></li>
									<li><a class="<?php active_module($active_module,"/dashboard/project/"); ?>" href="<?php echo base_url("/dashboard/project/"); ?>">Detailed</a></li>
								</ul>
								<?php } ?>
							</li>
							<?php } ?>
							<?php if(is_auth(49)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">data_exploration</span><span> Reports</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/102/76/"); ?>" href="<?php echo base_url("/reports/dynamic/102/76"); ?>">Short Farmer Profile</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/75/52/"); ?>" href="<?php echo base_url("/reports/dynamic/75/52"); ?>">Beneficiary Details</a></li>
									<li><a class="<?php active_module($active_module,"/reports/report_non_eligible_farmers/"); ?>" href="<?php echo base_url("/reports/report_non_eligible_farmers/"); ?>">Non-Eligible Farmers</a></li>
									<li><a class="<?php active_module($active_module,"/reports/grant/"); ?>" href="<?php echo base_url("/reports/grant/"); ?>">Grant Disbursement</a></li>
									<!-- <li><a class="<?php active_module($active_module,"/reports/dynamic/106/78/"); ?>" href="<?php echo base_url("/reports/dynamic/106/78/"); ?>">Project wise Grant</a></li> -->
									<li><a class="<?php active_module($active_module,"/reports/dynamic/106/78/"); ?>" href="<?php echo base_url("/reports/dynamic/106/78/"); ?>">Project wise Grant Disbursement</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/112/84/"); ?>" href="<?php echo base_url("/reports/dynamic/112/84/"); ?>">Item wise Grant Disbursement</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/108/80/"); ?>" href="<?php echo base_url("/reports/dynamic/108/80/"); ?>">Claim Track</a></li>
									<!-- <li><a class="<?php active_module($active_module,"/reports/loan_disbursement/"); ?>" href="<?php echo base_url("/reports/loan_disbursement/"); ?>">Loan Disbursement</a></li> -->
									<li><a class="<?php active_module($active_module,"/reports/dynamic/79/10/"); ?>" href="<?php echo base_url("/reports/dynamic/79/10/"); ?>">Loan Disbursement</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/101/75/"); ?>" href="<?php echo base_url("/reports/dynamic/101/75/"); ?>">Project wise Loan Disbursement</a></li>
									<!-- <li><a class="<?php active_module($active_module,"/reports/dynamic/107/79/"); ?>" href="<?php echo base_url("/reports/dynamic/107/79/"); ?>">Project wise Loan</a></li> -->

									<!-- <li><a class="<?php active_module($active_module,"/reports/dynamic/115/87/"); ?>" href="<?php echo base_url("/reports/dynamic/115/87/"); ?>">Loan Category Wise</a></li> -->
									<li><a class="<?php active_module($active_module,"/reports/dynamic/115/87/"); ?>" href="<?php echo base_url("/reports/dynamic/115/87/"); ?>">Loan Category Wise Disbursement</a></li>
									<li><a class="<?php active_module($active_module,"/reports/off_farm_development/"); ?>" href="<?php echo base_url("/reports/off_farm_development/"); ?>">Off Farm</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/118/100/"); ?>" href="<?php echo base_url("/reports/dynamic/118/100/"); ?>">Startup Fund</a></li>
									<li><a class="<?php active_module($active_module,"/reports/training_programmes/"); ?>" href="<?php echo base_url("/reports/training_programmes/"); ?>">Training Programmes</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/113/85/"); ?>" href="<?php echo base_url("/reports/dynamic/113/85/"); ?>">Training Type</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/114/86/"); ?>" href="<?php echo base_url("/reports/dynamic/114/86/"); ?>">Project wise training</a></li>
									<li><a class="<?php active_module($active_module,"/reports/is/"); ?>" href="<?php echo base_url("/reports/is/"); ?>">IS Providers</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/104/74/"); ?>" href="<?php echo base_url("/reports/dynamic/104/74/"); ?>">IS Activities</a></li>
									<li><a class="<?php active_module($active_module,"/reports/matching_grant/"); ?>" href="<?php echo base_url("/reports/matching_grant/"); ?>">Matching Grant</a></li>
									<li><a class="<?php active_module($active_module,"/reports/list_of_4P_projects/"); ?>" href="<?php echo base_url("/reports/list_of_4P_projects/"); ?>">List of 4P Projects</a></li>

									<li><a class="<?php active_module($active_module,"/reports/dynamic/103/77/"); ?>" href="<?php echo base_url("/reports/dynamic/103/77/"); ?>">Project Officers</a></li>
									<li><a class="<?php active_module($active_module,"/reports/promotor/"); ?>" href="<?php echo base_url("/reports/promotor/"); ?>">Promoters</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/111/83/"); ?>" href="<?php echo base_url("/reports/dynamic/111/83/"); ?>">Promoter Submissions</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/109/81/"); ?>" href="<?php echo base_url("/reports/dynamic/109/81/"); ?>">Doc Archive</a></li>
									<li><a class="<?php active_module($active_module,"/reports/nsc_paper/"); ?>" href="<?php echo base_url("/reports/nsc_paper/"); ?>">NSC</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/83/14/"); ?>" href="<?php echo base_url("/reports/dynamic/83/14/"); ?>">EOI</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/89/40/"); ?>" href="<?php echo base_url("/reports/dynamic/89/40/"); ?>">Contracts</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/84/15/"); ?>" href="<?php echo base_url("/reports/dynamic/84/15/"); ?>">Procurement</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/95/49/"); ?>" href="<?php echo base_url("/reports/dynamic/95/49/"); ?>">Staff Contract</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/105/73/"); ?>" href="<?php echo base_url("/reports/dynamic/105/73/"); ?>">Staff Profile</a></li>

									<li><a class="<?php active_module($active_module,"/reports/leave_mgt/"); ?>" href="<?php echo base_url("/reports/leave_mgt/"); ?>">Leave Mgt</a></li>
									<li><a class="<?php active_module($active_module,"/reports/inventory/"); ?>" href="<?php echo base_url("/reports/inventory/"); ?>">Inventory</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/110/82/"); ?>" href="<?php echo base_url("/reports/dynamic/110/82/"); ?>">SAPP Formats</a></li>
									<li><a class="<?php active_module($active_module,"/reports/dynamic/116/89/"); ?>" href="<?php echo base_url("/reports/dynamic/116/89/"); ?>">Access Stats</a></li>
								</ul>
							</li>
							<?php } ?>
							<li class="menu-title"><span>SAPP</span></li>
							<?php if(is_auth(7) || is_auth(163) || is_auth(19)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">group_add</span><span> Manage Users</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(9) || is_auth(21)){ ?>
									<li><a class="<?php active_module($active_module,"/user/add_edit/"); ?>" href="<?php echo base_url("/user/add_edit/"); ?>">Add Users</a></li>
									<?php } ?>
									<?php if(is_auth(7) || is_auth(19)){ ?>
									<li><a class="<?php active_module($active_module,"/user/list_all/"); ?>" href="<?php echo base_url("/user/list_all/"); ?>">List Users</a></li>
									<?php } ?>
									<?php if(is_auth(165)){ ?>
									<li><a class="<?php active_module($active_module,"/user_group/add_edit/"); ?>" href="<?php echo base_url("/user_group/add_edit/"); ?>">Add Users Group</a></li>
									<?php } ?>
									<?php if(is_auth(163)){ ?>
									<li><a class="<?php active_module($active_module,"/user_group/list_all/"); ?>" href="<?php echo base_url("/user_group/list_all/"); ?>">List Users Group</a></li>	
									<?php } ?>									
								</ul>
							</li>
							<?php } ?>

							<?php if(is_auth(43) || is_auth(7) || is_auth(55)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['hr_n_a']; ?>"><span class="material-symbols-rounded">badge</span><span> HR & A</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(45)){ ?>
										<li><a class="<?php active_module($active_module,"/fixed_assert/add_edit/"); ?>" href="<?php echo base_url("/fixed_assert/add_edit/"); ?>">Add Inventory</a></li>
									<?php } ?>
									<?php if(is_auth(43)){ ?>
										<li><a class="<?php active_module($active_module,"/fixed_assert/list_all/"); ?>" href="<?php echo base_url("/fixed_assert/list_all/"); ?>">List Inventory</a></li>
									<?php } ?>
									<?php if(is_auth(7)){ ?>
										<li><a class="<?php active_module($active_module,"/user/list_staff/"); ?>" href="<?php echo base_url("/user/list_staff/"); ?>">List PMU Staff</a></li>
									<?php } ?>
									<?php if(is_auth(37)){ ?>	
										<li><a class="<?php active_module($active_module,"/staff_leave/list_all/"); ?>" href="<?php echo base_url("/staff_leave/list_all/"); ?>">Attendance </a></li>
									<?php } ?>
									<?php if(is_auth(57)){ ?>		
										<li><a class="<?php active_module($active_module,"/staff_contract_mgt/add_edit/"); ?>" href="<?php echo base_url("/staff_contract_mgt/add_edit/"); ?>">Add Staff Contract Mgt</a></li>
									<?php } ?>
									<?php if(is_auth(55)){ ?>	
										<li><a class="<?php active_module($active_module,"/staff_contract_mgt/list_all/"); ?>" href="<?php echo base_url("/staff_contract_mgt/list_all/"); ?>">List Staff Contract Mgt</a></li>						
									<?php } ?>
								</ul>
							</li>
							<?php } ?>

							<?php if(is_auth(55) || is_auth(57) || is_auth(63) || is_auth(61) || is_auth(67) || is_auth(69)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">document_scanner</span><span> Procurement</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(57)){ ?>
										<li><a class="<?php active_module($active_module,"/contract/add_edit/"); ?>" href="<?php echo base_url("/contract/add_edit/"); ?>">Add Contract</a></li>	
									<?php } ?>
									<?php if(is_auth(55)){ ?>
										<li><a class="<?php active_module($active_module,"/contract/list_all/"); ?>" href="<?php echo base_url("/contract/list_all/"); ?>">List Contract</a></li>
									<?php } ?>
									<?php if(is_auth(63)){ ?>
										<li><a class="<?php active_module($active_module,"/contract_supplier/add_edit/"); ?>" href="<?php echo base_url("/contract_supplier/add_edit/"); ?>">Add Contract Supplier</a></li>	
									<?php } ?>
									<?php if(is_auth(61)){ ?>
										<li><a class="<?php active_module($active_module,"/contract_supplier/list_all/"); ?>" href="<?php echo base_url("/contract_supplier/list_all/"); ?>">List Contract Supplier</a></li>
									<?php } ?>
									<?php if(is_auth(69)){ ?>
										<li><a class="<?php active_module($active_module,"/procurement/add_edit/"); ?>" href="<?php echo base_url("/procurement/add_edit/"); ?>">Add Procurement</a></li>
									<?php } ?>
									<?php if(is_auth(67)){ ?>
										<li><a class="<?php active_module($active_module,"/procurement/list_all/"); ?>" href="<?php echo base_url("/procurement/list_all/"); ?>">List Procurement</a></li>						
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(79) || is_auth(75) || is_auth(73) || is_auth(27) || is_auth(25)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['mne']; ?>"><span class="material-symbols-rounded">monitor_heart</span><span> M&E</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(75)){ ?>
										<li><a class="<?php active_module($active_module,"/nsc_meeting/add_edit/"); ?>" href="<?php echo base_url("/nsc_meeting/add_edit/"); ?>">Add NSC</a></li>	
									<?php } ?>
									<?php if(is_auth(73)){ ?>
										<li><a class="<?php active_module($active_module,"/nsc_meeting/list_all/"); ?>" href="<?php echo base_url("/nsc_meeting/list_all/"); ?>">List NSC</a></li>
									<?php } ?>
									<?php if(is_auth(79)){ ?>
										<li><a class="<?php active_module($active_module,"/mis/"); ?>" target="_blank" href="<?php echo base_url("/mis/"); ?>">Survey</a></li>					
									<?php } ?>
									<?php if(is_auth(27)){ ?>
										<li><a class="<?php active_module($active_module,"/training/add_edit/"); ?>" href="<?php echo base_url("/training/add_edit/"); ?>">Add Training</a></li>
									<?php } ?>
									<?php if(is_auth(25)){ ?>
										<li><a class="<?php active_module($active_module,"/training/list_all/"); ?>" href="<?php echo base_url("/training/list_all/"); ?>">List Training</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(93) || is_auth(91)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['doc_archive']; ?>"><span class="material-symbols-rounded">archive</span><span> Doc Archive</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(93)){ ?>
										<li><a class="<?php active_module($active_module,"/doc_archive/add_edit/"); ?>" href="<?php echo base_url("/doc_archive/add_edit/"); ?>">Add Doc Archive</a></li>	
									<?php } ?>
									<?php if(is_auth(91)){ ?>
										<li><a class="<?php active_module($active_module,"/doc_archive/list_all/"); ?>" href="<?php echo base_url("/doc_archive/list_all/"); ?>">List Doc Archive</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<li class="menu-title"><span>PROJECT MGT</span></li>

							<?php if(is_auth(99) || is_auth(97) || is_auth(105) || is_auth(103)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['eoi']; ?>"><span class="material-symbols-rounded">collections_bookmark</span><span> EOI</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(99)){ ?>
										<li><a class="<?php active_module($active_module,"/eoi/add_edit/"); ?>" href="<?php echo base_url("/eoi/add_edit/"); ?>">Add EOI</a></li>
									<?php } ?>
									<?php if(is_auth(97)){ ?>
										<li><a class="<?php active_module($active_module,"/eoi/list_all/"); ?>" href="<?php echo base_url("/eoi/list_all/"); ?>">List EOI</a></li>
									<?php } ?>
									<?php if(is_auth(105)){ ?>
										<li><a class="<?php active_module($active_module,"/eoi_applicant/add_edit/"); ?>" href="<?php echo base_url("/eoi_applicant/add_edit/"); ?>">Add EOI Applicant</a></li>
									<?php } ?>
									<?php if(is_auth(103)){ ?>
										<li><a class="<?php active_module($active_module,"/eoi_applicant/list_all/"); ?>" href="<?php echo base_url("/eoi_applicant/list_all/"); ?>">List EOI Applicant</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(21) || is_auth(19)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">campaign</span><span> Promoter</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(21)){ ?>
										<li><a class="<?php active_module($active_module,"/promoter/add_edit/"); ?>" href="<?php echo base_url("/promoter/add_edit/"); ?>">Add Promoter</a></li>
									<?php } ?>
									<?php if(is_auth(19)){ ?>
										<li><a class="<?php active_module($active_module,"/promoter/list_all/"); ?>" href="<?php echo base_url("/promoter/list_all/"); ?>">List Promoters</a></li>									
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(15) | is_auth(13) | is_auth(121) | is_auth(123)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['projects']; ?>"><span class="material-symbols-rounded">create_new_folder</span><span> Projects</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(15)){ ?>
										<li><a class="<?php active_module($active_module,"/project/add_edit/"); ?>" href="<?php echo base_url("/project/add_edit/"); ?>">Add Project</a></li>
									<?php } ?>
									<?php if(is_auth(13)){ ?>
										<li><a class="<?php active_module($active_module,"/project/list_all/"); ?>" href="<?php echo base_url("/project/list_all/"); ?>">List Projects</a></li>									
									<?php } ?>
									<?php if(is_auth(123)){ ?>
										<li><a class="<?php active_module($active_module,"/off_farm_development/add_edit/"); ?>" href="<?php echo base_url("/off_farm_development/add_edit/"); ?>">Add off-farm</a></li>
									<?php } ?>
									<?php if(is_auth(121)){ ?>
										<li><a class="<?php active_module($active_module,"/off_farm_development/list_all/"); ?>" href="<?php echo base_url("/off_farm_development/list_all"); ?>">List off-farm</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(127) || is_auth(128) || is_auth(129) || is_auth(135) || is_auth(134) || is_auth(133)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['is']; ?>"><span class="material-symbols-rounded">account_tree</span><span> IS</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(129)){ ?>							
										<li><a class="<?php active_module($active_module,"/is/add_edit/"); ?>" href="<?php echo base_url("/is/add_edit/"); ?>">Add IS</a></li>
									<?php } ?>
									<?php if(is_auth(127)){ ?>
										<li><a class="<?php active_module($active_module,"/is/list_all/"); ?>" href="<?php echo base_url("/is/list_all/"); ?>">List IS</a></li>
									<?php } ?>
									<?php if(is_auth(135)){ ?>
										<li><a class="<?php active_module($active_module,"/is_service_provider/add_edit/"); ?>" href="<?php echo base_url("/is_service_provider/add_edit/"); ?>">Add Service Provider</a></li>
									<?php } ?>
									<?php if(is_auth(133)){ ?>
										<li><a class="<?php active_module($active_module,"/is_service_provider/list_all/"); ?>" href="<?php echo base_url("/is_service_provider/list_all/"); ?>">List Service Provider</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(127) || is_auth(129) || is_auth(135) || is_auth(133)){ ?>
							<li class="submenu">
							<a href="#"><span class="material-symbols-rounded">payments</span><span> Startup Fund</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(127)){ ?>							
										<li><a class="<?php active_module($active_module,"/fpo/add_edit/"); ?>" href="<?php echo base_url("/fpo/add_edit/"); ?>">Add FPO</a></li>
									<?php } ?>
									<?php if(is_auth(129)){ ?>
										<li><a class="<?php active_module($active_module,"/fpo/list_all/"); ?>" href="<?php echo base_url("/fpo/list_all/"); ?>">List FPO</a></li>
									<?php } ?>
									<?php if(is_auth(135)){ ?>
										<li><a class="<?php active_module($active_module,"/fpo_disbursement/add_edit/"); ?>" href="<?php echo base_url("/fpo_disbursement/add_edit/"); ?>">Add Statup fund Disbursement</a></li>
									<?php } ?>
									<?php if(is_auth(133)){ ?>
										<li><a class="<?php active_module($active_module,"/fpo_disbursement/list_all/"); ?>" href="<?php echo base_url("/fpo_disbursement/list_all/"); ?>">List Statup fund Disbursement</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<li class="menu-title"><span>BENEFICIARY MGT</span></li>
							<?php if(is_auth(169) || is_auth(171)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">admin_panel_settings</span><span> Beneficiary</span> <span class="menu-arrow"></span></a>
								<ul>	
								<?php if(is_auth(171)){ ?>
									<li><a class="<?php active_module($active_module,"/user/add_edit/farmer/"); ?>" href="<?php echo base_url("/user/add_edit?user_type=2"); ?>">Add Beneficiary</a></li>
								<?php } ?>
								<?php if(is_auth(169)){ ?>
									<li><a class="<?php active_module($active_module,"/user/farmer_project/"); ?>" href="<?php echo base_url("/user/farmer_project?user_type=2"); ?>">List Beneficiary</a></li>
								<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(141) || is_auth(139)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">payments</span><span> Loan</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(141)){ ?>
										<li><a class="<?php active_module($active_module,"/loan/add_edit/"); ?>" href="<?php echo base_url("/loan/add_edit/"); ?>">Add Loan Group</a></li>
									<?php } ?>
									<?php if(is_auth(139)){ ?>
										<li><a class="<?php active_module($active_module,"/loan/list_all/"); ?>" href="<?php echo base_url("/loan/list_all/"); ?>">List Loan Group</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<?php if(is_auth(147) || is_auth(145) || is_auth(153) || is_auth(151)){ ?>
							<li class="submenu">
								<a href="#"><span class="material-symbols-rounded">card_travel</span><span> Grant</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(147)){ ?>
										<li><a class="<?php active_module($active_module,"/grant/add_edit/"); ?>" href="<?php echo base_url("/grant/add_edit/"); ?>">Add Claim Group</a></li>
									<?php } ?>
									<?php if(is_auth(145)){ ?>
										<li><a class="<?php active_module($active_module,"/grant/list_all/"); ?>" href="<?php echo base_url("/grant/list_all/"); ?>">List Claim Group</a></li>
									<?php } ?>
									<?php if(is_auth(153)){ ?>
										<li><a class="<?php active_module($active_module,"/matching_grant_development/add_edit/"); ?>" href="<?php echo base_url("/matching_grant_development/add_edit/"); ?>">Add Matching Grant</a></li>
									<?php } ?>
									<?php if(is_auth(151)){ ?>
										<li><a class="<?php active_module($active_module,"/matching_grant_development/list_all/"); ?>" href="<?php echo base_url("/matching_grant_development/list_all/"); ?>">List Matching Grant</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
							<li class="menu-title"><span>PROMOTER PROGRESS</span></li>
							<?php if(is_auth(31) || is_auth(33)){ ?>
							<li class="submenu">
								<a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="<?php echo $abbreviations['monthly_report']; ?>"><span class="material-symbols-rounded">calendar_month</span><span> Monthly Report</span> <span class="menu-arrow"></span></a>
								<ul>
									<?php if(is_auth(33)){ ?>	
										<li><a class="<?php active_module($active_module,"/progress/add_edit/"); ?>" href="<?php echo base_url("/progress/add_edit/"); ?>">Add Monthly Report</a></li>
									<?php } ?>
									<?php if(is_auth(31)){ ?>
										<li><a class="<?php active_module($active_module,"/progress/list_all/"); ?>" href="<?php echo base_url("/progress/list_all/"); ?>">List Monthly Report</a></li>
									<?php } ?>
								</ul>
							</li>
							<?php } ?>
						<?php }else{ ?>
							<li class="menu-title"><span>HOME</span></li>
							<li class="submenu">
								<a href="#"><i class="fa fa-user"></i><span> Pages</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a class="<?php active_module($active_module,"/page/privacy/"); ?>" href="<?php echo base_url("/page/privacy/"); ?>">Privacy Policy</a></li>
								</ul>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>