<ul class="sidebar-menu">
    <li class="menu-header">Tiket</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-file-alt"></i>
            <span>Data</span></a>
        <ul class="dropdown-menu">
            @if (auth()->user()->role == 'admin')
                <li>
                    <a class="nav-link" href="{{ route('acaras.index') }}">Acara</a>
                </li>
            @endif
            <li>
                <a class="nav-link" href="{{ route('user.tickets.index') }}">Tiket</a>
            </li>
        </ul>
    </li>
    <li class="menu-header">Penarikan Dana</li>
    <li>
        <a class="nav-link" href="{{ route('withdrawal.index') }}"><i class='far fa-calendar-alt'></i><span>Ajukan
                Penarikan Dana</span></a>
    </li>
    @if (auth()->user()->role == 'admin')
        <li>
            <a class="nav-link" href="{{ route('withdrawal.admin') }}"><i class='far fa-calendar-alt'></i><span>Data
                    Penarikan Dana</span></a>
        </li>

        <li class="menu-header">Penjualan</li>
        <li>
            <a class="nav-link" href="{{ route('admin.acaras.index') }}"><i
                    class='far fa-calendar-alt'></i><span>Acara</span></a>
        </li>
    @endif
</ul>
