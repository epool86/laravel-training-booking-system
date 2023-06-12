<a href="{{ route('app.admin.dashboard') }}" class="btn btn-primary w-100 mb-1">Dashboard</a>
<a href="{{ route('app.admin.booking.index') }}" class="btn btn-primary w-100 mb-1">Manage Booking</a>
<a href="{{ route('app.admin.room.index') }}" class="btn btn-primary w-100 mb-1">Manage Room</a>
<a href="{{ route('app.admin.user.index') }}" class="btn btn-primary w-100 mb-1">Manage User</a>
<a href="{{ route('app.admin.logs') }}" class="btn btn-primary w-100 mb-1">View Error Log</a>
<button class="btn btn-danger w-100 mb-1" 
onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>