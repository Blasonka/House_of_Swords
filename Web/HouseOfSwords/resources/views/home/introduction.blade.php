@extends('layouts.app')

@section('content')

<div class="introduction">
    <p class="bg-text mx-auto mb-3 display-3">A fejlesztő csapat</p>

    <x-introduction.dev-card
            name="Blasek Balázs"
            age="19"
            imageUrl="https://scontent-vie1-1.xx.fbcdn.net/v/t39.30808-6/271533650_3509041709322085_6512036451243788446_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=BELHEoUECQwAX8ScAvU&_nc_ht=scontent-vie1-1.xx&oh=00_AfD2xiUJhGRumqlz-6TlF1bcYQciWdTSo07hsue_xt5LvQ&oe=6483C1E3"
            roles="Backend fejlesztés, Rendszergazda" />

    <x-introduction.dev-card
            name="Luksa Laura"
            age="19"
            imageUrl="https://scontent-vie1-1.xx.fbcdn.net/v/t39.30808-6/277803990_5129909593752041_4941442642464784353_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=eHUauWz-Z2AAX9fhSSB&_nc_ht=scontent-vie1-1.xx&oh=00_AfATHNPyoAzOzrUBAhPkZCS_X7sOtoBAmaea8ejj9BViVA&oe=6482458C"
            roles="Frontend fejlesztés, UI tervezés" />

    <x-introduction.dev-card
            name="Venter Alex"
            age="18"
            imageUrl="https://scontent-vie1-1.xx.fbcdn.net/v/t1.6435-9/121329026_2823193077921118_3755124655677638579_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=Aw-Ifrt_XBEAX-vP-H4&_nc_ht=scontent-vie1-1.xx&oh=00_AfCKZbFxPvLD_tzjCY4nKPdzwfGGhAJUFyo6sqjza-QjQA&oe=64A5A2F4"
            roles="Full-stack fejlesztés, Koordinátor" />
</div>

@endsection
