@extends('layouts.master')

@section('style')
<style type="text/css">


	.card {
	    border-radius: 8px;
	    box-shadow: 5px 6px 6px 2px #e9ecef
	}

	.heading {
	    font-size: 23px;
	    font-weight: 00
	}

	.text {
	    font-size: 16px;
	    font-weight: 500;
	    color: #b1b6bd
	}

	.pricing {
	    border: 2px solid #304FFE;
	    background-color: #f2f5ff
	}

	.business {
	    font-size: 20px;
	    font-weight: 500
	}

	.plan {
	    color: #aba4a4
	}

	.dollar {
	    font-size: 16px;
	    color: #6b6b6f
	}

	.amount {
	    font-size: 50px;
	    font-weight: 500
	}

	.detail {
	    font-size: 22px;
	    font-weight: 500
	}

	.cvv {
	    height: 44px;
	    width: 200px;
	    border: 2px solid #eee
	}

	.cvv:focus {
	    box-shadow: none;
	    border: 2px solid #304FFE
	}

	.email-text {
	    height: 55px;
	    border: 2px solid #eee
	}

	.email-text:focus {
	    box-shadow: none;
	    border: 2px solid #304FFE
	}

	.payment-button {
	    height: 70px;
	    font-size: 20px
	}

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

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <div style="background-color: #3a3938;" class="card p-5">
        <div>
            <h4 class="heading">Transfer Money</h4>
            <p class="text">Make sure to choose transfer amount less than your chosen card balance</p>
        </div>
        <div class="pricing p-3 rounded mt-4 d-flex justify-content-between">
            <div class="images d-flex flex-row align-items-center">
            	<img src="money-bag.png" class="rounded" width="60">
                <div class="d-flex flex-column ml-4">
                	<span class="business">Balance</span>
                	<span class="plan">TO TRANSFER</span>
                </div>
            </div>
            <!--pricing table-->
            <div class="d-flex flex-row align-items-center">
            	<sup class="dollar font-weight-bold">$</sup>
            	<span class="amount ml-1 mr-1">{{ $balance }}</span>
            </div> <!-- /pricing table-->
        </div>
        <form method="POST" action="{{ route('transfer') }}">
            @csrf


            <div class="detail mt-5">Your Cards</div>
	        @forelse ($cards as $card)

			    <div class="credit rounded mt-4 d-flex justify-content-between align-items-center">
			    	<span class="form-check">
						<input class="form-check-input @error('card') is-invalid @enderror" type="radio" name="card" value="{!! $card->card_number !!}" id="flexRadioDefault1">

						@error('card')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			        	@enderror
					</span>
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

	        <h6 class="mt-4 text-primary">Type Username of End User</h6>
	        <div class="email mt-2">
	        	<input type="text" name="username" value="{{ old('username') }}" class="form-control email-text @error('username') is-invalid @enderror" placeholder="Username">

	        	@error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	        </div>

	        <h6 class="mt-4 text-primary">Type Transfer Amount</h6>
	        <div class="email mt-2">
	        	<input type="text" name="amount" value="{{ old('amount') }}" class="form-control email-text @error('amount') is-invalid @enderror" placeholder="Transfer Amount">

	        	@error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	        </div>
	        <div class="mt-3">
	        	<button type="submit" class="btn btn-primary btn-block payment-button">
	        		Proceed to Transfer
	        		<i class="fa fa-long-arrow-right"></i>
	        	</button>
	        </div>
	    </form>
	    
    </div>
</div>
@endsection

@section('script')
    
@endsection