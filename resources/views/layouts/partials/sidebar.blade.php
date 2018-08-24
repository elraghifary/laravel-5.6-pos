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
            <li>
                <a href="{{ route('category.index') }}">
                    <i class="fa fa-file-text"></i> <span>Category</span>
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}">
                    <i class="fa fa-file-text"></i> <span>Product</span>
                </a>
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