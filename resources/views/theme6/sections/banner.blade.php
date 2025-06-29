@php
$content = content('banner.content');
$counter = element('banner.element');
@endphp
    <section class="banner-section">
        <div class="banner-el">
            <img src="{{ getFile('banner', @$content->data->backgroundimage) }}" alt="image">
        </div>

        <div class="banner-arrow-el">
            <img src="{{ getFile('banner', 'banner-arrow2.png') }}" alt="image">
        </div>

        <div class="container">
            <div class="row gy-4 align-items-center justify-content-between">
                <div class="col-lg-7"> 
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

                <div class="col-xl-4 col-lg-5">
                    <div class="row gy-sm-4 g-3">
                        @foreach ($counter as $count)
                            <div class="col-lg-6 col-6">
                                <div class="counter-item">
                                    <p class="caption">{{ $count->data->title }}</p>
                                    <h3 class="counter-title">{{ $count->data->total }}</h3>
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
