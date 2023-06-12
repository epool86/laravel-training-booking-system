@extends('layouts.system_user')

@section('content')
<div class="card">

    <div class="card-header">List of My Bookings</div>

    <div class="card-body">

        <a href="{{ route('app.booking.create') }}" class="btn btn-primary">Create New Booking</a>
        
        <table class="table">
            <tr>
                <th>No</th>
                <th>Date</th>
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
                    @if($booking->status == 0)
                    <form action="{{ route('app.booking.destroy', $booking->id) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('app.booking.edit', $booking->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    @endif
                </td>
            </tr>
            @endforeach

        </table>
        
    </div>
</div>
@endsection