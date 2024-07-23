<ul class="list-group">
    <li class="list-group-item {{ Route::is('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="text-decoration-none {{ Route::is('home') ? 'text-light' : '' }}">Home</a>
    </li>
    <li class="list-group-item {{ Route::is('admissions.*') ? 'active' : '' }}">
        <a href="{{ route('admissions.index') }}" class="text-decoration-none {{ Route::is('admissions.*') ? 'text-light' : '' }}">Admissions</a>
    </li>
    <li class="list-group-item {{ Route::is('attendance-sessions.*') ? 'active' : '' }}">
        <a href="{{ route('attendance-sessions.index') }}" class="text-decoration-none {{ Route::is('attendance-sessions.*') ? 'text-light' : '' }}">Attendances</a>
    </li>
    <li class="list-group-item {{ Route::is('mess-fees.*') ? 'active' : '' }}">
        <a href="{{ route('mess-fees.index') }}" class="text-decoration-none {{ Route::is('mess-fees.*') ? 'text-light' : '' }}">Mess Fees</a>
    </li>
    <li class="list-group-item {{ Route::is('repositories.*') ? 'active' : '' }}">
        <a href="{{ route('repositories.index') }}" class="text-decoration-none {{ Route::is('repositories.*') ? 'text-light' : '' }}">Repository</a>
    </li>
</ul>