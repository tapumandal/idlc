@extends('layouts.idlc_aml.division_app')
@section('section')
<div class="panel panel-default col-sm-10 col-sm-offset-1 main_body">

	<div class="header">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<center>
					<h2>Bank Add Page</h2>
				</center>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="form-group ">
					<a href="{{route('banks.index')}}" class="btn btn-primary ">
					<i class="fa fa-arrow-left"></i> Beck</a>
				</div>
			</div>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default add_body">
				<div class="panel-body">
					<form action="{{route('banks.store')}}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group add_input{{ $errors->has('bank_name') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Bank Name</span>
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="bank_name" value="{{ old('bank_name')  }}" placeholder="Bank Name">

									@if($errors->has('bank_name'))
										<span class="help-block">
											{{ $errors->first('bank_name')}}
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