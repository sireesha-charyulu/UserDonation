<table class="table table-bordered bg-light">
    <thead class="bg-dark" style="color: white">
    <tr>
        <th width="60px" style="vertical-align: middle;text-align: center">No</th>
        <th style="vertical-align: middle">Charity Name</th>
        <th style="vertical-align: middle">User ID</th>
        <th style="vertical-align: middle">Amount</th>
        <th style="vertical-align: middle">Donation Date</th>
    </tr>
    </thead>
    <tbody>
    @php
        $i=1;
    @endphp
    @foreach($donations as $donation)
        <tr>
            <th style="vertical-align: middle;text-align: center">{{$i++}}</th>
            <td style="vertical-align: middle">{{ $donation->charity_name }}</td>
            <td style="vertical-align: middle">{{ $donation->user_name }}</td>
            <td style="vertical-align: middle">{{$donation->amount}}</td>
            <td style="vertical-align: middle">{{$donation->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
