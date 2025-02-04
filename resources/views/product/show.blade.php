@extends('layouts.app')
@inject('storage', \Illuminate\Support\Facades\Storage)
@inject('auth', \Illuminate\Support\Facades\Auth)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @if(isset($pictures))
                            @foreach($pictures as $key => $picture)
                                <li data-target="#carousel"
                                    data-slide-to="{{ $key }}"{{ $key == 0 ? ' class="active"' : '' }}></li>
                            @endforeach
                        @endif
                    </ol>
                    <div class="carousel-inner">
                        @if(isset($pictures))
                            @foreach($pictures as $key => $picture)
                                <div class="carousel-item{{ $key == 0 ? ' active' : '' }}">
                                    <img class="d-block img-fluid w-100" src="{{ asset($storage::url($picture)) }}"
                                         alt="product photo">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img class="d-block img-fluid w-100" src="http://placehold.it/400x250/000/fff"
                                     alt="product photo">
                            </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-sm">
                <div class="card mt-3">
                    <div class="card-header font-weight-bold">
                        <h4 class="mt-auto mb-auto">
                            {{ $product->title }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h6 class="font-weight-bold">Description</h6>
                                {{ $product->description }}
                            </li>
                            <li class="list-group-item">
                                <h6 class="font-weight-bold">Price</h6>
                                ${{ $product->price }}
                            </li>
                            <li class="list-group-item">
                                <form method="post" action="{{route('addToCart')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$auth::user()->id}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-specification"
                   role="tab"
                   aria-controls="v-pills-specification" aria-selected="true">Specification</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-reviews" role="tab"
                   aria-controls="v-pills-reviews" aria-selected="false">Reviews</a>
            </div>
            <div class="tab-content container mt-3 mr-auto ml-0" id="v-pills-tabContent" style="max-width:80%;">
                <div class="tab-pane fade show active" id="v-pills-specification" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    {{ $product->specification }}
                </div>
                <div class="tab-pane fade" id="v-pills-reviews" role="tabpanel"
                     aria-labelledby="v-pills-profile-tab">
                    <h4>Leave a review:</h4>
                    <form role="form" method="post" action="{{ route('newReview') }}">
                        <input type="hidden" name="user_id" value="{{$auth::user()->id}}">
                        <div class="form-group">
                            <textarea name="text" class="form-control" rows="3" required autofocus></textarea>
                            @csrf
                        </div>
                        <input name="product_id" type="hidden" value="{{ $product->id }}">
                        <div class="form-group">
                            <h4>Reitingas:</h4>
                            <select name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <hr>
                    @foreach($product->reviews as $review)
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    {{ $review->title }}
                                    <div class="clearfix small">
                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($review->created_at))->diffForHumans() }}
                                    </div>
                                </div>
                                @if($review->user->id == auth::user()->id)
                                    <div class="pull-right">
                                        <a href="{!! route('editRedirectReview', ['id'=>$review->id]) !!}" class="btn">Edit</a>
                                        <a href="{!! route('deleteReview', ['id'=>$review->id]) !!}" class="btn">Delete</a>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="d-flex flex-nowrap">
                                    @for($i = 0; $i < $review->rating; $i++)
                                        <i class="material-icons">stars</i>
                                    @endfor
                                </div>
                                <div class="card-text mt-2">
                                    {{ $review->body }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.carousel').carousel({
                interval: false
            });
        })
    </script>
@endsection