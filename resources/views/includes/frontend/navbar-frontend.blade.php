<!-- Header Section Begin -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    wijirak@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
                @guest
                    <a href="{{ url('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                @endguest

                @auth
                <form action="{{ url('logout') }}" method="post" >
                        {{ csrf_field() }}
                        <button type="submit" class="login-panel btn" ><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</button>
                        <a href="{{ route('profile') }}"  class="login-panel btn" ><i class="fa fa-user"></i>Hi, {{ Auth::user()->first_name }} <span class="caret"></span></a></i></form>
                @endauth
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="./index.html">
                            <img src="{{ url('frontend/img/logowj.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <div class="input-group">
                            <input type="text" placeholder="Apa yang kamu cari?">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="cart-icon">
                            <a href="#">
                                <i class="icon_bag_alt"></i>
                                <span>3</span>
                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>

                                            <tr>
                                                <td class="si-pic"><img src="{{ url('frontend/img/select-product-1.jpg') }}" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p></p>
                                                        <h6>Kabino Bedside Table</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>

                                            <p id="cart-empty" class="text-center py-8">
                                                Oooopsss.... Cart is Empty!
                                                <a href="{{ route('home') }}"></a>
                                            </p>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5>$120.00</h5>
                                </div>
                                <div class="select-button">
                                    <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                </div>
                            </div>
                        </li>
                        <li class="cart-price">$150.00</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">

            {{-- <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="./index.html">Home</a></li>
                    <li><a href="./shop.html">Shop</a></li>


                    <li><a href="./contact.html">Contact</a></li>

                </ul>
            </nav> --}}
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
<!-- Header End -->
