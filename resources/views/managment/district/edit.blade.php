@extends('layouts.idlc_aml.division_app')
@section('section')
<div class="panel panel-default col-sm-10 col-sm-offset-1 main_body">

	<div class="header">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<center><h2>District Update Page</h2></center>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="form-group ">
					<a href="{{route('districts.index')}}" class="btn btn-primary ">
					<i class="fa fa-arrow-left"></i> Beck</a>
				</div>
			</div>

		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default add_body">
				<!-- <div class="panel-heading">/div> -->
				<div class="panel-body">
					@foreach($findDistrict as $findvalue)
					<form action="{{route('districts.update',[$findvalue->district_id])}}" method="POST">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{!! method_field('PUT') !!}

							<div class="form-group add_input{{ $errors->has('division_name') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Division Name</span>
								</label>
								<div class="col-md-6 select ">
										<select class="form-control" type="select" name="division_id" >
											<option value="{{$findvalue->division_id}}">{{$findvalue->division_name}}</option>

											@foreach($divisionDetails as $value)
											<option value="{{$value->division_id}}">{{$value->division_name}}</option>
											@endforeach
									    </select>
									    @if($errors->has('division_name'))
											<span class="help-block">
												{{ $errors->first('division_name')}}
											</span>
										@endif
									</div>
							</div>

							<div class="form-group add_input{{ $errors->has('district_name') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">District name</span>
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="district_name" value="{{$findvalue->district_name}}">
									@if($errors->has('district_name'))
										<span class="help-block">
											{{ $errors->first('district_name')}}
										</span>
									@endif
								</div>
							</div>							

							<div class="form-group add_input">
								<div class="col-md-3 col-md-offset-4">
									<div class="select">
										<select class="form-control" type="select" name="isActive" >
											<option value="{{$findvalue->is_active}}">
                                                {{($findvalue->is_active == 1) ? "Active" : "Inactive"}}
                                            </option>
											<option  value="1" name="isActive" >Active</option>
											<option value="0" name="isActive" >Inactive</option>
									    </select>
									</div>
								</div>
							</div>
									
							<div class="form-group add_input">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary" style="margin-right: 15px;">Update
									</button>
								</div>
							</div>
					</form>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection