@php
$content = content('transaction.content');
$recentTransactions = App\Models\Payment::with('user', 'gateway')
                                        ->latest()
                                        ->where('payment_status',1)
                                        ->limit(10)
                                        ->get();
$recentwithdraw = App\Models\Withdraw::with('user', 'withdrawMethod')
                                      ->latest()
                                      ->where('status',1)
                                      ->limit(10)
                                      ->get();
@endphp

  <section class="transaction-section sp_pt_100 sp_pb_100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
          <div class="sp_site_header  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
            <h2 class="sp_site_title">{{ __(@$content->data->title) }}</h2>
          </div>
        </div>
      </div>
      <div class="row gy-4">
        <div class="col-xl-6">
          <div class="transaction-wrapper">
            <h5 class="title mb-4">{{ __('Latest Invests') }}</h5>
            <table class="table site-table">
              <thead>
                <tr class="bg-yellow">
                  <th scope="col">{{ __('Username') }}</th>
                  <th scope="col">{{ __('Date') }}</th>
                  <th scope="col">{{ __('Amount') }}</th>
                  <th scope="col">{{ __('Gateway') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentTransactions as $item)
                  <tr>
                    <td data-caption="{{ __('Username') }}">{{ @$item->user->username }}</td>
                    <td data-caption="{{ __('Date') }}">
                      {{ $item->created_at->format('Y-m-d') }}</td>
                    <td data-caption="{{ __('Amount') }}">
                      {{ number_format($item->amount, 2) . ' ' . @$general->site_currency }}</td>
                    <td data-caption="{{ __('Gateway') }}">{{ @$item->gateway->gateway_name ?? 'Deposit' }}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td data-caption="{{ __('Status') }}" class="text-center" colspan="100%">
                      {{ __('No Data Found') }}
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="transaction-wrapper">
            <h5 class="title mb-4">{{ __('Latest Withdraws') }}</h5>
            <table class="table site-table">
              <thead>
                <tr class="bg-yellow">
                  <th scope="col">{{ __('Name') }}</th>
                  <th scope="col">{{ __('Date') }}</th>
                  <th scope="col">{{ __('Amount') }}</th>
                  <th scope="col">{{ __('Gateway') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentwithdraw as $item)
                  <tr>
                    <td data-caption="{{ __('Name') }}">{{ @$item->user->username }}</td>
                    <td data-caption="{{ __('Date') }}">
                      {{ $item->created_at->format('Y-m-d') }}</td>
                    <td data-caption="{{ __('Amount') }}">
                      {{ number_format($item->withdraw_amount, 2) . ' ' . @$general->site_currency }}
                    </td>
                    <td data-caption="{{ __('Gateway') }}">{{ $item->withdrawMethod->name }}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td data-caption="{{ __('Status') }}" class="text-center" colspan="100%">
                      {{ __('No Data Found') }}
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>