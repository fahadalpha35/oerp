@extends('backend.layout.layout')

@push('css')
<style>
    /* Optional: Hide the print button when printing */
    @media print {
        #print-button {
            display: none;
        }
    }
</style>
@endpush


@section('content')
    <div class="content-wrapper">

         <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
          <div class="row">
             
              <div class="col-12">
                  <div class="card">          
                        <div class="card-body">

                    <!-- print section (start) -->
                    <div id="print-section">
                        <h3 align = "center">Balance Sheet Report</h3>
                        <br>
                        <h6><strong>Report Generation Date:</strong> {{ \Carbon\Carbon::now()->format('F j, Y') }}</h6>
                        <h6 >Reporting Year: <span style="color: blue">{{$year}}</span></h6>
                        <br>
                        <h4>Assets</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-right">Amount (BDT)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assets as $asset)
                                <tr>
                                    <td>{{$asset->account_name}}</td>
                                    <td class="text-right" id="">{{ number_format($asset->total_transaction_amount, 2) }}</td>
                                </tr>  
                                @endforeach
                               
                                <tr>
                                    <td>Total</td>
                                    <td class="text-right" id="">{{ number_format($total_asset_sum_amt, 2) }}</td>
                                </tr>
                
                                @if($total_asset_depriciation_sum_amt != '')
                                <tr>
                                    <td>Less : </td>
                                    <td class="text-right" id="">({{ number_format($total_asset_depriciation_sum_amt, 2) }})</td>
                                </tr>
                                @else
                                @endif
                
                                <tr class="total-row">
                                    <td>Net Total</td>
                                    <td class="text-right" id="">{{ number_format($net_total_asset_sum_amt, 2) }}</td>
                                </tr>
                
                            </tbody>
                        </table>
                <br>
                    
                        <h4>Liabilities</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="text-right">Amount (BDT)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liabilities as $liability)
                                <tr>
                                    <td>{{$liability->account_name}}</td>
                                    <td class="text-right" id="">{{ number_format($liability->total_transaction_amount, 2) }}</td>
                                </tr>  
                                @endforeach
                               
                                <tr>
                                    <td>Total</td>
                                    <td class="text-right" id="">{{ number_format($total_liability_sum_amt, 2) }}</td>
                                </tr>
                
                                @if($total_liability_depriciation_sum_amt != '')
                                <tr>
                                    <td>Less : </td>
                                    <td class="text-right" id="">({{ number_format($total_liability_depriciation_sum_amt, 2) }})</td>
                                </tr>
                                @else
                                @endif
                
                                <tr class="total-row">
                                    <td>Net Total</td>
                                    <td class="text-right" id="">{{ number_format($net_total_liability_sum_amt, 2) }}</td>
                                </tr>
                
                            </tbody>
                        </table>
                        <br>                    
                       <h4 style="color: blue">Equity</h4>
                       <table>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-right">Amount (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equities as $equity)
                            <tr>
                                <td>{{$equity->account_name}}</td>
                                <td class="text-right" id="">{{ number_format($equity->total_transaction_amount, 2) }}</td>
                            </tr>  
                            @endforeach
                           
                            <tr>
                                <td>Total</td>
                                <td class="text-right" id="">{{ number_format($total_equity_sum_amt, 2) }}</td>
                            </tr>
            
                            @if($total_equity_depriciation_sum_amt != '')
                            <tr>
                                <td>Less : </td>
                                <td class="text-right" id="">({{ number_format($total_equity_depriciation_sum_amt, 2) }})</td>
                            </tr>
                            @else
                            @endif
            
                            <tr class="total-row">
                                <td>Net Total</td>
                                <td class="text-right" id="">{{ number_format($net_total_equity_sum_amt, 2) }}</td>
                            </tr>
            
                        </tbody>
                    </table>
                    </div>
                    <!-- print section (end) -->
            <br>
                <!-- Print Button -->
                <button id="print-button" class="btn btn-danger float-right">Print Report</button>
                <br>
                        </div>
                      <!-- /.card-body -->
                    </div>
              </div>
          </div>
          <br>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    </div>
@endsection

@push('masterScripts')
<script>
$.noConflict(); // Ensures jQuery does not conflict with other libraries
jQuery(document).ready(function($) {
    $('.select2').select2();
})

document.addEventListener('DOMContentLoaded', function() {
  const yearPicker = document.getElementById('yearPicker');
  const currentYear = new Date().getFullYear();
  const startYear = 2000;  // Define the starting year
  const endYear = currentYear;  // You can adjust the end year if needed

  // Populate year dropdown
  for (let year = startYear; year <= endYear; year++) {
    const option = document.createElement('option');
    option.value = year;
    option.text = year;
    yearPicker.appendChild(option);
  }

  // Pre-select current year
  yearPicker.value = currentYear;

  yearPicker.addEventListener('change', function() {
    const selectedYear = yearPicker.value;
    console.log('Selected year:', selectedYear);
    // Perform actions based on the selected year
  });
});



$('#search').on('click',function(){

var $selectedYear = $('#yearPicker').val();
var $selectedMonth = $('#monthPicker').val();

// Function to get CSRF token from meta tag
function getCsrfToken() {
return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
axios.post('/api/account_profit_and_loss_report_result',{
        year: $selectedYear,
        month: $selectedMonth
    }).then(response=>{
        console.log(response.data);
        $('#total_sale').html(response.data.total_sale.toFixed(2));
        $('#total_due').html(response.data.total_customer_due.toFixed(2));
        $('#total_purchase_paid').html(response.data.total_purchase_paid.toFixed(2))
        $('#total_purchase_due').html(response.data.total_purchase_due.toFixed(2))
        $('#total_purchase').html(response.data.total_purchase.toFixed(2));
        $('#total_daily_expense').html(response.data.total_daily_expense.toFixed(2));
        $('#total_monthly_other_expense').html(response.data.total_monthly_other_expense.toFixed(2));
        $('#total_yearly_expense').html(response.data.total_yearly_expense.toFixed(2));
        $('#total_rent').html(response.data.total_rent.toFixed(2));
        $('#total_utility').html(response.data.total_utility.toFixed(2));
        $('#total_salary').html(response.data.total_salary.toFixed(2));
        $('#total_damaged_product_value').html(response.data.total_damaged_product_value.toFixed(2));

        /// Total revenue calculation start
        var total_sale = parseFloat(response.data.total_sale); // Ensure it's a number
        var total_due = parseFloat(response.data.total_customer_due); // Ensure it's a number
        var total_revenue = total_sale + total_due;
        // var total_revenue = total_sale;
        $('#total_revenue').html(total_revenue.toFixed(2));
        // Total revenue calculation end

        // Total COGS calculation start
        var total_cogs = parseFloat(response.data.total_purchase_paid); // Ensure it's a number
        $('#total_cogs').html(total_cogs.toFixed(2));
        // Total COGS calculation end

        // Gross profit calculation start
        var gross_profit = total_revenue - total_cogs;
        $('#gross_profit').html(gross_profit.toFixed(2));
        // Gross profit calculation end

        //total expense calculation start
        var total_daily_expense = parseFloat(response.data.total_daily_expense);
        var total_monthly_other_expense = parseFloat(response.data.total_monthly_other_expense);
        var total_yearly_expense = parseFloat(response.data.total_yearly_expense);
        var rent = parseFloat(response.data.total_rent);
        var utility = parseFloat(response.data.total_utility);
        var salary = parseFloat(response.data.total_salary);
        var damage_or_burn = parseFloat(response.data.total_damaged_product_value);

        var total_expense = total_daily_expense+total_monthly_other_expense+total_yearly_expense+rent+utility+salary+damage_or_burn;
        $('#total_expense').html(total_expense.toFixed(2));
        //total expense calculation end

        //net profit and net loss calculation start
        if(total_expense > gross_profit){
            var net_loss = total_expense - gross_profit;
            $('#net_loss').html(net_loss.toFixed(2));
        }else{
            var net_profit = gross_profit - total_expense;
            $('#net_profit').html(net_profit.toFixed(2));
        }
        //net profit and net loss calculation end

    });
});

})


$('#refresh').on('click',function(){
window.location.reload(true);
})


$('#print-button').click(function(){
// Trigger print for the specified section
var printContents = $('#print-section').html();
var originalContents = $('body').html();

$('body').html(printContents);
window.print();
$('body').html(originalContents);
});


</script>
@endpush
