@extends('layouts.master')

@section('style')

<style type="text/css">
	.notification {
          background-color: #555;
          color: white;
          text-decoration: none;
          padding: 20px 15px;
          position: fixed;
          -moz-border-radius: 100%;
          -webkit-border-radius: 100%;
          border-radius: 100%;
          z-index: 1000;
        }

        .notification:hover {
          background:  #f68c23;
        }
        .outer {
            width:102%;
            height:1px;
            margin:0 auto;
            position: relative;
        }
        .floatcontainer {
            float: right;
        }
        .inner {
            background-color: red;
            position:fixed;
        }
        .floatcontainer, .inner{
            width: 50px;
        }

        .inbox {
          margin-bottom: 10px;
          height: 50px;
          background-color: #3a3938;
          color: #FFC300;
          padding-top: 10px;
          padding-left: 5px;
          border-radius: 20px;
          box-shadow: 3px 3px 5px gray;
        }
        .new {
          color: red;
          margin-left: 20%;
        }
</style>

@endsection

@section('content')
<div class="outer">
    <div class="floatcontainer">
        <div class="inner">
          <a href="{{ route('inbox') }}" class="notification">
            <span>Inbox</span>
          </a>
        </div>
    </div>
</div>

@forelse ($notifications as $notification)
    <div class="inbox">
      {{ $notification->content }}

      @if ($notification->seen == 'no')
        <span class="new">new</span>
      @endif
    </div>
@empty
    <p>No Notifications</p>
@endforelse
@endsection

@section('script')
    
@endsection