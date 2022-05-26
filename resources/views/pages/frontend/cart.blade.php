@extends('layouts.frontend')

@section('title')
Wiji Rak - Cart
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @php
                $total = 0;
                $ppn = 0;
                @endphp
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name" style="text-align:center">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th></th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($carts as $cart)
                            <tr>
                                <td class="cart-pic first-row">
                                    <img src="{{ url($cart->product->galleries->first()->photo) }}" alt="">
                                </td>
                                <td class="cart-title first-row">
                                    <h5 style="text-align: center">{{ $cart->product->name }}</h5>
                                </td>
                                
                                <td class="cart-pic first-row">
                                    <h5 style="text-align: center"> {{'Rp ' . number_format($cart->product->price * $cart->quantity, 0, ".", ".")}} </h5>
                                    @php
                                      $total += $cart->product->price * $cart->quantity;
                                    @endphp
                                  </td>
                                {{-- <td data-th="Quantity" class="qua-col">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input data-id={{ $cart->product->id }} type="text" name="quantity"
                                                value="{{ $cart->quantity }}">
                                        </div>
                                    </div>
                                </td> --}}

                                <td class="cart-pic first-row">

                                    <h5 style="text-align: center">{{ $cart->quantity }}</h5>
                                </td>

                                <td class=" cart-pic total-price first-row">
                                    <form action="{{ route('cart.decrement', $cart->product->id) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">
                                            -
                                        </button>

                                    </form>

                                    <form action="{{ route('cart.add', $cart->product->id) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary ">
                                            +
                                         </button>
                                    </form>
                                </td>
                                <td class="close-td first-row">
                                    {{-- <form action="" method="post">
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-info btn-sm update_cart-cart">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                   </form> --}}

                                   <form action="{{ route('cart.delete', $cart->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm ti-close"></button>
                                   </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <p id="cart-empty" class="text-center py-8" style="margin-top: 100">
                                            <a href="{{ route('home') }}">
                                                Oooopsss.... Cart is Empty!</a>
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                            <a href="#" class="primary-btn up-cart">Update cart</a>
                        </div>
                        <div class="discount-coupon">
                            <h6>Discount Codes</h6>
                            <form action="#" class="coupon-form">
                                <input type="text" placeholder="Enter your codes">
                                <button type="submit" class="site-btn coupon-btn">Apply</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">

                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Subtotal <span>Rp {{ number_format($total, 0, ".", ".") }}</span></li>
                                @php
                                $ppn += (11/100) * $total;
                                @endphp
                                <li>PPN 11% <span>Rp {{ number_format($ppn, 0, ".", ".") }}</span></li>
                                @php
                                $total += ($total * 11 / 100)
                                @endphp
                                <li class="cart-total">Total <span>Rp {{ number_format($total, 0, ".", ".") }}</span></li>
                            </ul>

                                <a href="{{ route('checkout') }}" type="submit" class="proceed-btn">PROCEED TO CHECK OUT</a >

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
