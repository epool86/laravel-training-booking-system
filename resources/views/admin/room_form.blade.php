@extends('layouts.system')

@section('content')
<div class="card">

    <div class="card-header">Room Details</div>

    <div class="card-body">

        @if($room->id) 
            <form action="{{ route('app.admin.room.update', $room->id) }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
        @else
            <form action="{{ route('app.admin.room.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="POST">
        @endif

        @csrf
        <table class="table">
            <tr>
                <th>Room Name</th>
                <td>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $room->name) }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Capacity</th>
                <td>
                    <input type="text" class="form-control" name="capacity" value="{{ old('capacity', $room->capacity) }}">
                    @error('capacity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Facility</th>
                <td>
                    <?php 
                    $facilities = $room->facility ? json_decode($room->facility) : [];
                    ?>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="facility[]" value="Projektor" @if(in_array('Projektor', $facilities)) checked @endif></td>
                            <td>Projektor</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="facility[]" value="TV" @if(in_array('TV', $facilities)) checked @endif></td>
                            <td>TV</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="facility[]" value="Whiteboard" @if(in_array('Whiteboard', $facilities)) checked @endif></td>
                            <td>Whiteboard</td>
                        </tr>
                    </table>
                    @error('facility')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <select class="form-control" name="status">
                        <option value="1" @if(old('status', $room->status) == '1') selected @endif>Active</option>
                        <option value="0" @if(old('status', $room->status) == '0') selected @endif>Inactive</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
        </table>

        <a href="{{ route('app.admin.room.index') }}" class="btn btn-info">Cancel</a>
        <button type="submit" class="btn btn-primary">Save</button>

        </form>
        
    </div>
</div>
@endsection