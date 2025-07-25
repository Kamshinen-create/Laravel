@extends(template().'layout.master')

@section('content')

    <section class="page-banner">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="title">{{ __($pageTitle) }}</h2>
                <ul class="page-breadcrumb justify-content-center mt-2">
                    <li><a href="index.html">{{ __('Home') }}</a></li>
                    <li>{{ __($pageTitle) }}</li>
                </ul>
            </div>
            </div>
        </div>
    </section>

    <section class="plan-section sp_pt_100 sp_pb_100 sp_separator_bg">
        <div class="container">
            <div class="row gy-5 items-wrapper justify-content-center">
                @forelse ($plans as $plan)
                @php
                $plan_exist = App\Models\Payment::where('plan_id', $plan->id)
                ->where('user_id', Auth::id())
                ->where('next_payment_date', '!=', null)
                ->where('payment_status', 1)
                ->count();
                @endphp

                <div class="col-xl-4 col-md-6">
                    <div class="plan-item">
                        <div class="plan-top">
                            <h3 class="plan-name">{{ $plan->plan_name }}</h3>
                        </div>
                        <div class="plan-price-area">
                            <p class="plan-amount">
                                {{ number_format($plan->return_interest, 2) }} @if ($plan->interest_status == 'percentage')
                                {{ '%' }}
                                @else
                                {{ @$general->site_currency }}
                                @endif
                            </p>

                            <span class="details">/ {{ __('Every') }} {{ $plan->time->name }}</span>
                        </div>

                        <div class="plan-body">
                            <ul class="plan-feature-list">
                                @if ($plan->amount_type == 0)
                                    <li>
                                        <span class="caption"> {{ __('Minimum') }} </span>
                                        <span class="details"> {{ number_format($plan->minimum_amount, 2) . ' ' . @$general->site_currency }}</span>
                                    </li>
                                    <li>
                                        <span class="caption"> {{ __('Maximum') }} </span>
                                        <span class="details"> {{ number_format($plan->maximum_amount, 2) . ' ' . @$general->site_currency }}</span>
                                    </li>
                                @else
                                <li>
                                    <span class="caption"> {{ __('Amount') }} </span>
                                    <span class="details"> {{ number_format($plan->amount, 2) . ' ' . @$general->site_currency }}</span>
                                </li>
                                @endif

                                @if ($plan->return_for == 1)
                                <li>
                                    {{ __('For') }}
                                    {{ $plan->how_many_time }} {{ __('Times') }}
                                </li>
                                @else
                                <li>
                                    {{ __('For') }}
                                    {{ __('Lifetime') }}
                                </li>
                                @endif
                                
                                @if ($plan->capital_back == 1)
                                <li>
                                    {{ __('Capital Back') }}
                                    {{ __('YES') }}
                                </li>
                                @else
                                <li>
                                    {{ __('Capital Back') }}
                                    {{ __('NO') }}
                                </li>
                                @endif
                            </ul>

                            <div class="view-affiliate-wrapper my-4">
                                <p>{{ __('Affiliate Bonus') }}</p>
                                <button type="button" class="view-affiliate-btn">{{ __('View all') }}</button>
                                <div class="plan-referral-area">
                                    <div class="plan-referral pt-3">
                                        <button type="button" class="plan-referral-area-close"><i class="fas fa-times"></i></button>
                                        <h6 class="text-center mb-4">{{ __('Affiliate Bonus') }}</h6>
                                        @if($plan->referrals)
                                            @foreach ($plan->referrals->level as $key => $value)
                                                <div class="single-referral">
                                                    <p>{{$value}}</p>
                                                    <span>{{$plan->referrals->commision[$key]}} %</span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="plan-action">
                                @if ($plan_exist >= $plan->invest_limit)
                                <a class="btn btn-md main-btn plan-btn w-100 disabled" href="#">
                                    <span>{{ __('Max Limit exceeded') }}</span>
                                </a>
                                @else
                                <a class="btn btn-md main-btn plan-btn w-100" href="{{ route('user.gateways', $plan->id) }}">
                                    <span>{{ __('Invest Now') }}</span>
                                </a>
                                @auth
                                <button class="btn btn-md main-btn2 balance w-100 mt-2 justify-content-center" data-plan="{{ $plan }}" data-url=""><span>{{ __('Invest Using Balance') }}</span></button>
                                @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>

    <div class="modal fade" id="invest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('user.investmentplan.submit')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Invest Now')}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="">{{ __('Invest Amount') }}</label>
                            <input type="text" name="amount" class="form-control">
                            <input type="hidden" name="plan_id" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-sm main-btn"><span>{{__('Invest Now')}}</span></button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.balance').on('click', function() {
                const modal = $('#invest');
                modal.find('input[name=plan_id]').val($(this).data('plan').id);
                modal.modal('show')
            })

            $(".view-affiliate-btn").on("click", function(){
                $(this).siblings(".plan-referral-area").addClass("active");
            });

            $(".plan-referral-area-close").on("click", function(){
                $(this).parent(".plan-referral").parent(".plan-referral-area").removeClass("active");
            });
        })
    </script>
@endpush