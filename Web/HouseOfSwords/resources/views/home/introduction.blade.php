@extends('layouts.app')

@section('content')

<div class="introduction">
    <p class="bg-text mx-auto mb-3 display-3">A fejlesztő csapat</p>

    <x-introduction.dev-card
            name="Blasek Balázs"
            age="19"
            imageUrl="https://scontent.fbud7-3.fna.fbcdn.net/v/t39.30808-6/271533650_3509041709322085_6512036451243788446_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=GB7NWaxD8b4AX8kfFKk&_nc_ht=scontent.fbud7-3.fna&oh=00_AfCpP3yz72oR-rl5SC5FVIKbxJ3g2ZnSmy709ECJw34QtA&oe=641309A3"
            roles="Backend fejlesztés, Rendszergazda" />

    <x-introduction.dev-card
            name="Luksa Laura"
            age="19"
            imageUrl="https://scontent.fbud7-4.fna.fbcdn.net/v/t39.30808-6/277803990_5129909593752041_4941442642464784353_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=Eu7IykYhKaQAX-TViZT&_nc_ht=scontent.fbud7-4.fna&oh=00_AfB8givDHS-8zsUo7Ak4OaSAGl_uRajeAYCIGr2QQeuzGw&oe=6413878C"
            roles="Frontend fejlesztés, UI tervezés" />

    <x-introduction.dev-card
            name="Venter Alex"
            age="18"
            imageUrl="https://scontent.fbud7-3.fna.fbcdn.net/v/t1.6435-9/121329026_2823193077921118_3755124655677638579_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=U5tLadzf0DkAX84ABny&_nc_ht=scontent.fbud7-3.fna&oh=00_AfBlrBNLnIZY43oKsGsbwbFi1YbIDMkZJjHkVVucbuNWlA&oe=64359374"
            roles="Full-stack fejlesztés, Koordinátor" />
</div>

@endsection
