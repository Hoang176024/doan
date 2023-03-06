<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('image/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">POS</span>
    </a>


    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                @php $user = Auth::user();
                $avatarUrl = ($user->avatar) ? Storage::url($user->avatar) : asset('image/avatar_icon.png');
                @endphp
                @if($user->avatar==null)
                    <img src="{{asset('image/avatar_icon.png')}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{$avatarUrl}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>

            <div class="info">
                <a href="{{route('admin.profile.index')}}" class="d-block">{{$user->full_name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="fas fa-angle"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pos.index') }}" class="nav-link">
                        <p><i class="fas fa-cart-plus"></i> Take order </p>
                    </a>
                </li>
                @role('Manager|Owner')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fab fa-product-hunt"></i>
                        <p>
                            Product manage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.suppliers.index') }}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p> Product</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p> Categorie</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.brands.index')}}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p>Brand</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.units.index') }}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p>Unit</p></a>
                        </li>
                    </ul>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="{{route('admin.posInvoices.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Sale Invoice
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('admin.customers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                @role('Owner|Manager')
                <li class="nav-item">
                    <a href="{{route('admin.purchases.index')}}" class="nav-link">
                        <i class="fas fa-store-alt"></i>
                        <p>
                            Import
                            <i class="fas fa-angle"></i>
                        </p>
                    </a>
                </li>
                @endrole
                @role('Owner|Manager')
                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}" class="nav-link">
                        <i class="fas fa-users-cog"></i>
                        <p> Employee </p>
                    </a>
                </li>
                @endrole

                @role('Owner|Manager')
                <li class="nav-item">
                    <a href="{{route('admin.statistic.index')}}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                        <p> Statistic </p>
                    </a>
                </li>
                @endrole

                @role('Owner|Manager')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <p>
                            Miscellaneous
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
<!--
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style="margin-left: 4px">
                            <a href="{{route('admin.deliveries.index')}}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p>Deliverie</p>
                            </a>
                        </li>
-->
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.taxes.index')}}" class="nav-link">
                                <i class="fas fa-arrow-right" style="margin-left: 10px"></i>
                                <p>Tax</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
