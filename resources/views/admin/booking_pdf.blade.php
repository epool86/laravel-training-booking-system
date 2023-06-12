<html>

<head>
    <title>PDF</title>

    <style type="text/css">
        @page { margin: 50px 80px; }
        @font-face {
            font-family: 'RobotoMedium';
            src: url({{ storage_path('fonts\Roboto-Medium.ttf') }}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }
        @font-face {
            font-family: 'RobotoRegular';
            src: url({{ storage_path('fonts\Roboto-Regular.ttf') }}) format("truetype");
        }
        body, h1, h2, h3, h4, h5, h6, .bold {
            font-family: RobotoMedium;
        }
        td, span, pre {
            font-family: RobotoRegular;
            font-size: 12px;
        }
        .hr {
            border: none;
            height: 1px;
            color: #CCC;
            background-color: #CCC;
        }
        .header {
            border: 1px solid #3c856b; 
            background-color: #3c856b;
            color: #FFF;
        }
        pre {
            white-space: pre-wrap;
        }

        footer {
            position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
        }
        table {
            page-break-inside: avoid !important;
        }
        .pagenum:before {
            content: 'Page ' counter(page);
        }
        .page-break {
            page-break-after: always;
        }
        .border {
            border: 1px solid #999;
        }
    </style>

</head>

<body>
        
    <table cellpadding="5" cellspacing="0" style="width:100%">
        <tr>
            <th class="bold border">No</th>
            <th class="bold border">Date</th>
            <th class="bold border">Staff Name</th>
            <th class="bold border">Room Name</th>
            <th class="bold border">Time From</th>
            <th class="bold border">Time To</th>
            <th class="bold border">Pax</th>
            <th class="bold border">Remark</th>
            <th class="bold border">Status</th>
        </tr>

        @php($i = 0)
        @foreach($bookings as $booking)
        <tr>
            <td class="border">{{ ++$i }}</td>
            <td class="border">{{ $booking->date }}</td>
            <td class="border">{{ $booking->user->name }}</td>
            <td class="border">{{ $booking->room->name }}</td>
            <td class="border">{{ $booking->time_from }}</td>
            <td class="border">{{ $booking->time_to }}</td>
            <td class="border">{{ $booking->pax }}</td>
            <td class="border">{{ $booking->remark }}</td>
            <td class="border">
                @if($booking->status == 0)
                    <span style="color:orange;">Pending</span>
                @elseif($booking->status == 1)
                    <span style="color:green">Success</span>
                @else
                    <span style="color:red">Rejected</span>
                @endif
            </td>
        </tr>
        @endforeach

    </table>

</body>
</html>