@extends('layouts.system')

@section('page_title')
Dashboard
@endsection

@section('top_script')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-header">Total Booking</div>
            <div class="card-body">
                <h2>{{ $total_booking }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-header">Total Pending</div>
            <div class="card-body">
                <h2>{{ $total_pending }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-header">Total Approve</div>
            <div class="card-body">
                <h2>{{ $total_approve }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-header">Total Reject</div>
            <div class="card-body">
                <h2>{{ $total_reject }}</h2>
            </div>
        </div>
    </div>
</div>

<br>

<div class="card">
    <div class="card-header">Graph</div>
    <div class="card-body">
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>

<script type="text/javascript">
    new Morris.Bar({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: [
        @foreach($rooms as $room)
        { name: '{{ $room->name }}', value: {{ $room->getTotalBooking() }}, },
        @endforeach
      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'name',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Value']
    });
</script>
@endsection

