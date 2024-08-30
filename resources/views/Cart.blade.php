<x-layout-client title="Cart">
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                @if ($message = Session::get('success'))
                    <div class="p-4 mb-3 bg-green-400 rounded">
                        <p class="text-green-800">{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('status'))
                    <div class="p-4 mb-3 bg-green-400 rounded">
                        <p class="text-green-800">{{ $message }}</p>
                    </div>
                @endif
                <div class="col-lg-12">
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


                                @foreach ($cartInDB as $item)
                                    <tr>

                                        <td class="shoping__cart__item">
                                            <img src="{{ $item->products->images()->first()->img }}"
                                                style="height: 100px;" alt="">
                                            <h5>{{ $item->name }} DB</h5>
                                        </td>
                                        <td class="shoping__cart__price" id="shoping__cart__price{{ $item->id }}">

                                            ${{ $item->c_price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="">

                                                    <input type="number" value="{{ $item->quantity }}" name="quantity"
                                                        style="width: 40px"
                                                        onchange="changeQtyItemEvent({{ $item }})"
                                                        id="qty-{{ $item->id }}" class="">
                                                    <input type="hidden" value="{{ $item->id }}"
                                                        name="id-input{{ $item->id }}"
                                                        id="id-input{{ $item->id }}" />
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="shoping__cart__total">
                                        $ {{ (isset($item->attributes->price)==false ) ? "0" : asset($item->attributes->price) }}
                                    </td> --}}
                                        <td class="shoping__cart__item__close">

                                            <form action="{{ route('cart.remove') }}" method="POST"
                                                id="frmDelIt{{ $item->id }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id" />
                                            </form>
                                            <span class="" onclick="smRemoveItem({{ $item->id }})">
                                                <?xml version="1.0" standalone="no"?>
                                                <!DOCTYPE svg
                                                    PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                                <svg style="color: rgb(19, 180, 110);"
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                                                        fill="#13b46e"></path>
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                                                        fill="#13b46e"></path>
                                                </svg>
                                            </span>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <div>
                            <a href="/shop" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                            <a href="/cart" class="primary-btn cart-btn cart-btn-right"><span
                                    class="icon_loading"></span>
                                Upadate Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('cart.checkout.ajax') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Discount Codes</h5>
                                {{-- <form action="#"> --}}
                                <input type="text" placeholder="Enter your coupon code" value=""
                                    id="discountCode" style="height: 45px;width: 60%;">
                                {{-- <button type="submit" class="site-btn">APPLY COUPON</button> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Cart Total</h5>
                            <ul>
                                {{-- <li>Subtotal <span>$454.98</span></li> --}}
                                <li>Total <span>$
                                        {{ number_format($totalQuantity == 0 ? $totalcartDB : $totalQuantity) }}</span>
                                </li>
                            </ul>

                            <div style="display: none">
                                <input type="text" name="userId" id="userId" value="{{ Auth::id() }}">
                                <input type="text" name="voucher_code" id="voucher_code" value="">
                                <input type="text" name="fee" id="fee" value="{{ $setting->fee_order }}">
                                @foreach ($cartItems as $item)
                                    <input type="text" name="product_id[]" id="product_id"
                                        value="{{ $item->id }}">
                                @endforeach
                                <input type="hidden" name="price_order" id="price_order"
                                    value="{{ $totalQuantity == 0 ? $totalcartDB : $totalQuantity }}">
                            </div>
                            {{-- <input type="text" name="total_cart" id="total_cart" value="{{ number_format($totalQuantity == 0 ? $totalcartDB : $totalQuantity) }}"> --}}
                            {{-- <a href="javascript:checkout()" class="primary-btn">PROCEED TO CHECKOUT</a> --}}
                            <button onclick="submit" class="primary-btn" style="width: 100%;border:none">PROCEED TO
                                CHECKOUT</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

</x-layout-client>

<script>
    $('#discountCode').on('change', function() {
        $('#voucher_code').val($('#discountCode').val())
    });



    function smRemoveItem(id) {
        $('#frmDelIt' + id).submit();
    }
    //caculate price with new qty
    $('.qtybtn').on('click', function() {
        var qty = $('#qty-' + id).val();
        $('#qty-' + id).trigger('change');
    })


    function changeQtyItemEvent(item) {


        //alert(JSON.stringify(item.products.price))


        var qtyChange = parseInt($('#qty-' + item.id).val())
        var idInput = $('#id-input' + item.id).val();

        var pricePrd = item.products.price;

        $('#shoping__cart__price' + item.id).text('$' + qtyChange * pricePrd);
        //alert(idInput)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "{{ route('cart.update') }}",
            data: {
                id: item.id,
                quantity: qtyChange
            },
            dataType: 'text',
            success: function(res) {
                res = JSON.parse(res)
                console.log(res)
            },
            error: function(err) {
                console.log(err.responseText)
            }
        });


    }
</script>
