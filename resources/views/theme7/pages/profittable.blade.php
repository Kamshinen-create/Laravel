<table id="profit-table" class="table site-table w-100">
    <tr>
        <td>{{ __('Plan') }}</td>
        <td>{{ __($plan->plan_name) }}</td>
    </tr>
    <tr>
        <td>{{ __('Amount') }}</td>
        <td>{{ $amount . ' ' . @$general->site_currency }}</td>
    </tr>
    <tr>
        <td>{{ __('Payout Period') }}</td>
        <td>

            @if ($plan->return_for == 1)
                {{ __('Every') }} {{ __($plan->time->name) }} {{ __('For') }} {{ __($plan->how_many_time) }}
                {{ __($plan->time->name) }}
            @else
                {{ __('Every') }} {{ __($plan->time->name) }} {{ __('Lifetime') }}
            @endif

        </td>
    </tr>
    <tr>
        <td>{{ __('Profit') }}</td>
        <td>{{ $calculate . ' ' . @$general->site_currency }}</td>
    </tr>
    <tr>
        <td>{{ __('Capital back') }}</td>
        <td>
            @if ($plan->capital_back == 1)
                {{ __('Capital Back') }} {{ __('YES') }}
            @else
                {{ __('Capital Back') }} {{ __('NO') }}
            @endif
        </td>
    </tr>
    <tr>
        <td>{{ __('Total') }}</td>
        <td>
            @if ($plan->return_for == 1)
                {{ __($calculate * $plan->how_many_time) }} + {{ __($plan->capital_back == 1 ? $amount : '0') }}
                {{ @$general->site_currency }}
            @else
                {{ __($calculate) }} {{ @$general->site_currency }}
            @endif

        </td>
    </tr>
</table>
</div>
<div class="modal-footer pb-0 pe-0">
    <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
    <a href="{{ route('user.gateways', $plan->id) }}" type="button" class="btn btn-md main-btn"><span>{{ __('Invest') }}</span></a>
</div>

@push('style')
    <style>
        #calculationModal .modal-footer {
            margin: 0 -15px;
        }
    </style>
@endpush