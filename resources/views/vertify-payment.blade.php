<x-layout-client title="Status payment">
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Payment</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Payment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    @if ($statusCode == '00')
                        <div class="p-4 mb-3 bg-green-400 rounded">
                            <p class="text-green-800">Payment is success !</p>
                        </div>
                    @elseif($statusCode == '15' || $statusCode == 24)
                        <div class="p-4 mb-3 bg-red-400 rounded">
                            <p class="text-green-800">Payment is cancaled !</p>
                        </div>
                    @endif
                    <h5 class="">
                        <a href="/" class="text-center link-offset-2">Go home page</a>
                    </h5>
                </div>

            </div>

        </div>
    </section>

</x-layout-client>
