
@extends('layout')

@section('content')



    <div class="shell">
      <div class="container">
        <div class="row">

            @foreach ( json_decode($response->body(),true) as $product )
            <div class="col-md-3">
                <div class="wsk-cp-product">
                  <div class="wsk-cp-img">

                    <img src="{{ $product['images'][0]['src'] }}" alt="Product" class="img-responsive" />
                  </div>
                  <div class="wsk-cp-text">
                    <div class="category">
                      <span>{{$product['categories'][0]['name']}}</span>
                    </div>
                    <div class="title-product">
                      <h3>{{$product['name']}}</h3>
                    </div>
                    <p class="btn-holder"><a href="{{ route('add_to_cart', $product['id']) }}" class="btn btn-success btn-block text-center" role="button">Add to cart</a> </p>
                    {{-- <div class="description-prod">
                      <p>Description Product tell me how to change playlist height size like 600px in html5 player. player good work now check this link</p>
                    </div> --}}
                    <div class="card-footer">
                      <div class="wcf-left"><span class="price">{{$product['regular_price']}}</span></div>
                      <div class="wcf-right"><a href="#" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach




        </div>

      </div>
    </div>
    @endsection
