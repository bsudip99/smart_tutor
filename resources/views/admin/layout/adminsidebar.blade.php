  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
      <img src="{{ asset('storage/admin/dist/img/AdminLTELogo.png') }}" alt="SmartTutor Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SmartTutor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
          <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active': ''}}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Dashboard
                </p>
            </a>
            </li>
            <li class="nav-item {{ request()->is('admin/tutorLists') || request()->is('admin/tutorAdd')? 'menu-is-opening menu-open': '' }}">
              <a href="#" class="nav-link {{ request()->is('admin/tutorLists') || request()->is('admin/tutorAdd') ? 'active': '' }} ">
              <i class="nav-icon fas fa-circle nav-icon"></i>
              <p>
                Tutors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/tutorLists" class="nav-link {{ request()->is('admin/tutorLists') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tutors List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/tutorAdd" class="nav-link {{ request()->is('admin/tutorAdd') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Tutor</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/studentLists') || request()->is('admin/studentAdd')? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/studentLists') || request()->is('admin/studentAdd') ? 'active': '' }} ">
              <i class="nav-icon fas fa-circle nav-icon"></i>
              <p>
                Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/studentLists" class="nav-link {{ request()->is('admin/studentLists') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Lists</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/studentAdd" class="nav-link {{ request()->is('admin/studentAdd') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/requestLists') || request()->is('admin/requestAdd')? 'menu-is-opening menu-open': '' }}">
            <a href="#" class="nav-link {{ request()->is('admin/requestLists') || request()->is('admin/requestAdd') ? 'active': '' }} ">
              <i class="nav-icon fas fa-circle nav-icon"></i>
              <p>
                Requests
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/requestLists" class="nav-link {{ request()->is('admin/requestLists') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request Lists</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/requestAdd" class="nav-link {{ request()->is('admin/requestAdd') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Request</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/subjectLists') || request()->is('admin/subjectAdd')? 'menu-is-opening menu-open': '' }} ">
            <a href="#" class="nav-link {{ request()->is('admin/subjectLists') || request()->is('admin/subjectAdd') ? 'active': '' }}  ">
              <i class="nav-icon fas fa-circle nav-icon"></i>
              <p>
                Subjects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/subjectLists" class="nav-link {{ request()->is('admin/subjectLists') ? 'active': '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/subjectAdd" class="nav-link {{ request()->is('admin/subjectAdd') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Subject</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item {{ request()->is('admin/classLists') || request()->is('admin/classAdd')? 'menu-is-opening menu-open': '' }} ">
            <a href="#" class="nav-link {{ request()->is('admin/classLists') || request()->is('admin/classAdd') ? 'active': '' }}  ">
              <i class="nav-icon fas fa-circle nav-icon"></i>
              <p>
                Classes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/classLists" class="nav-link {{ request()->is('admin/classLists') ? 'active': '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/classAdd" class="nav-link {{ request()->is('admin/classAdd') ? 'active': ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Class</p>
                </a>
              </li>
             
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- End header  -->
  @if (Session::get('success'))
  <div class="alert alert-success text-center">
      {{Session::get('success')}}
  </div>
@endif

@if (Session::get('fail'))
<div class="alert alert-danger text-center">
  {{Session::get('fail')}}
</div>
@endif