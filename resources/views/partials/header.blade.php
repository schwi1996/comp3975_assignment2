<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{ route('domain') }}" class="navbar-brand"> COMP3975 Assignment2</a>
            <ul class="nav navbar-nav">
                <li><a href="{{ route('transactions.index') }}">Transactions</a></li>
                <li><a href="{{ route('buckets.index') }}">Buckets</a></li>
                <li><a href="{{ route('charts.index') }}">Report</a></li>
                <li><a href="{{ route('admin') }}">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>
