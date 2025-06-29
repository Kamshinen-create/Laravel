@php
$content = content('contact.content');
$contentlink = content('footer.content');
$footersociallink = element('footer.element');
$serviceElements = element('service.element');
@endphp

<footer class="footer-section has-bg-img">
    <div class="footer-top-section">
        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 pe-xxl-4">
                    <a href="{{ route('home') }}" class="footer-logo">
                        @if (@$general->logo)
                            <img class="img-fluid rounded sm-device-img text-align"
                                src="{{ getFile('logo', @$general->whitelogo) }}" width="100%" alt="pp">
                        @else
                            {{ __('No Logo Found') }}
                        @endif
                    </a>

                    <p class="mt-3">
                        {{ __(@$contentlink->data->footer_short_description) }}
                    </p>
                </div>
                <div class="col-lg-2">
                    <h3 class="footer-item-title">{{ __('Short Links') }}</h3>
                    <ul class="footer-menu-list">
                        <li> <a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        @forelse ($pages as $page)
                            <li><a href="{{ route('pages', $page->slug) }}">{{ __($page->name) }}</a></li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h3 class="footer-item-title">{{ __('Social Links') }}</h3>
                    <ul class="footer-social-links">
                        @forelse ($footersociallink as $item)
                            <li>
                                <a href="{{ __(@$item->data->social_link) }}" class="{{ @$item->data->social_icon }}" target="_blank"><i class="{{ @$item->data->social_icon }}"></i></a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div> 
                <div class="col-lg-3">
                    <h3 class="footer-item-title">{{ __('Contact Us') }}</h3>
                    <div class="footer-contact-items">
                        <div class="footer-contact-item">
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="content">
                                <h5 class="title">{{ __('Chat to support') }}</h5>
                                <p><a href="mailto:{{ __(@$content->data->email) }}">{{ __(@$content->data->email) }}</a></p>
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="content">
                                <h5 class="title">{{ __('Call us') }}</h5>
                                <p><a href="tel:{{ __(@$content->data->phone) }}">{{ __(@$content->data->phone) }}</a></p>
                            </div>
                        </div>
                        <div class="footer-contact-item">
                            <div class="icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="content">
                                <h5 class="title">{{ __('Visit us') }}</h5>
                                <p>{{ __(@$content->data->location) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">
                        @if (@$general->copyright)
                            {{ __(@$general->copyright) }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>