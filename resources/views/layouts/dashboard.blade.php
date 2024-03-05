<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('dashboard/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/base/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('dashboard/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('dashboard/images/favicon.png')}}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{asset('home')}}"><img
                        src="{{asset('dashboard/images/logo.svg')}}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{asset('home')}}"><img
                        src="{{asset('dashboard/images/logo-mini.svg')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search Projects.." aria-label="search"
                                aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown d-flex">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span>{{App\Models\Order::where('status', 0)->count()}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Orders</p>
                           
                            @forelse (App\Models\Order::where('status', 0)->get() as $order)
                            <form action="{{route('order.details')}}" method="GET">
                                @csrf
                                <button name="order_id" value="{{$order->id}}" class="dropdown-item preview-item bg-light" style="border-bottom: 1px solid #fff;">
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis text-danger font-weight-normal">{{$order->rel_to_customer->name}}
                                        </h6>
                                        <p class="font-weight-light small-text text-d mb-0">
                                            Left you an order
                                        </p>
                                    </div>
                                </button>
                            </form>
                            @empty
                            <p class="text-danger dropdown-item preview-item ">You hvae no order here!</p>
                            @endforelse

                        </div>
                    </li>
                    <li class="nav-item dropdown d-flex">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="icon-mail mx-0"></i>
                            <span>{{App\Models\Contact::where('status', 0)->count()}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                           
                            @forelse (App\Models\Contact::where('status', 0)->get() as $msg)
                            <form action="{{route('message.view')}}" method="GET">
                                @csrf
                                <button name="message_id" value="{{$msg->id}}" class="dropdown-item preview-item bg-light" style="border-bottom: 1px solid #fff;">
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis text-danger font-weight-normal">{{$msg->name}}
                                        </h6>
                                        <p class="font-weight-light small-text text-d mb-0">
                                            Left you a Message
                                        </p>
                                    </div>
                                </button>
                            </form>
                            @empty
                            <p class="text-danger dropdown-item preview-item ">You hvae no message here!</p>
                            @endforelse

                        </div>
                    </li>
                    <li class="nav-item dropdown d-flex">
                        <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                            id="messageDropdown" href="#" data-toggle="dropdown">
                            <i class="icon-head mx-0"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <a href="{{route('user.profile')}}" class="dropdown-item preview-item">Profile</a>
                            <a href="{{route('admin.logout')}}" class="dropdown-item preview-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="user-profile">
                    <div class="user-image user_img">
                        <a href="{{route('user.profile')}}">
                            @if (Auth::user()->photo == null)
                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64()}}" />
                            @else
                            <img src="{{asset('upload/user')}}/{{Auth::user()->photo}}" alt="">
                            @endif</a>
                    </div>
                    <div class="user-name">
                        {{Auth::user()->name}}
                    </div>
                    <div class="user-designation">
                        {{Auth::user()->email}}
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="icon-box menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">User</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('user')}}">User List</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#customer" aria-expanded="false"
                            aria-controls="customer">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">Customer</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="customer">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('customer')}}">Customer List</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#logo" aria-expanded="false"
                            aria-controls="logo">
                            <i class="icon-disc menu-icon"></i>
                            <span class="menu-title">Logo</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="logo">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('add.logo')}}">Add Logo</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#banner" aria-expanded="false"
                            aria-controls="banner">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Home</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="banner">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('banner')}}">Edit Banner
                                        Info</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('content1')}}">Edit Content-1
                                        Info</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('content2')}}">Edit Content-2
                                        Info</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('content3')}}">Edit Content-3
                                        Info</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#about" aria-expanded="false"
                            aria-controls="about">
                            <i class="icon-pie-graph menu-icon"></i>
                            <span class="menu-title">About</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="about">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('edit.about')}}">Edit About</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false"
                            aria-controls="product">
                            <i class="icon-bag menu-icon"></i>
                            <span class="menu-title">Product</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="product">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('seo.shop')}}">Shop SEO</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('add.product')}}">Add Product</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('all.product')}}">Product List</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('all.order')}}">Order List</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#message" aria-expanded="false"
                            aria-controls="message">
                            <i class="icon-mail menu-icon"></i>
                            <span class="menu-title">Message</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="message">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('message.list')}}">Message List</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#footer" aria-expanded="false"
                            aria-controls="footer">
                            <i class="icon-bar-graph-2 menu-icon"></i>
                            <span class="menu-title">Footer</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="footer">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{route('subscription')}}">Subscription</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('footer.info')}}">Edit Footer
                                        Info</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('social.icon')}}">Social
                                        Icon</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('sponsor.image')}}">Sponsors
                                        Image</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('edit.privacy')}}">Privacy
                                        Policy</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('edit.term')}}">Term &
                                        Condition</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#role" aria-expanded="false"
                            aria-controls="role">
                            <i class="icon-mail menu-icon"></i>
                            <span class="menu-title">Role</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="role">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('role')}}">Add Role</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            dominytech.com 2024</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a
                                href="https://www.dominytech.com/" target="_blank">Admin Dashboard</a> from
                            dominytech.com</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{asset('dashboard/vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{asset('dashboard/js/off-canvas.js')}}"></script>
    <script src="{{asset('dashboard/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('dashboard/js/template.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{asset('dashboard/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/select2/select2.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{asset('dashboard/js/file-upload.js')}}"></script>
    <script src="{{asset('dashboard/js/typeahead.js')}}"></script>
    <script src="{{asset('dashboard/js/select2.js')}}"></script>
    @yield('footer_script')
    <!-- End custom js for this page-->
</body>

</html>
