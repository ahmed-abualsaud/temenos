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

        .notification .badge {
          position: absolute;
          top: 1px;
          right: 1px;
          padding: 5px 10px;
          border-radius: 50%;
          background-color: red;
          color: white;
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
        .cvv {
	    height: 44px;
	    width: 200px;
	    border: 2px solid #eee;
		}

		.cvv:focus {
		    box-shadow: none;
		    border: 2px solid #304FFE
		}

		.plan {
		    color: #aba4a4
		}
</style>

@endsection

@section('content')

<div class="outer">
    <div class="floatcontainer">
        <div class="inner">
          <a href="{{ route('inbox') }}" class="notification">
            <span>Inbox</span>
            @if($notfs > 0)
              	<span class="badge">{{ $notfs }}</span>
            @endif 
         </a>
        </div>
    </div>
</div>

<div class="card-body">
    <div style="font-size: 50px; width: 50%" class="alert alert-success" role="alert">
        Total Balance = $ {{ $balance }}
    </div>

    <div>

    	@forelse ($cards as $card)

			    <div class="credit rounded mt-4 d-flex justify-content-between align-items-center">
			        <span class="d-flex flex-row align-items-center">
			        	<img src="https://i.imgur.com/qHX7vY1.png" class="rounded" width="70">
			            <span class="d-flex flex-column ml-3">
			            	<span class="plan">{{ $card->card_number }}</span>
			            </span>
			        </span>
		            <span>
		            	<span class="form-control cvv">Balance = {{ $card->balance }} </span>
		            </span>
		        </div>

			@empty
			    <p style="text-align: center;">You Have No Cards</p>
			@endforelse
    </div>
</div>
@endsection

@section('script')
    
@endsection