@extends("layouts.landing")

@section("content")
    <!-- intro start-->
    @include("home.intro")

    <!-- features start-->
    @include('home.features')

    <!-- access banner 1 start-->
    @include('home.access_banner_1')

    <!-- access banner 2 start-->
    @include('home.features_2')

    <!-- Pricing Section -->
    @include('home.pricing')

    <!-- Call to Action (CTA) Section -->
    @include('home.features_1')

    {{-- <!-- Contact Section -->
    @include('home.contact') --}}
@endsection