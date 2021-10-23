@extends('layouts.app')

@section('content')

<div class="message-body" style="padding: 100px">
    <div class="sender-details">
      <img class="img-sm rounded-circle mr-3" src="{{asset('/storage/image/'.$viewmessage->user->image)}}" alt="image">
      <div class="details">
        <p class="msg-subject" style="margin-top: 10px">
          {{$viewmessage->created_at}}
        </p>
        <p class="sender-email">
          Sarah Graves
          <a href="{{ route('message.reply',['id' => $viewmessage->id]) }}">{{$viewmessage->user->email}}</a>
        </p>
      </div>
    </div>
    <div class="message-content" style="margin-bottom: 40px">
      {{$viewmessage->message}}
    </div>
   <div>
        <a href="{{ route('message.reply',['id' => $viewmessage->id]) }}" class="btn btn-dark btn-icon-text">Reply
         <i class="fas fa-pencil-alt btn-icon-append"></i>   
        </a>   
    <div>
  </div>
@endsection