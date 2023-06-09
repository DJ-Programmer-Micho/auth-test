<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('logo/met_pwa.png')}}" width="60" alt="metiraq">
        </div>
        <div class="sidebar-brand-text mx-3">MET IRAQ <sup>auth</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Home Slider</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{route('home.index')}}">Index</a>
                <a class="collapse-item" href="{{route('home.create')}}">Create</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="#">Colors</a>
                <a class="collapse-item" href="#">Borders</a>
                <a class="collapse-item" href="#">Animations</a>
                <a class="collapse-item" href="#">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Components
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#homeSlider"
            aria-expanded="true" aria-controls="homeSlider">
            <i class="fas fa-fw fa-cog"></i>
            <span>Home Slider</span>
        </a>
        <div id="homeSlider" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Home Slider Comp.:</h6>
                <a class="collapse-item" href="{{route('home.index')}}">Index</a>
                <a class="collapse-item" href="{{route('home.create')}}">Create</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#facts"
            aria-expanded="true" aria-controls="facts">
            <i class="fas fa-fw fa-cog"></i>
            <span>Facts</span>
        </a>
        <div id="facts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Fact Comp.:</h6>
                <a class="collapse-item" href="{{route('fact.index')}}">Index</a>
                <a class="collapse-item" href="{{route('fact.create')}}">Create</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#aboutus"
            aria-expanded="true" aria-controls="aboutus">
            <i class="fas fa-fw fa-cog"></i>
            <span>About Us</span>
        </a>
        <div id="aboutus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">About Us Comp.:</h6>
                <a class="collapse-item" href="{{route('about.index')}}">Index</a>
                <a class="collapse-item" href="{{route('about.create')}}">Create</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#whychooseus"
            aria-expanded="true" aria-controls="whychooseus">
            <i class="fas fa-fw fa-cog"></i>
            <span>Why Choose Us</span>
        </a>
        <div id="whychooseus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Why Choose Us Comp.:</h6>
                <a class="collapse-item" href="{{route('wcu.index')}}">Index</a>
                <a class="collapse-item" href="{{route('wcu.create')}}">Create</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#service"
            aria-expanded="true" aria-controls="service">
            <i class="fas fa-fw fa-cog"></i>
            <span>Services</span>
        </a>
        <div id="service" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Services Comp.:</h6>
                <a class="collapse-item" href="{{route('service.index')}}">Index</a>
                <a class="collapse-item" href="{{route('service.create')}}">Create</a>
                {{-- <a class="collapse-item" href="{{route('serice.create')}}">Create</a> --}}
                <a class="collapse-item" href="{{route('service.preview')}}">Preview</a>
                <a class="collapse-item" href="{{route('service.info')}}">Information</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pricing"
            aria-expanded="true" aria-controls="pricing">
            <i class="fas fa-fw fa-cog"></i>
            <span>Price</span>
        </a>
        <div id="pricing" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pricing Comp.:</h6>
                <a class="collapse-item" href="{{route('price.index')}}">Index</a>
                <a class="collapse-item" href="{{route('price.create')}}">Create</a>
                <a class="collapse-item" href="{{route('price.preview')}}">Preview</a>
                <a class="collapse-item" href="{{route('price.info')}}">Information</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Home page:</h6>
                <a class="collapse-item" href="{{route('fact.create')}}">Facts Page</a>
                <a class="collapse-item" href="{{route('about.create')}}">About Page</a>
                <h6 class="collapse-header">Other:</h6>
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="#">Login</a>
                <a class="collapse-item" href="#">Register</a>
                <a class="collapse-item" href="#">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="#">404 Page</a>
                <a class="collapse-item" href="#">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{asset('admin/assets/img/undraw_rocket.svg')}}" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>