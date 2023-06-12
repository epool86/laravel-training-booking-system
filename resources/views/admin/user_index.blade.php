@extends('layouts.system')

@section('content')
<div class="card">

    <div class="card-header">List of Users</div>

    <div class="card-body">

        <table>
            <tr>
                <td><a href="{{ route('app.admin.user.create') }}" class="btn btn-primary">Create User</a></td>
                <td><input type="text" class="form-control" name="search" id="search" value="{{ $search }}"></td>
                <td><button type="button" class="btn btn-primary" name="" onclick="search()">Search</button></td>
            </tr>
        </table>
        
        <table class="table">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Staff ID</th>
                <th>Department</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

            @php($i = 0)
            @foreach($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->staff_id }}</td>
                <td>{{ $user->department }}</td>
                <td>
                    @if($user->role == 'user')
                        <span class="badge bg-success">User</span>
                    @else
                        <span class="badge bg-danger">Admnin</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('app.admin.user.destroy', $user->id) }}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <a href="{{ route('app.admin.user.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach

        </table>

        {!! $users->appends($_GET)->render() !!}
        
    </div>
</div>

<script type="text/javascript">
    
    function search(){

        var search = document.getElementById('search').value;
        self.location = '{{ route('app.admin.user.index') }}?search='+search;

    }

</script>
@endsection