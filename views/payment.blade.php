@extends('hanoivip::layouts.app')

@section('title', 'Purchase with Vietnamese game cards')

@push('scripts')
    <script src="/js/tsr.js"></script>
@endpush

@section('content')

<script type="text/javascript">
var values_dynamic = {!! json_encode(Config::get('payment.tsr.values_dynamic')) !!}
</script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	@if (!empty($guide))
            		<div class="alert alert-info">
                		<p>Topup guide <a href="/blog/purchase-guidelines" target=”_blank”>here</a></p>
            		</div>
                @endif
                @if ($errors->has('error'))
                	<div class="alert alert-error">
                		<p >{{$errors->first('error')}}</p>
                	</div>
                @endif
                <div class="panel-body">
                    <form method="post" action="{{route('newtopup.do')}}" class="form-horizontal">
                    {{ csrf_field() }}
                    	<input type="hidden" id="trans" name="trans" value="{{$trans}}"/>
                    	<div class="form-group">
                        	<label class="col-md-4 control-label">Card type:</label>
                        	<div class="col-md-6">
                            	<select id="cardtype" name="cardtype">
                            		<option value="">Choose card type</option>
                            		@foreach (Config::get('payment.tsr.telco_static') as $cardtype => $title))
                            			<option value="{{$cardtype}}"  {{ old('cardtype') == $cardtype ? 'selected' : '' }}>{{$title}}</option>
                            		@endforeach 
                            	</select>
                            	@if ($errors->has('cardtype'))
                        			<span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('cardtype') }}</strong>
                                    </span>
                        		@endif 
                        	</div>
                    	</div>
                    	<div class="form-group">
                        	<label class="col-md-4 control-label">Card serial:</label>
                    		<div class="col-md-6">
                        		<input id="cardseri" name="cardseri" value="{{ old('cardseri') }}"/>
                        		@if ($errors->has('cardseri'))
                        			<span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('cardseri') }}</strong>
                                    </span>
                        		@endif 
                        	</div>
                    	</div>
                    	<div class="form-group">
                        	<label class="col-md-4 control-label">Card password:</label>
                        	<div class="col-md-6">
                        		<input id="cardpass" name="cardpass" value="{{ old('cardpass') }}"/>
                        		@if ($errors->has('cardpass'))
                        			<span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('cardpass') }}</strong>
                                    </span>
                        		@endif 
                        	</div>
                    	</div>
                    	<div class="form-group">
                        	<label class="col-md-4 control-label">Card amount (choose wrong penaltied 50%):</label>
                        	<div class="col-md-6">
                            	<select id="dvalue" name="dvalue">
                            		<option value="">Choose card value</option>
                            		{{--
                            		@foreach (Config::get('payment.tsr.values_static') as $value => $title)
                            			<option value="{{$value}}" {{ old('dvalue') == $value ? 'selected' : '' }}>{{$title}}</option>
                            		@endforeach
                            		--}}
                            	</select>
                            	@if ($errors->has('dvalue'))
                        			<span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('dvalue') }}</strong>
                                    </span>
                        		@endif 
                        	</div>
                    	</div>
                    	<div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                    			<button type="submit" class="btn btn-primary">OK</button>
                    		</div>
                		</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
