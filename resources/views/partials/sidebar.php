<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- Add your menu items here -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <!-- ... -->
            @if($user->user_role == 'admin')
                <li>
                    <a href="{{ url('users/manage_users') }}">
                        <i class="fa fa-gear"></i> <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('settings/settings_menu') }}">
                        <i class="fa fa-gear"></i> <span>Settings</span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
</aside>
