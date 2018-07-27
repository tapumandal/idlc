@extends('layouts.idlc_aml.division_app')
@section('section')
<div class="panel panel-default col-sm-10 col-sm-offset-1 main_body">

	<div class="header">
		<div class="panel panel-default ">
			<div class="panel-heading">
				<center>
					<h2>Nationality Add Page</h2>
				</center>
			</div>
		</div>
	</div>

	<div class="panel-body">
		<div class="col-sm-12">
			<div class="col-sm-2">
				<div class="form-group ">
					<a href="{{route('nationalitys.index')}}" class="btn btn-primary ">
					<i class="fa fa-arrow-left"></i> Beck</a>
				</div>
			</div>
		</div>
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default add_body">
				<div class="panel-body">
					<form action="{{route('nationalitys.store')}}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group add_input{{ $errors->has('nationality') ? ' has-error' : ''}}">
								<label class="col-md-4 control-label">
									<span class="pull-right">Nationality</span>
								</label>
								<div class="col-md-6">
									<input type="text" class="form-control  input_required" name="nationality" value="{{ old('nationality')  }}" placeholder="Nationality">

									@if($errors->has('nationality'))
										<span class="help-block">
											{{ $errors->first('nationality')}}
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