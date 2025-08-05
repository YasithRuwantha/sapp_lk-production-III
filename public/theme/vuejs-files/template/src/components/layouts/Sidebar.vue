<template>
    <!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner">
				 <perfect-scrollbar class="scroll-area"  :settings="settings" @ps-scroll-y="scrollHanle">
						<div id="sidebar-menu" class="sidebar-menu">
							<ul>
								<li class="menu-title"><span>Main</span></li>
								<li v-bind:class="{'active': currentPath == 'dashboard'}">
									<router-link to="/index"><i data-feather="home"></i>  <span>Dashboard</span></router-link>
								</li>
								<li v-bind:class="{'active': currentPath == 'add-customer' || currentPath == 'edit-customer'}">
									<router-link to="/customers"><i data-feather="users"></i><span>Customers</span></router-link>
								</li>
								<li v-bind:class="{'active': currentPath == 'add-estimate' || currentPath == 'view-estimate' || currentPath == 'edit-estimate'}">
									<router-link to="/estimates"><i data-feather="file-text"></i> <span>Estimates</span></router-link>
								</li>
								<li v-bind:class="{'active': currentPath == 'add-invoice' || currentPath == 'edit-invoice' || currentPath == 'view-invoice'}">
									<router-link to="/invoices"><i data-feather="clipboard"></i> <span>Invoices</span></router-link>
								</li>
								<li v-bind:class="{'active': currentPath == 'add-payment'}">
									<router-link to="/payments"><i data-feather="credit-card"></i> <span>Payments</span></router-link>
								</li>
								<li v-bind:class="{'active': currentPath == 'add-expense' || currentPath == 'edit-expense'}">
									<router-link to="/expenses"><i data-feather="package"></i> <span>Expenses</span></router-link>
								</li>
								<li class="submenu">
								<a href="#"><i data-feather="pie-chart"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
								<ul>
									<li><router-link to="/sales-report">Sales Report</router-link></li>
									<li><router-link to="/expenses-report">Expenses Report</router-link></li>
									<li><router-link to="/profit-loss-report">Profit & Loss Report</router-link></li>
									<li><router-link to="/taxs-report">Taxs Report</router-link></li>
								</ul>
							</li>
								<li v-bind:class="{'active': settingsPath}">
									<router-link to="/settings"><i data-feather="settings"></i> <span>Settings</span></router-link>
								</li>
								<li class="submenu">
									<a href="#"><i data-feather="grid"></i> <span> Application</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><router-link to="/chat">Chat</router-link></li>
										<li><router-link to="/calendar">Calendar</router-link></li>
										<li><router-link to="/inbox">Email</router-link></li>
									</ul>
								</li>
								<li class="menu-title"> 
									<span>Pages</span>
								</li>
								<li> 
									<router-link to="/customer/profile"><i data-feather="user-plus"></i> <span>Profile</span></router-link>
								</li>
								<li class="submenu">
									<a href="#"><i data-feather="lock"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><router-link to="/login"> Login </router-link></li>
										<li><router-link to="/register"> Register </router-link></li>
										<li><router-link to="/forgot-password"> Forgot Password </router-link></li>
										<li><router-link to="/lock-screen"> Lock Screen </router-link></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i data-feather="alert-octagon"></i><span> Error Pages </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><router-link to="/404">404 Error </router-link></li>
										<li><router-link to="/500">500 Error </router-link></li>
									</ul>
								</li>
								<li> 
									<router-link to="/users"><i data-feather="user"></i> <span>Users</span></router-link>
								</li>
								<li> 
									<router-link to="/blank-page"><i data-feather="file"></i> <span>Blank Page</span></router-link>
								</li>
								
								<li class="menu-title"> 
									<span>UI Interface</span>
								</li>
								<li> 
									<router-link to="/components"><i data-feather="layers"></i><span>Components</span></router-link>
								</li>
								<li class="submenu">
									<a href="#"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><router-link to="/form-basic-inputs">Basic Inputs </router-link></li>
										<li><router-link to="/form-input-groups">Input Groups </router-link></li>
										<li><router-link to="/horizontal-form">Horizontal Form </router-link></li>
										<li><router-link to="/vertical-form"> Vertical Form </router-link></li>
										<li><router-link to="/form-mask"> Form Mask </router-link></li>
										<li><router-link to="/form-validation"> Form Validation </router-link></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i data-feather="layout"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><router-link to="/basic-tables">Basic Tables </router-link></li>
										<li><router-link to="/datatables">Data Table </router-link></li>
									</ul>
								</li>
							</ul>
						</div>
				</perfect-scrollbar>
				</div>
			</div>
			<!-- /Sidebar -->
</template>

<script>
    import {PerfectScrollbar}  from 'vue3-perfect-scrollbar'
    import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css'
    import feather from 'feather-icons'
    export default {
		components: {
		 PerfectScrollbar 
		},
		mounted() {

			feather.replace()
			$('#sidebar-menu a').on('click', function (e) {
			if ($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if (!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if ($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		 
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
		},
		computed: {
			currentPath() {
				return this.$route.name;
			},
			settingsPath() {
				return  this.$route.name == 'settings'  || this.$route.name == 'preferences' || this.$route.name == 'tax-types' || this.$route.name == 'expense-category' || this.$route.name == 'notifications' || this.$route.name == 'change-password' || this.$route.name == 'delete-account'
			}
		},
		  data() {
    return {
                settings: {
                    suppressScrollX: true,
                },
                activeClass: 'active',
            };
     

              //  isactive : true
    },
    methods: {
    scrollHanle(evt) {
      console.log(evt)
    }
  },
}
</script>
<style>
    .scroll-area {
      position: relative;
      margin: auto;
      height: calc(100vh - 60px);
      background-color: transparent !important;
  }
</style>