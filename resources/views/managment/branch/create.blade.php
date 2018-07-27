@extends('layouts.idlc_aml.division_app')
@section('section')
<div class="panel panel-default col-sm-10 col-sm-offset-1 main_body">

	<div class="header">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<center>
					<h2>Branch Add Page</h2>
				</center>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="form-group ">
					<a href="{{route('branchs.index')}}" class="btn btn-primary ">
					<i class="fa fa-arrow-left"></i> Beck</a>
				</div>
			</div>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default add_body">
				<div class="panel-body">
					<form action="{{route('branchs.store')}}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group add_input{{ $errors->has('bank_id') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Bank Name</span>
								</label>
								<div class="col-md-6 select ">
										<select class="form-control" type="select" name="bank_id" >
											<option value="">Choose division</option>
											@foreach($bankDetails as $bankValue)
												<option value="{{$bankValue->bank_id}}">{{$bankValue->bank_name}}</option>
											@endforeach
									    </select>

									    @if($errors->has('bank_id'))
											<span class="help-block">
												{{ $errors->first('bank_id')}}
											</span>
										@endif
									</div>
							</div>

							<div class="form-group add_input{{ $errors->has('branch_name') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Branch Name</span>
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control  input_required" name="branch_name" value="{{ old('branch_name')  }}" placeholder="District name">
									@if($errors->has('branch_name'))
										<span class="help-block">
											{{ $errors->first('branch_name')}}
										</span>
									@endif
								</div>
							</div>							

							<div class="form-group add_input">
								<div class="col-md-3 col-md-offset-4">
									<div class="select">
										<select class="form-control" type="select" name="isActive" >
											<option  value="1" name="isActive" >Active</option>
											<option value="0" name="isActive" >Inactive</option>
									    </select>
									</div>
								</div>
							</div>
									
							<div class="form-group add_input">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary" style="margin-right: 15px;">Submit
									</button>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection