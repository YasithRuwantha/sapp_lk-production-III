<?php error_reporting(0);?>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Main</span></li>
                <li class="{{ Request::is('index') ? 'active' : '' }}">
                    <a href="index"><i data-feather="home"></i> <span>Dashboard</span></a>
                </li>
                <li  class="{{ Request::is('customers','add-customer','edit-customer') ? 'active' : '' }}">
                    <a href="customers"><i data-feather="users"></i> <span>Customers</span></a>
                </li>
                <li  class="{{ Request::is('estimates','add-estimate','edit-estimate','view-estimate') ? 'active' : '' }}">
                    <a href="estimates"><i data-feather="file-text"></i> <span>Estimates</span></a>
                </li>
                <li  class="{{ Request::is('invoices','add-invoice','edit-invoice','view-invoice') ? 'active' : '' }}">
                    <a href="invoices"><i data-feather="clipboard"></i> <span>Invoices</span></a>
                </li>
                <li  class="{{ Request::is('payments','add-payments') ? 'active' : '' }}">
                    <a href="payments"><i data-feather="credit-card"></i> <span>Payments</span></a>
                </li>
                <li  class="{{ Request::is('expenses','add-expenses','edit-expenses') ? 'active' : '' }}">
                    <a href="expenses"><i data-feather="package"></i> <span>Expenses</span></a>
                </li>
                <li class="submenu <?php if($page=="sales-report" || $page=="expenses-report" || $page=="profit-loss-report" || $page=="taxs-report") { echo 'active'; } ?>">
                    <a href="#"><i data-feather="pie-chart"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="<?php if($page=="sales-report") { echo 'active'; } ?>" href="sales-report">Sales Report</a></li>
                        <li><a class="<?php if($page=="expenses-report") { echo 'active'; } ?>" href="expenses-report">Expenses Report</a></li>
                        <li><a class="<?php if($page=="profit-loss-report") { echo 'active'; } ?>" href="profit-loss-report">Profit & Loss Report</a></li>
                        <li><a class="<?php if($page=="taxs-report") { echo 'active'; } ?>" href="taxs-report">Taxs Report</a></li>
                    </ul>
                </li>
                <li  class="{{ Request::is('settings','change-password','delete-account','expense-category','notifications','preferences','tax-types') ? 'active' : '' }}">
                    <a href="settings"><i data-feather="settings"></i> <span>Settings</span></a>
                </li>
                <li class="submenu <?php if($page=="chat" || $page=="calendar" || $page=="calendar" || $page=="inbox") { echo 'active'; } ?>">
                    <a href="#"><i data-feather="grid"></i> <span> Application</span> <span class="menu-arrow"></span></a>
                    <ul>
                    <li><a class="<?php if($page=="chat") { echo 'active'; } ?>" href="chat">Chat</a></li>                    
                    <li><a class="<?php if($page=="calendar") { echo 'active'; } ?>" href="calendar">Calendar</a></li>
                    <li><a class="<?php if($page=="inbox") { echo 'active'; } ?>" href="inbox">Email</a></li>
                    </ul>
                </li>
                <li class="menu-title"> 
                    <span>Pages</span>
                </li>
                <li class="{{ Request::is('profile') ? 'active' : '' }}"> 
                    <a href="profile"><i data-feather="user-plus"></i> <span>Profile</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i data-feather="lock"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="login"> Login </a></li>
                        <li><a href="register"> Register </a></li>
                        <li><a href="forgot-password"> Forgot Password </a></li>
                        <li><a href="lock-screen"> Lock Screen </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i data-feather="alert-octagon"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="error-404">404 Error </a></li>
                        <li><a href="error-500">500 Error </a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('users') ? 'active' : '' }}"> 
                    <a href="users"><i data-feather="user"></i> <span>Users</span></a>
                </li>
                <li class="{{ Request::is('blank-page') ? 'active' : '' }}"> 
                    <a href="blank-page"><i data-feather="file"></i> <span>Blank Page</span></a>
                </li>
                <li class="{{ Request::is('maps-vector') ? 'active' : '' }}"> 
                    <a href="maps-vector"><i data-feather="map-pin"></i> <span>Vector Maps</span></a>
                </li>
                <li class="menu-title"> 
                    <span>UI Interface</span>
                </li>
                <li class="{{ Request::is('components') ? 'active' : '' }}"> 
                    <a href="components"><i data-feather="layers"></i> <span>Components</span></a>
                </li>
                <li class="submenu <?php if($page=="form-basic-inputs" || $page=="form-horizontal" || $page=="form-vertical" || $page=="form-mask" || $page=="form-input-groups" || $page=="form-validation") { echo 'active'; } ?>">
                    <a href="#"><i data-feather="columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="<?php if($page=="form-basic-inputs") { echo 'active'; } ?>" href="form-basic-inputs">Basic Inputs </a></li>
                        <li><a class="<?php if($page=="form-input-groups") { echo 'active'; } ?>" href="form-input-groups">Input Groups </a></li>
                        <li><a class="<?php if($page=="form-horizontal") { echo 'active'; } ?>" href="form-horizontal">Horizontal Form </a></li>
                        <li><a class="<?php if($page=="form-vertical") { echo 'active'; } ?>" href="form-vertical"> Vertical Form </a></li>
                        <li><a class="<?php if($page=="form-mask") { echo 'active'; } ?>" href="form-mask"> Form Mask </a></li>
                        <li><a class="<?php if($page=="form-validation") { echo 'active'; } ?>" href="form-validation"> Form Validation </a></li>
                    </ul>
                </li>

                <li class="submenu <?php if($page=="tables-basic" || $page=="data-tables") { echo 'active'; } ?>">
                    <a href="#"><i data-feather="layout"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="<?php if($page=="tables-basic") { echo 'active'; } ?>" href="tables-basic">Basic Tables </a></li>
                        <li><a class="<?php if($page=="data-tables") { echo 'active'; } ?>" href="data-tables">Data Table </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->