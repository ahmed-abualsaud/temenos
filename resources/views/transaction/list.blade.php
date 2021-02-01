@extends('layouts.master')

@section('style')
<style type="text/css">
	
	.container {
	  max-width: 1000px;
	  margin-left: auto;
	  margin-right: auto;

	}

	.responsive-table li {
		border-radius: 3px;
		padding: 25px 30px;
		display: flex;
		justify-content: space-between;
		margin-bottom: 25px;
	}
	.table-header {
		background-color: #3a3938;
		font-size: 14px;
		text-transform: uppercase;
		letter-spacing: 0.03em;
		color:  #FFC300 ;
	}
	.table-row {
		background-color: #ffffff;
		box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
	}
	.col-1 {
		flex-basis: 10%;
	}
	.col-2 {
		flex-basis: 40%;
	}
	.col-3 {
		flex-basis: 25%;
	}
	.col-4 {
		flex-basis: 25%;
	}

	@media all and (max-width: 767px) {
		.table-header {
			display: none;
		}
		.table-row{
		  
		}

		li {
			display: block;
		}
		.col {
		  
			flex-basis: 100%;
		  
		}
		.col {
			display: flex;
			padding: 10px 0;
		}

		.col:before {
			color: #6C7A89;
			padding-right: 10px;
			content: attr(data-label);
			flex-basis: 50%;
			text-align: right;
		}
	}

	/* general styles */
	.menu, .menu ul {
	    list-style: none;
	    padding: 0;
	    margin: 0;
	}
	.menu {
	    height: 50px;
	}
	.menu li {
	    background: -moz-linear-gradient(#3a3938, #252525);
	    background: -ms-linear-gradient(gray, #252525);
	    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3a3938), color-stop(100%, #252525));
	    background: -webkit-linear-gradient(#3a3938, #252525);
	    background: -o-linear-gradient(#3a3938, #252525);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#292929', endColorstr='#252525');
	    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#292929', endColorstr='#252525')";
	    background: linear-gradient(#3a3938, #252525);

	    min-width: 160px;
	}
	.menu > li {
	    display: block;
	    float: left;
	    position: relative;
	}
	.menu > li:first-child {
	    border-radius: 5px 0 0;
	}
	.menu a {
	    color: #FFC300;
	    display: block;
	    font-size: 17px;
	    line-height: 40px;
	    padding: 0 25px;
	    text-decoration: none;
	}

	/* onhover styles */
	.menu li:hover {
	    background-color: #1c1c1c;
	    background: -moz-linear-gradient(#1c1c1c, #1b1b1b);
	    background: -ms-linear-gradient(#1c1c1c, #1b1b1b);
	    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #1c1c1c), color-stop(100%, #1b1b1b));
	    background: -webkit-linear-gradient(#1c1c1c, #1b1b1b);
	    background: -o-linear-gradient(#1c1c1c, #1b1b1b);
	    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1c1c1c', endColorstr='#1b1b1b');
	    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#1c1c1c', endColorstr='#1b1b1b')";
	    background: linear-gradient(#1c1c1c, #1b1b1b);
	}
	.menu li:hover > a {
	    border-radius: 5px 0 0 0;
	    color: #808080;
	}

	/* submenu styles */
	.submenu {
	    left: 0;
	    max-height: 0;
	    position: absolute;
	    top: 100%;
	    z-index: 0;

	    -webkit-perspective: 400px;
	    -moz-perspective: 400px;
	    -ms-perspective: 400px;
	    -o-perspective: 400px;
	    perspective: 400px;
	    width: 100%;

	}
	.submenu li {
	    opacity: 0;

	    -webkit-transform: rotateY(90deg);
	    -moz-transform: rotateY(90deg);
	    -ms-transform: rotateY(90deg);
	    -o-transform: rotateY(90deg);
	    transform: rotateY(90deg);

	    -webkit-transition: opacity .4s, -webkit-transform .5s;
	    -moz-transition: opacity .4s, -moz-transform .5s;
	    -ms-transition: opacity .4s, -ms-transform .5s;
	    -o-transition: opacity .4s, -o-transform .5s;
	    transition: opacity .4s, transform .5s;
	}
	.menu .submenu li:hover a {
	    border-left: 3px solid #454545;
	    border-radius: 0;
	    color: #ffffff;
	}
	.menu > li:hover .submenu, .menu > li:focus .submenu {
	    max-height: 2000px;
	    z-index: 10;
	}
	.menu > li:hover .submenu li, .menu > li:focus .submenu li {
	    opacity: 1;

	    -webkit-transform: none;
	    -moz-transform: none;
	    -ms-transform: none;
	    -o-transform: none;
	    transform: none;
	}

	/* CSS3 delays for transition effects */
	.menu li:hover .submenu li:nth-child(1) {
	    -webkit-transition-delay: 0s;
	    -moz-transition-delay: 0s;
	    -ms-transition-delay: 0s;
	    -o-transition-delay: 0s;
	    transition-delay: 0s;
	}
	.menu li:hover .submenu li:nth-child(2) {
	    -webkit-transition-delay: 50ms;
	    -moz-transition-delay: 50ms;
	    -ms-transition-delay: 50ms;
	    -o-transition-delay: 50ms;
	    transition-delay: 50ms;
	}
	.menu li:hover .submenu li:nth-child(3) {
	    -webkit-transition-delay: 100ms;
	    -moz-transition-delay: 100ms;
	    -ms-transition-delay: 100ms;
	    -o-transition-delay: 100ms;
	    transition-delay: 100ms;
	}
	.menu li:hover .submenu li:nth-child(4) {
	    -webkit-transition-delay: 150ms;
	    -moz-transition-delay: 150ms;
	    -ms-transition-delay: 150ms;
	    -o-transition-delay: 150ms;
	    transition-delay: 150ms;
	}

	.submenu li:nth-child(1) {
    -webkit-transition-delay: 350ms;
    -moz-transition-delay: 350ms;
    -ms-transition-delay: 350ms;
    -o-transition-delay: 350ms;
    transition-delay: 350ms;
	}
	.submenu li:nth-child(2) {
	    -webkit-transition-delay: 300ms;
	    -moz-transition-delay: 300ms;
	    -ms-transition-delay: 300ms;
	    -o-transition-delay: 300ms;
	    transition-delay: 300ms;
	}
	.submenu li:nth-child(3) {
	    -webkit-transition-delay: 250ms;
	    -moz-transition-delay: 250ms;
	    -ms-transition-delay: 250ms;
	    -o-transition-delay: 250ms;
	    transition-delay: 250ms;
	}
	.submenu li:nth-child(4) {
	    -webkit-transition-delay: 200ms;
	    -moz-transition-delay: 200ms;
	    -ms-transition-delay: 200ms;
	    -o-transition-delay: 200ms;
	    transition-delay: 200ms;
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


<ul class="menu">
    <li><a href="#s1">Rows Per Page</a>
        <ul class="submenu">
            <li><a href="{{ route('listTransactions', 10) }}">10</a></li>
            <li><a href="{{ route('listTransactions', 50) }}">50</a></li>
            <li><a href="{{ route('listTransactions', 100) }}">100</a></li>
            <li><a href="{{ route('listTransactions', 1000) }}">All</a></li>
        </ul>
    </li>
</ul>

<div class="container">
	<ul class="responsive-table">
		<li class="table-header">
			<div class="col col-4">Sender</div>
			<div class="col col-4">Recipient</div>
			<div class="col col-2">Amount</div>
			<div class="col col-4">Card</div>
			<div class="col col-4">Type</div>

		</li>
		@forelse ($transactions as $transact)
		    <li class="table-row">
				<div class="col col-4" data-label="user_id">{{ $name }}</div>
				<div class="col col-4" data-label="end_user">{{ $transact->end_user }}</div>
				<div class="col col-2" data-label="Amount">${{ $transact->amount }}</div>
				<div class="col col-4" data-label="Card">{{ $transact->card }}</div>
				<div class="col col-4" data-label="Type">{{ $transact->type }}</div>

			</li>
		@empty
		    <p style="text-align: center;">No transactions</p>
		@endforelse
	</ul>
	{{ $transactions->links() }}

</div>

@endsection

@section('script')
    
@endsection