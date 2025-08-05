<template>
    <!-- Settings Menu -->
        <div class="widget settings-menu">
            <ul>
                <li class="nav-item">
                    <router-link to="/settings" class="nav-link">
                        <i class="far fa-user"></i> <span>Profile Settings</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/preferences" class="nav-link">
                        <i class="fas fa-cog"></i> <span>Preferences</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/tax-types" class="nav-link">
                        <i class="far fa-check-square"></i> <span>Tax Types</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/expense-category" class="nav-link">
                        <i class="far fa-list-alt"></i> <span>Expense Category</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/notifications" class="nav-link">
                        <i class="far fa-bell"></i> <span>Notifications</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/change-password" class="nav-link">
                        <i class="fas fa-unlock-alt"></i> <span>Change Password</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/delete-account" class="nav-link">
                        <i class="fas fa-ban"></i> <span>Delete Account</span>
                    </router-link>
                </li>
            </ul>
        </div>
    <!-- /Settings Menu -->
</template>