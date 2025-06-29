@php
$content = content('howitwork.content');
$elements = element('howitwork.element')->take(8);
@endphp

    <section class="work-section sp_pt_120 sp_pb_120 sp_separator_bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7 text-center">
            <div class="sp_site_header  wow fadeInUp" data-wow-duration="0.3s" data-wow-delay="0.3s">
              <h2 class="sp_site_title">{{ __(@$content->data->title) }}</h2>
            </div>
          </div>
        </div>

        <div class="row gy-4 align-items-center">
          <div class="col-lg-6 pe-xxl-5">
            <div class="row gy-4">
              @foreach ($elements as $element)
              <div class="col-12">
                  <div class="work-item">
                      <div class="work-number">
                        {{ $loop->iteration }}
                      </div>
                      <div class="work-content">
                        <h4 class="title">{{ __(@$element->data->title) }}</h4>
                        <p class="mt-2"><?= clean($element->data->short_description) ?></p>
                      </div>
                  </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-lg-6">
            <img src="{{ getFile('elements', 'how-work.png') }}" alt="image">
          </div>
        </div>
      </div>
    </section>