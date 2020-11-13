<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{asset('template/img/logo/logo.png')}}" rel="icon">
    <title>RuangAdmin - Dashboard</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('template/css/ruang-admin.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="app">
        <div id="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false : true " style="display: none;">
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon">
                            <img src="{{ asset('template/img/logo/logo2.png') }}">
                        </div>
                        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item active">
                        <router-link to="/home" class="nav-link">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></router-link>
                    </li>
                    
                    <li class="nav-item active">
                        <router-link to="/pos" class="nav-link">
                            <i class="fas fa-poll"></i>
                            <span>Point Of Sale (POS)</span></router-link>
                    </li>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Features
                    </div>
                    <li class="nav-item">
                        <router-link to="/stock/index" class="nav-link">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Stock</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                            <i class="fas fa-user-tie"></i>
                            <span>Employees</span>
                        </a>
                        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Employees</h6>
                                <router-link to="/employees/index" class="collapse-item">All Employees</router-link>
                                <router-link to="/employees/create" class="collapse-item">Add Employee</router-link>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fas fa-users"></i>
                            <span>Suppliers</span>
                        </a>
                        <div id="collapseBootstrap1" class="collapse" aria-labelledby="collapseBootstrap1" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Suppliers</h6>
                                <router-link to="/suppliers/index" class="collapse-item">All Suppliers</router-link>
                                <router-link to="/suppliers/create" class="collapse-item">Add Supplier</router-link>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="far fa-list-alt"></i>
                            <span>Categories</span>
                        </a>
                        <div id="collapseBootstrap2" class="collapse" aria-labelledby="collapseBootstrap2" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Categories</h6>
                                <router-link to="/categories/index" class="collapse-item">All Categories</router-link>
                                <router-link to="/categories/create" class="collapse-item">Add Category</router-link>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fab fa-product-hunt"></i>
                            <span>Products</span>
                        </a>
                        <div id="collapseBootstrap3" class="collapse" aria-labelledby="collapseBootstrap3" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Products</h6>
                                <router-link to="/products/index" class="collapse-item">All Products</router-link>
                                <router-link to="/products/create" class="collapse-item">Add Product</router-link>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fas fa-donate"></i>
                            <span>Expenses</span>
                        </a>
                        <div id="collapseBootstrap4" class="collapse" aria-labelledby="collapseBootstrap4" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Expenses</h6>
                                <router-link to="/expenses/index" class="collapse-item">All Expenses</router-link>
                                <router-link to="/expenses/create" class="collapse-item">Add Expense</router-link>
                            </div>
                        </div>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap5" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fas fa-money-check-alt"></i>
                            <span>Salaries</span>
                        </a>
                        <div id="collapseBootstrap5" class="collapse" aria-labelledby="collapseBootstrap5" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Salaries</h6>
                                <router-link to="/salaries/index" class="collapse-item">All Salaries</router-link>
                                <router-link to="/given-salary" class="collapse-item">Add Salary</router-link>
                            </div>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap6" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fas fa-users"></i>
                            <span>Customers</span>
                        </a>
                        <div id="collapseBootstrap6" class="collapse" aria-labelledby="collapseBootstrap6" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Customers</h6>
                                <router-link to="/customers/index" class="collapse-item">All Customers</router-link>
                                <router-link to="/customers/create" class="collapse-item">Add Customer</router-link>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap7" aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Orders</span>
                        </a>
                        <div id="collapseBootstrap7" class="collapse" aria-labelledby="collapseBootstrap7" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Orders</h6>
                                <router-link to="/orders" class="collapse-item">All Orders</router-link>
                                <router-link to="/customers/create" class="collapse-item">Search Order</router-link>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <top-bar></top-bar>
                    <!-- Topbar -->

                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">
                        <router-view></router-view>
                    </div>
                    <!---Container Fluid-->
                </div>

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>copyright &copy; 2020 - developed by
                                <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- Footer -->

            </div>
        </div>
    </div>
    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
        let token = localStorage.getItem('token');
        if (token) {
            $('#sidebar').css('display', '');
            $('#topbar').css('display', '');
        }
    </script>
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('template/js/ruang-admin.min.js')}}"></script>
    <script src="{{asset('template/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('template/js/demo/chart-area-demo.js')}}"></script>
</body>

</html>