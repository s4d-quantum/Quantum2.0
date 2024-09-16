<header class="main-header">
    <nav class="navbar navbar-static-top">
        <a href="{{ url('/') }}" class="logo">
            <span class="logo-mini">{{ $company_info->company_title ?? 'Quantum' }}</span>
            <span class="logo-lg">{{ $company_info->company_title ?? 'Quantum' }}</span>
        </a>
        <ul class="nav navbar-nav pull-right">
            <li>
                <a href="javascript:void(0);">
                    {{ $user->user_name }}
                    @if($user->user_role == 'admin')
                        <span style="color:lightgreen;">(Admin)</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img style="filter:invert(1); width:21px;" src="{{ asset('assets/img/logout.png') }}" />
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</header>
