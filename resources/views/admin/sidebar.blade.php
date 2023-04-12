<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin') ? '' : 'collapsed' }}" href="{{ route('admin') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/employee*') ? '' : 'collapsed' }}" href="{{ route('admin.employee') }}">
                <i class="bi bi-person"></i>
                <span>Employee</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/testimonial*') ? '' : 'collapsed' }}" href="{{ route('admin.testimonial') }}">
                <i class="bi bi-chat-dots"></i>
                <span>Testimonial</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->