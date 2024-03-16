<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{ route('domain') }}" class="navbar-brand"> COMP3975 Assignment2</a>
            <ul class="nav navbar-nav">
                <li><a href="{{ route('transactions.index') }}">transactions</a></li>
                <li><a href="{{ route('buckets.index') }}">buckets</a></li>
                <li><a href="{{ route('charts.index') }}">report</a></li>
                <li><a href="{{ route('admin') }}">admin</a></li>
            </ul>
        </div>
    </div>
</nav>
