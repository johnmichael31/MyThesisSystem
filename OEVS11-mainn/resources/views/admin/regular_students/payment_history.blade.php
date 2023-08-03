@php
use Carbon\Carbon;
@endphp

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header">
                    
                    <h1>GESTAAC ONLINE ENROLMENT SYSTEM</h1>
                </div>
                @if($paymentHistories->isEmpty())
                    <p>No Pay History Transaction at The moment</p>
                @else
                    <table class="table" id="paymentHistoryTable">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Amount</th>
                                <th>Date Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentHistories as $paymentHistory)
                                <tr>
                                    <td>{{ $paymentHistory->payment->user->name }}</td>
                                    <td>₱ {{ $paymentHistory->amount }}</td>
                                    <td>{{ $paymentHistory->date_paid ? Carbon::parse($paymentHistory->date_paid)->format('F j, Y \a\t g:i A') : 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="card-footer clearfix"></div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<script>
    function printPaymentHistory() {
        const printWindow = window.open('', '_blank');
        printWindow.document.write('<style>');
        printWindow.document.write('@media print { body { margin: 0; } }');
        printWindow.document.write('h1 { text-align: center; margin-top: 20px; }');
        printWindow.document.write('table { margin: 20px auto; border-collapse: collapse; width: 100%; text-align: center; }');
        printWindow.document.write('th, td { border: 1px solid black; padding: 8px; }');
        printWindow.document.write('th { background-color: #f2f2f2; }');
        printWindow.document.write('.header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }');
        printWindow.document.write('.header img { height: 50px; }');
        printWindow.document.write('.header-title { font-size: 24px; font-weight: bold; }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="header">');
        printWindow.document.write('<img src="C:/xampp/htdocs/OEVS11-mainn/resources/views/admin/assessment/gestaac.png" alt="Left Logo">');
        printWindow.document.write('<h1 class="header-title">GESTAAC Inc. <br> Naguillan, La Union<br>Payments History</h1>');
        printWindow.document.write('<img src="path_to_right_logo.png" alt="Right Logo">');
        printWindow.document.write('</div>');
        printWindow.document.write('<table>');
        printWindow.document.write('<thead>');
        printWindow.document.write('<tr>');
        printWindow.document.write('</tr>');
        printWindow.document.write('</thead>');
        printWindow.document.write('<tbody>');
        printWindow.document.write(document.getElementById('paymentHistoryTable').innerHTML);
        printWindow.document.write('</tbody>');
        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
<button onclick="printPaymentHistory()" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer;">
    Print Payment History
</button>
<style>
    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 20px; /* Adjust the border radius as needed */
        cursor: pointer;
    }

    button:hover {
        border: 2px solid #4CAF50;
    }
</style>

</style>
