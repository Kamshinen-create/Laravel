@php
$content = content('testimonial.content');
$elements = element('testimonial.element');

@endphp

<section class="testimonial-section sp_pt_100 sp_pb_100">
    <div class="testimonial-section-el">
        <img src="{{ getFile('elements', 'partner-bg.png') }}" alt="image">
    </div>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7 text-center">
            <div class="sp_site_header  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
              <h2 class="sp_site_title">{{ __(@$content->data->title) }}</h2>
            </div>
          </div>
        </div>

        <div class="testimonial-slider">
            @forelse ($elements as $element)
                <div class="single-slide">
                    <div class="testimonial-item">
                        <p class="testimonial-details">{{ @$element->data->answer }}</p>
                        <div class="testimonial-client">
                            <div class="thumb">
                                <img src="{{ getFile('testimonial', @$element->data->image) }}" alt="image">
                            </div>
                            <div class="content">
                                <h5 class="name">{{ @$element->data->client_name }}</h5>
                                <p>{{ @$element->data->designation }}</p>
                            </div>
                        </div>
                    </div><!-- testimonial-item end -->
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>