@extends('layouts.app')

@section('content')

<div class="message-body" style="padding: 100px">
    <div class="sender-details">
      <img class="img-sm rounded-circle mr-3" src="{{asset('/storage/image/'.$sentimgview->user->image)}}" alt="image">
      <div class="details">
        <p class="msg-subject" style="margin-top: 10px">
          {{$sentimgview->created_at}}
        </p>
        <p class="sender-email">
         To
          <a href="{{ route('message.replys',['id' => $sentimgview->id]) }}">{{$sentimgview->email}}</a>
        </p>
      </div>
    </div>
    <div class="message-content" style="margin-bottom: 40px">
      {{$sentimgview->message}}
    </div>

  </div>
@endsection