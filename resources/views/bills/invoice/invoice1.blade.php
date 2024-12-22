<!DOCTYPE html>
<html lang="en">
@php
$settings = App\Models\Utility::settings();

$logo=asset('storage/uploads/logo/');
$company_logo=App\Models\Utility::get_company_logo();
@endphp

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Invoice</title>

	<!-- Favicon -->
	<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

	<!-- Invoice styling -->
	<style>
		body {
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			text-align: center;
			color: #777;
		}

		body h1 {
			font-weight: 300;
			margin-bottom: 0px;
			padding-bottom: 0px;
			color: #000;
		}

		body h3 {
			font-weight: 300;
			margin-top: 10px;
			margin-bottom: 20px;
			font-style: italic;
			color: #555;
		}

		body a {
			color: #06f;
		}

		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
			border-collapse: collapse;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}
	</style>

</head>

<body>
	<div class="invoice-box">
		<table>
			<tbody>
				<tr class="top">
					<td colspan="6">
						<table>
							<tbody>
								<tr>
									<td class="title">
										<img src="{{ $logo .'/'. (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png').'?'.time() }}" style="height: 150px;">

									</td>
									<td>
										<img src="{{ $qrcode }}" alt="" width="150px">
									</td>

									<td align="right">
										Invoice No / رقم الفاتورة: {{ $bill->bill_number }} <br>
										Created: {{ date('M d, Y', strtotime($bill->reciept_date)) }}<br>
										Due: {{ date('M d, Y', strtotime($bill->due_date)) }}
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="6">
						<table>
							<tbody>
								<tr>
									<td>
										{{$company_name}}<br>
										{{ $branch->vat}}<br>
										{{ $branch->mobile}}<br>
										{{ $branch->street }} - {{ $branch->building_number	 }} <br>
										{{ $branch->distric }}  - {{ $branch->secondary_code	 }} 
										
									</td>

									<td>
										
										{{ App\Models\User::getUser($bill->bill_to)->name }}<br>
										{{ $customer_detail->mobile_number }} <br>
										{{ App\Models\User::getUser($bill->bill_to)->email }}
										
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>



				<tr class="heading">

					<th data-width="40" class="text-dark"> {{ __('#') }} </th>
					<th class="text-dark">{{ __('PARTICULARS') }}</th>
					<th class="text-dark">{{ __('NUMBERS') }}</th>
					<th class="text-dark">
						{{ __('RATE/UNIT COST') . '(' . $settings['site_currency'] . ')' }}
					</th>
					<th class="text-dark">{{ __('TAX') }} 15%</th>
					<th class="text-right text-dark" width="12%">{{ __('Amount') }}<br>

					</th>

				</tr>
				@php
					$befor_tax_amount = 0;
					$total_tax =0;
					$total_amount =0;

				@endphp
				@foreach ($items as $key => $item)
					@php 
						$tax = App\Models\Tax::getTax($item['tax'])->rate;
						$tax_amount = $item['cost'] * ($tax/100);
						$sub_total =   $item['cost'] + $tax_amount;
					@endphp
					<tr class="item">
						<td>{{ $key + 1 }}</td>
						<td style="text-align: center;">{{ $item['particulars'] }}</td>
						<td class="numbers">{{ $item['numbers'] }}</td>
						<td class="cost">{{ $item['cost'] }}</td>
						<td>
							{{ $tax_amount }}
						</td>
						<td class="amount">
							<b> {{ $sub_total }}</b>
						</td>
					</tr>

					@php
						$befor_tax_amount += $item['cost'];
						$total_tax +=$tax_amount;
						$total_amount +=$sub_total;
					@endphp
				@endforeach

			
				
			</tbody>
			<tfoot>
				<tr class="total">
						<td colspan="4"></td>

						<td colspan="2">Before Tax :  {{$befor_tax_amount}}</td>
				</tr>
				<tr class="total">
						<td colspan="4"></td>

						<td colspan="2">Tax Amount: {{$total_tax}}</td>
				</tr>
				<tr class="total">
						<td colspan="4"></td>

						<td colspan="2">Total: {{$total_amount}}</td>
				</tr>
			</tfoot>
		</table>

		<div class="card border rounded-0 card-body shadow-none p-0">
                    <div class="card-header">
                        <h5>{{ __('Payments') }}</h5>
                    </div>
                    <div class="card-body table-border-style pb-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> {{ __('Date') }} </th>
                                        <th> {{ __('Amount') }} </th>
                                        <th> {{ __('Payment Type') }} </th>
                                        <th> {{ __('Description') }} </th>
                                        <th> {{ __('Receipt') }} </th>
                                        <th> {{ __('Transaction ID') }} </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td> {{ $payment->date }} </td>
                                            <td> {{ $payment->amount }} </td>
                                            <td> {{ $payment->method }} </td>
                                            <td> {{ !empty($payment->description) ? $payment->description : ' --- ' }} </td>
                                            <td>{{ !empty($payment->receipt) ? $payment->receipt : ' --- ' }}</td>
                                            <td>{{ !empty($payment->transacrion_id) ? $payment->transacrion_id : ' --- ' }} </td>
                                        </tr>
                                    @endforeach
                                    @foreach ($bankPayments as $bankPayment)
                                        <tr>

                                            <td>{{ $bankPayment->date }}</td>
                                            <td class="text-right">
                                                {{ $bankPayment->amount }}</td>
                                            <td>{{ 'Bank Transfer' }}</td>
                                            <td>{{ !empty($bankPayment->notes) ? $bankPayment->notes : '-' }}</td>
                                            <td>
                                                <a href="{{ \App\Models\Utility::get_file($bankPayment->receipt) }}"
                                                    class="btn  btn-outline-primary btn-sm" target="_blank"><i
                                                        class="fas fa-file-invoice"></i>
                                                </a>
                                            </td>

                                            <td>{{ sprintf('%05d', $bankPayment->transaction_id) }}</td>
                                            <td>

                                                @if ($bankPayment->status == 'Pending')
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="#" data-size="lg"
                                                            data-url="{{ route('bankpayment.show', $bankPayment->id) }}"
                                                            data-bs-toggle="tooltip" title="{{ __('Details') }}"
                                                            data-ajax-popup="true"
                                                            data-title="{{ __('Payment Status') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-caret-right text-white"></i>
                                                        </a>
                                                    </div>
                                                @endif

                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
	</div>
</body>

</html>