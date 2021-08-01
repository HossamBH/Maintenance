<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="{{route('admin.dashboard')}}"><img src="{{url('assets/images/icon.svg')}}" alt="Logo"
                class="img-fluid logo"><span>Maintenance</span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i
                class="lnr lnr-menu fa fa-chevron-circle-left"></i></button>
    </div>
    <div class="sidebar-scroll">
        <div class="user-account">
            <div class="user_div">
                <img src="{{url('assets/images/user.png')}}" class="user-photo" alt="User Profile Picture">
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="user-name" data-toggle="dropdown"><strong>
                        {{isset(auth()->user()->name) ? auth()->user()->name : null}}</strong></a>
            </div>
        </div>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">

                <li class="{{ Request::segment(2) === 'locations' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-anchor"></i><span>Locations</span></a>
                    <ul>
                        <li><a href="{{route('admin.cities.index')}}">Cities</a></li>
                        <li><a href="{{route('admin.areas.index')}}">Areas</a></li>

                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'taxes' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-book-open"></i><span>Taxes</span></a>
                    <ul>
                        <li><a href="{{route('admin.taxTypes.index')}}">Types</a></li>
                        <li><a href="{{route('admin.taxes.index')}}">Taxes</a></li>
                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'items' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-basket"></i><span>Items</span></a>
                    <ul>
                        <li><a href="{{route('admin.categories.index')}}">Categories</a></li>
                        <li><a href="{{route('admin.items.index')}}">Items</a></li>
                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'customers' ? 'active open' : null }}">
                    <a href="{{route('admin.customers.index')}}"><i class="icon-users"></i><span>Customers</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'employees' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-briefcase"></i><span>Employees</span></a>
                    <ul>
                        <li><a href="{{route('admin.jobs.index')}}">Jobs</a></li>
                        <li><a href="{{route('admin.salaries.index')}}">Salaries</a></li>
                        <li><a href="{{route('admin.employees.index')}}">Employees</a></li>
                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'inventories' ? 'active open' : null }}">
                    <a href="{{route('admin.inventories.index')}}"><i
                            class="icon-layers"></i><span>Inventories</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'suppliers' ? 'active open' : null }}">
                    <a href="{{route('admin.suppliers.index')}}"><i class="icon-loop"></i><span>suppliers</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'orders' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-paper-plane"></i><span>Orders</span></a>
                    <ul>
                        <li><a href="{{route('admin.purchaseOrders.index')}}">Purchase Orders</a></li>
                        <a href="{{route('admin.salesOrders.index')}}"><span>Sales Orders</span></a>
                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'expenses' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-wallet"></i><span>Expenses</span></a>
                    <ul>
                        <li><a href="{{route('admin.expensesType.index')}}">Types</a></li>
                        <li><a href="{{route('admin.expenses.index')}}">Expenses</a></li>
                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'offers' ? 'active open' : null }}">
                    <a href="{{route('admin.offers.index')}}"><i class="icon-calculator"></i><span>Offers</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'payments' ? 'active open' : null }}">
                    <a href="{{route('admin.payments.index')}}"><i class="icon-arrow-down"></i><span>Payments</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'reports' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-bar-chart"></i><span>Reports</span></a>
                    <ul>
                        <li><a href="{{route('admin.invoices.index')}}">Invoices</a></li>
                        <li><a href="{{route('admin.profits')}}">Profit</a></li>
                        <li><a href="{{route('admin.report.safe')}}">Safe</a></li>
                    </ul>
                </li>

                <li class="{{ Request::segment(2) === 'services' ? 'active open' : null }}">
                    <a href="{{route('admin.services.index')}}"><i class="icon-bulb"></i><span>Services</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'cars' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-vector"></i><span>Cars</span></a>
                    <ul>
                        <a href="{{route('admin.carBrands.index')}}"><span>Brands</span></a>
                        <a href="{{route('admin.carModels.index')}}"><span>Models</span></a>
                        <li><a href="{{route('admin.cars.index')}}">Cars</a></li>
                    </ul>
                </li>
                <li class="{{ Request::segment(2) === 'serviceMaintenance' ? 'active open' : null }}">
                    <a href="{{route('admin.serviceMaintenance.index')}}"><i class="icon-settings"></i><span>Car Maintenance</span></a>
                </li>
                <li class="{{ Request::segment(2) === 'adminstrator' ? 'active open' : null }}">
                    <a href="" class="has-arrow"><i class="icon-briefcase"></i><span>Adminstrators</span></a>
                    <ul>
                        <li><a href="{{route('admin.users.index')}}">Users</a></li>
                        <li><a href="{{route('admin.roles.index')}}">Roles</a></li>
                    </ul>
                </li>


            </ul>


        </nav>
    </div>
</div>
