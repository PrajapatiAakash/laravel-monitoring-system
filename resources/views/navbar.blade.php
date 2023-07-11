<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(request()->route()->getName() == 'monitoring-system.dashboard') active @endif" aria-current="page" href="{{ route('monitoring-system.dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(str_contains(request()->route()->getName(), 'request-logs')) active @endif" href="{{ route('request-logs.index') }}">
                    <span data-feather="git-pull-request"></span>
                    Request Logs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(str_contains(request()->route()->getName(), 'error-logs')) active @endif" href="{{ route('error-logs.index') }}">
                    <span data-feather="file-text"></span>
                    Error Logs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(str_contains(request()->route()->getName(), 'query-logs')) active @endif" href="{{ route('query-logs.index') }}">
                    <span data-feather="database"></span>
                    Query Logs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">
                    <span data-feather="server"></span>
                    Server Monitoring
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
            </li>
        </ul>
    </div>
</nav>
