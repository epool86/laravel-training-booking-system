@extends('layouts.system')

@section('content')
<div class="card">

    <div class="card-header">List of Rooms</div>

    <div class="card-body">

        <a href="{{ route('app.admin.room.create') }}" class="btn btn-primary">Create Room</a>
        
        <table class="table">
            <tr>
                <th>No</th>
                <th>Room Name</th>
                <th>Capacity</th>
                <th>Facility</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @php($i = 0)
            @foreach($rooms as $room)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->capacity }}</td>
                <td>{{ $room->facility }}</td>
                <td>
                    @if($room->photo)
                    <img src="{{ asset('uploads/rooms/'.$room->photo) }}" style="width:100px;">
                    @endif
                </td>
                <td>
                    @if($room->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <table><tr><td>
                    <form action="{{ route('app.admin.room.destroy', $room->id) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    </td><td>
                    <a href="{{ route('app.admin.room.edit', $room->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td></tr></table>
                </td>
            </tr>
            @endforeach

        </table>
        
    </div>
</div>
@endsection