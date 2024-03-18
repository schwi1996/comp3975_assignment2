<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{ Auth::check() ? route('domain') : url('/') }}" class="navbar-brand">COMP3975 Assignment2</a>
            @if(Auth::check()) <!-- Check if any user is logged in -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('transactions.index') }}">Transactions</a></li>
                    <li><a href="{{ route('buckets.index') }}">Buckets</a></li>
                    <li><a href="{{ route('charts.index') }}">Report</a></li>
                    @if(Auth::user()->is_admin) <!-- Check if the logged-in user is an admin -->
                        <li><a href="{{ route('admin') }}">Admin</a></li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Display user name and logout button -->
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-log-out"></span> Logout
                    </a></li>
                </ul>
                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif
        </div>
    </div>
</nav>
