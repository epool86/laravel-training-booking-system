@extends('layouts.system')

@section('page_title')
Manage Booking
@endsection

@section('content')
<div class="card">

    <div class="card-header">List of All Bookings</div>

    <div class="card-body">

        <table>
            <tr>
                <td><input type="text" class="form-control" name="search" id="search" value="{{ $search }}" placeholder="staff name"></td>
                <td><input type="text" class="form-control" name="search2" id="search2" value="{{ $search2 }}" placeholder="room name"></td>
                <td><button type="button" class="btn btn-primary" name="" onclick="search()">Search</button></td>
                <td><a href="{{ route('app.admin.booking.pdf') }}" class="btn btn-secondary" name="">Download PDF</a></td>
            </tr>
        </table>

        
        
        <table class="table">
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Staff Name</th>
                <th>Room Name</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Pax</th>
                <th>Remark</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @php($i = 0)
            @foreach($bookings as $booking)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->room->name }}</td>
                <td>{{ $booking->time_from }}</td>
                <td>{{ $booking->time_to }}</td>
                <td>{{ $booking->pax }}</td>
                <td>{{ $booking->remark }}</td>
                <td>
                    @if($booking->status == 0)
                        <span class="badge bg-warning">Pending</span>
                    @elseif($booking->status == 1)
                        <span class="badge bg-success">Success</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('app.admin.booking.update', $booking->id) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
        
    </div>
</div>

<script type="text/javascript">
    
    function search(){

        var search = document.getElementById('search').value;
        var search2 = document.getElementById('search2').value;
        self.location = '{{ route('app.admin.booking.index') }}?search='+search+'&search2='+search2;

    }

</script>
@endsection