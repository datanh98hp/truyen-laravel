<x-layout-client title="Check out">
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Check out</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--  --}}

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    {{-- <th>Total</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $item)
                                    <tr>

                                        <td class="shoping__cart__item">
                                            <img src="{{ $item->products->images()->first()->img }}"
                                                style="height: 100px;" alt="">
                                            <h5>{{ $item->name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price" id="shoping__cart__price{{ $item->id }}">

                                            {{ number_format($item->c_price) }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                {{-- <div class="">
    
                                                    <input type="number" value="{{ $item->quantity }}"
                                                        name="quantity" style="width: 40px"
                                                        onchange="changeQtyItemEvent({{ $item }})"
                                                        id="qty-{{ $item->id }}" class="">
                                                    <input type="hidden" value="{{ $item->id }}"
                                                        name="id-input{{ $item->id }}"
                                                        id="id-input{{ $item->id }}" />
                                                </div> --}}
                                                {{ $item->quantity }}
                                            </div>
                                        </td>
                                        {{-- <td class="shoping__cart__total">
                                        $ {{ (isset($item->attributes->price)==false ) ? "0" : asset($item->attributes->price) }}
                                    </td> --}}
                                        {{-- <td class="shoping__cart__item__close">
    
                                            <form action="{{ route('cart.remove') }}" method="POST"
                                                id="frmDelIt{{ $item->id }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}"
                                                    name="id" />
                                            </form>
                                            <span class="" onclick="smRemoveItem({{ $item->id }})">
                                                <?xml version="1.0" standalone="no"?>
                                                <!DOCTYPE svg
                                                    PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg style="color: rgb(19, 180, 110);"
                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                    height="16" fill="currentColor" class="bi bi-trash"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                                                        fill="#13b46e"></path>
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                                        fill="#13b46e"></path>
                                                </svg>
                                            </span>
    
                                        </td> --}}
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">Products <span>Total</span></div>
                        <ul>
                            @foreach ($products as $item)
                                <li>{{ $item->name }} <span>$ {{ number_format($item->c_price) }}</span></li>
                            @endforeach
                            <div class="checkout__order__subtotal">Fee <span>$ {{ $fee }}</span></div>
                            <div class="checkout__order__total">Discount <span>$ {{ $discount }}</span></div>
                            <div class="checkout__order__total">Total <span>{{ number_format($price_order) }}</span>
                            </div>


                            <form action="{{url('/pay')}}" method="POST">
                                @csrf
                                <input type="hidden" name="voucher">

                                <input type="hidden" name="cart_id" >
                                <input type="hidden" name="fee" value="{{ $fee }}">
                                
                                <input type="hidden" name="total_pay" value="{{$price_order}}">
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </form>
                            
                            <form action="{{url('/vnpay_payment')}}" method="POST">
                                @csrf
                                <input type="hidden" name="voucher">
                                
                                <input type="hidden" name="cart_id" >
                                <input type="hidden" name="fee" value="{{ $fee }}">
                              
                                <input type="hidden" name="total_pay" value="{{$price_order}}">
                                <button type="submit" name="redirect" class="site-btn">VNPAY </button>
                            </form>
                    </div>
                </div>
            </div>

        </div>
        </form>
        </div>
        </div>
    </section>
    <!-- Checkout Section End -->
</x-layout-client>
