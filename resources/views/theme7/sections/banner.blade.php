@php
$content = content('banner.content');
$counter = element('banner.element');
@endphp
    <section class="banner-section">
        <img src="{{ getFile('banner', 'partner-bg.png') }}" alt="image" class="banner-layer">
    
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-5"> 
                    <div class="banner-content">
                        <h2 class="banner-title wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">{{ __(@$content->data->title) }}</h2>
                        <p class="banner-description mt-3 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.5s">{{ __(@$content->data->short_description) }}</p>
                        <div class="mt-4 wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.7s">
                            <a href="{{ @$content->data->button_text_link }}" class="btn main-btn me-3">
                                <span>{{ __('Get Started') }}</span>
                            </a>
                            <a href="{{ $content->data->button_text_2_link}}" class="btn main-btn2">
                                <span>{{ __('Know More') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-5">
                    <div class="banner-thumb">
                        <img src="{{ getFile('banner', @$content->data->backgroundimage) }}" alt="image" class="banner-thumb-main">

                        <img src="{{ getFile('banner', 'coin-1.png') }}" alt="image" class="banner-coin coin-1">
                        <img src="{{ getFile('banner', 'coin-2.png') }}" alt="image" class="banner-coin coin-2">
                        <img src="{{ getFile('banner', 'coin-3.png') }}" alt="image" class="banner-coin coin-3">
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="row gy-sm-4 g-3">
                        @foreach ($counter as $count)
                            <div class="col-lg-12 col-md-3 col-6 counter-item-main">
                                <div class="counter-item">
                                    <p class="caption">{{ $count->data->title }}</p>
                                    <h4 class="counter-title">{{ $count->data->total }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('style')
    <style>
        .tradingview-widget-container{
            height: 46px !important;
        }
        .tradingview-widget-copyright {
            display: none;
        }
    </style>
@endpush
