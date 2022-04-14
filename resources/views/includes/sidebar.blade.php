<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <div>
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              История заказов
            </p>
          </a>
        </div>

        <div style="margin-left: 7px;">
          <a href="{{ route('logout') }}" class="nav-link">
            <!--<i class="nav-icon fas fa-table"></i>-->
            <i class="fas fa-sign-out-alt"></i>
            
            <p style="margin-left: 6px;">
              Выход из системы
            </p>
          </a>
        </div>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->