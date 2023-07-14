@can('isAdmin')
      <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#presensi" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="presensi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('presensi') }}">
                <i class="bi bi-circle"></i><span>Data Presensi</span>
                </a>
            </li>
            <!-- <li>
                <a href="components-accordion.html">
                <i class="bi bi-circle"></i><span>Ajukan Izin</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="{{route('absen')}}">
                <i class="bi bi-circle"></i><span>Presensi</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="components-breadcrumbs.html">
                <i class="bi bi-circle"></i><span>Ajukan Presensi</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('jabatan.index')}}">
                <i class="bi bi-circle"></i><span>Jabatan</span>
                </a>
            </li>
            
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#keuangan" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Keuangan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="keuangan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('hutang.index')}}">
                <i class="bi bi-circle"></i><span>Hutang</span>
                </a>
            </li>
            <li>
                <a href="{{route('transport.index')}}">
                <i class="bi bi-circle"></i><span>Transport</span>
                </a>
            </li>
            <li>
                <a href="{{route('rembes.index')}}">
                <i class="bi bi-circle"></i><span>Rembes Nota</span>
                </a>
            </li>
            
            </ul>
        </li><!-- End Forms Nav -->


        

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#penggajian" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Penggajian</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="penggajian" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('/pengajuan-penggajian') }}">
                <i class="bi bi-circle"></i><span>Pengajuan Penggajian</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/data-penggajian') }}">
                <i class="bi bi-circle"></i><span>Data Penggajian</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/penggajian-approve') }}">
                <i class="bi bi-circle"></i><span>Penggajian Approve</span>
                </a>
            </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#akun" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Akun</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="akun" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/akun">
                <i class="bi bi-circle"></i><span>Data Akun</span>
                </a>
            </li>
            </ul>
        </li><!-- End Tables Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#karyawan" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="karyawan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/karyawan">
                <i class="bi bi-circle"></i><span>Data Karyawan</span>
                </a>
            </li>
            <!-- <li>
                <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Golongan</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="forms-editors.html">
                <i class="bi bi-circle"></i><span>Tampil Karyawan</span>
                </a>
            </li>    -->
            </ul>
        </li><!-- End Forms Nav -->

        </ul>
</aside><!-- End Sidebar-->
@endcan

@can('isKaryawan')
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#presensi" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="presensi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{route('absen')}}">
            <i class="bi bi-circle"></i><span>Presensi</span>
            </a>
        </li>
        <!-- <li>
            <a href="components-accordion.html">
            <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
        </li> -->
        <!-- <li>
            <a href="components-badges.html">
            <i class="bi bi-circle"></i><span>Badges</span>
            </a>
        </li>
        <li>
            <a href="components-breadcrumbs.html">
            <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
        </li> -->
        </ul>
    </li><!-- End Components Nav -->

    

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#penggajian" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Penggajian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="penggajian" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('/data-gaji-karyawan') }}">
                <i class="bi bi-circle"></i><span>Data Gaji</span>
                </a>
            </li>
            <!-- <li>
                <a href="tables-data.html">
                <i class="bi bi-circle"></i><span>Data Tables</span>
                </a>
            </li> -->
        </ul>
    </li>
    </ul>
</aside><!-- End Sidebar-->

@endcan

@can('isPimpinan')
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#presensi" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="presensi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="components-alerts.html">
            <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
        </li>
        <li>
            <a href="components-accordion.html">
            <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
        </li>
        <li>
            <a href="components-badges.html">
            <i class="bi bi-circle"></i><span>Badges</span>
            </a>
        </li>
        <li>
            <a href="components-breadcrumbs.html">
            <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
        </li>
        </ul>
    </li>End Components Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#penggajian" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Penggajian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="penggajian" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('/penggajian-approve') }}">
                <i class="bi bi-circle"></i><span>Penggajian Approve</span>
                </a>
            </li>
        </ul>
    </li><!-- End Tables Nav -->
    </ul>
</aside><!-- End Sidebar-->

@endcan

@can('isHrd')
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#presensi" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="presensi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('presensi') }}">
                <i class="bi bi-circle"></i><span>Data Presensi</span>
                </a>
            </li>
            <!-- <li>
                <a href="components-accordion.html">
                <i class="bi bi-circle"></i><span>Ajukan Izin</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="{{route('absen')}}">
                <i class="bi bi-circle"></i><span>Presensi</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="components-breadcrumbs.html">
                <i class="bi bi-circle"></i><span>Ajukan Presensi</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('jabatan.index')}}">
                <i class="bi bi-circle"></i><span>Jabatan</span>
                </a>
            </li>
            
            </ul>
        </li><!-- End Components Nav -->

    <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#karyawan" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="karyawan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/karyawan">
                <i class="bi bi-circle"></i><span>Data Karyawan</span>
                </a>
            </li>
            <!-- <li>
                <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Golongan</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="forms-editors.html">
                <i class="bi bi-circle"></i><span>Tampil Karyawan</span>
                </a>
            </li>    -->
            </ul>
        </li><!-- End Forms Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#penggajian" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Penggajian</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="penggajian" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
            <a href="{{ url('/data-penggajian') }}">
            <i class="bi bi-circle"></i><span>Data Penggajian</span>
            </a>
        </li>
        
            <li>
                <a href="{{ url('/penggajian-approve') }}">
                <i class="bi bi-circle"></i><span>Penggajian Approve</span>
                </a>
            </li>
            </ul>
        </li><!-- End Tables Nav -->
    </ul>
</aside><!-- End Sidebar-->

@endcan

@can('isManajer')
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="/dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#presensi" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Presensi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="presensi" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ url('presensi') }}">
                <i class="bi bi-circle"></i><span>Data Presensi</span>
                </a>
            </li>
            <!-- <li>
                <a href="components-accordion.html">
                <i class="bi bi-circle"></i><span>Ajukan Izin</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="{{route('absen')}}">
                <i class="bi bi-circle"></i><span>Presensi</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="components-breadcrumbs.html">
                <i class="bi bi-circle"></i><span>Ajukan Presensi</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('jabatan.index')}}">
                <i class="bi bi-circle"></i><span>Jabatan</span>
                </a>
            </li>
            
            </ul>
        </li><!-- End Components Nav -->

    <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#karyawan" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="karyawan" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/karyawan">
                <i class="bi bi-circle"></i><span>Data Karyawan</span>
                </a>
            </li>
            <!-- <li>
                <a href="forms-layouts.html">
                <i class="bi bi-circle"></i><span>Golongan</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="forms-editors.html">
                <i class="bi bi-circle"></i><span>Tampil Karyawan</span>
                </a>
            </li>    -->
            </ul>
        </li><!-- End Forms Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#penggajian" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Penggajian</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="penggajian" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
            <a href="{{ url('/data-penggajian') }}">
            <i class="bi bi-circle"></i><span>Data Penggajian</span>
            </a>
        </li>
        
            <li>
                <a href="{{ url('/penggajian-approve') }}">
                <i class="bi bi-circle"></i><span>Penggajian Approve</span>
                </a>
            </li>
            </ul>
        </li><!-- End Tables Nav -->
    </ul>
</aside><!-- End Sidebar-->

@endcan


