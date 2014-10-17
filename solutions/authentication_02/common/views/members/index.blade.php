@extends('layouts.master')

@section('content')

   <h1>All Members: </h1>

   @foreach($members_list as $member)
        <li> {{ HTML::link('/members/'.$member->username,$member->username) }}</li>
   @endforeach

@stop

