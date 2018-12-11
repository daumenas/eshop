@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom:100px;">
        <div class="row">
            <div class="col-xs-4 item-photo">
                <img style="max-width:100%;" src="https://ak1.ostkcdn.com/images/products/8818677/Samsung-Galaxy-S4-I337-16GB-AT-T-Unlocked-GSM-Android-Cell-Phone-85e3430e-6981-4252-a984-245862302c78_600.jpg" />
            </div>
            <div class="col-xs-5" style="border:0px solid gray">
                <h3>{{ $product->title }}</h3>

                <h6 class="title-price"><small>Price</small></h6>
                <h3 style="margin-top:0px;">${{ $product->price }}</h3>

                <div class="section">
                    <h6 class="title-attr" style="margin-top:15px;" ><small>Color</small></h6>
                    <div>
                        <div class="attr" style="width:25px;background:#5a5a5a;"></div>
                        <div class="attr" style="width:25px;background:white;"></div>
                    </div>
                </div>
                <div class="section" style="padding-bottom:20px;">
                    <h6 class="title-attr"><small>Amount</small></h6>
                    <div>
                        <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                        <input value="1" />
                        <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                    </div>
                </div>

                <div class="section" style="padding-bottom:20px;">
                    <button class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to cart</button>
                </div>
            </div>

            <div class="col-xs-9">
                <ul class="menu-items">
                    <li class="active">Product details</li>
                    <li>Guarantee information</li>
                </ul>
                <div style="width:100%;border-top:1px solid silver">
                    <p style="padding:15px;">
                        <small>
                            {{ $product->description }}
                        </small>
                    </p>
                    <small>
                        {{ $product->specification }}
                    </small>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <h1>Prekės atsiliepimai</h1>
        <a href="{!! route('showReview', ['id'=>$product->id]) !!}" ><button>Žiūrėti atsiliepimus</button>
    </div>

    <style>
        ul > li{margin-right:25px;font-weight:lighter;cursor:pointer}
        li.active{border-bottom:3px solid silver;}

        .item-photo{display:flex;justify-content:center;align-items:center;border-right:1px solid #f6f6f6;}
        .menu-items{list-style-type:none;font-size:11px;display:inline-flex;margin-bottom:0;margin-top:20px}
        .btn-success{width:100%;border-radius:0;}
        .section{width:100%;margin-left:-15px;padding:2px;padding-left:15px;padding-right:15px;background:#f8f9f9}
        .title-price{margin-top:30px;margin-bottom:0;color:black}
        .title-attr{margin-top:0;margin-bottom:0;color:black;}
        .btn-minus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-right:0;}
        .btn-plus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-left:0;}
        div.section > div {width:100%;display:inline-flex;}
        div.section > div > input {margin:0;padding-left:5px;font-size:10px;padding-right:5px;max-width:18%;text-align:center;}
        .attr,.attr2{cursor:pointer;margin-right:5px;height:20px;font-size:10px;padding:2px;border:1px solid gray;border-radius:2px;}
        .attr.active,.attr2.active{ border:1px solid orange;}

        @media (max-width: 426px) {
            .container {margin-top:0px !important;}
            .container > .row{padding:0 !important;}
            .container > .row > .col-xs-12.col-sm-5{
                padding-right:0 ;
            }
            .container > .row > .col-xs-12.col-sm-9 > div > p{
                padding-left:0 !important;
                padding-right:0 !important;
            }
            .container > .row > .col-xs-12.col-sm-9 > div > ul{
                padding-left:10px !important;

            }
            .section{width:104%;}
            .menu-items{padding-left:0;}
        }
    </style>
    <script>
        $(document).ready(function(){
            //-- Click on detail
            $("ul.menu-items > li").on("click",function(){
                $("ul.menu-items > li").removeClass("active");
                $(this).addClass("active");
            })

            $(".attr,.attr2").on("click",function(){
                var clase = $(this).attr("class");

                $("." + clase).removeClass("active");
                $(this).addClass("active");
            })

            //-- Click on QUANTITY
            $(".btn-minus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1 > 0){ now--;}
                    $(".section > div > input").val(now);
                }else{
                    $(".section > div > input").val("1");
                }
            })
            $(".btn-plus").on("click",function(){
                var now = $(".section > div > input").val();
                if ($.isNumeric(now)){
                    $(".section > div > input").val(parseInt(now)+1);
                }else{
                    $(".section > div > input").val("1");
                }
            })
        })
    </script>
@endsection