<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard Item -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Branch Section -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Branch
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Staff Management -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Staff Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('staffs.create') }}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Add Staff</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('staffs.index') }}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>View Staff</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Parcels Section -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Parcels
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{route('parcels.create')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('accepted.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Item Accepted By Courier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('collected.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Collected</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('shipped.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Shipped</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('intransit.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>In-Transit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('arrived.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Arrived At Destination</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('outof.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Out for Delivery</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('readyto.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Ready to Pickup</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('deliver.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Delivered</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pick.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Picked-up</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pending.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('unsuccess.parcels.index')}}" class="nav-link">
                                <i class="fas fa-angle-right nav-icon"></i>
                                <p>Unsuccessfull Delivery Attempt</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Track Parcel -->
                <li class="nav-item">
                    <a href="{{route('track_parcel')}}" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Track Parcel</p>
                    </a>
                </li>

                <!-- Reports -->
                <li class="nav-item">
                    <a href="{{ route('parcels.report') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Reports</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
