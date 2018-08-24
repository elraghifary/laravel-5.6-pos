<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://via.placeholder.com/100x100" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Elra</p>
                <p>Administrator</p>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> User
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('role.index') }}">
                            <i class="fa fa-circle-o"></i> Role
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.role_permissions') }}">
                            <i class="fa fa-circle-o"></i> <span>Role Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Content Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('category.index') }}">
                            <i class="fa fa-circle-o"></i> <span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">
                            <i class="fa fa-circle-o"></i> <span>Product</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('form-logout').submit();">
                    <i class="fa fa-sign-out"></i><span>{{ __('Logout') }}</span>
                </a>

                <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
</aside>