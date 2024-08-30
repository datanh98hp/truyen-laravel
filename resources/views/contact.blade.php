<x-layout-client title="Contact">
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>{{ $setting->phone }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>{{ $setting->address }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>{{ $setting->timeStart }} - {{ $setting->timeClose }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>{{ $setting->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    {{-- <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d920.8594891914158!2d106.5422713409069!3d20.81263938113287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a77d378526cad%3A0x8bcacb55d47f4b7a!2zUXXhu5FjIFR14bqlbiwgQW4gTMOjbywgSOG6o2kgUGjDsm5nLCBWaeG7h3QgTmFt!5e1!3m2!1svi!2s!4v1683113694764!5m2!1svi!2s"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" draggable="false"></iframe>
            
            <div class="map-inside">
                <i class="icon_pin"></i>
                <div class="inside-widget">
                    <h4>New York</h4>
                    <ul>
                        <li>Phone: +12-345-6789</li>
                        <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                    </ul>
                </div>
            </div>
    </div> --}}
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Reply from Customer</h2>
                    </div>
                    @if (session('status'))
                        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                            <span class="badge badge-pill badge-success">Success</span>
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <form action="/contact" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        @error('name')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                        <input type="text" name="name" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @error('email')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                        <input type="email" name="email" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        @error('message')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                        <textarea placeholder="Your message" name="message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
</x-layout-client>
