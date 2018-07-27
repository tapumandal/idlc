<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>{{ trans('others.company_name')}}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />

		{{-- for select2 --}}
	<link href="{{ asset("assets/customByMxp/css/select2.min.css") }}" rel="stylesheet" />
	<script src="{{ asset("assets/customByMxp/js/select2.min.js") }}"></script>
</head>
<body>
	<?php $languages = App\Http\Controllers\Trans\TranslationController::getLanguageList();?>
	<div class="row">
	<div class="col-md-2 col-sm-2 pull-right">
                    <select name="languageSwitcher" id="languageSwitcher" class="btn btn-primary form-control"  type="button">

                        @foreach($languages as $language)
                            <option class="Sbutton" value="{{ $language->lan_code }}" {{ ($language->lan_code == Session::get('locale')) ? 'selected' : '' }}>
                                                        {{ $language->lan_name }}
                                                    </option>
                        @endforeach
                        {{ csrf_field() }}
                    </select>
                    </div>
                    </div>

	@yield('body')

	<script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
	<script type="text/javascript" src="{{ asset("js/custom.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/all_product_table.js") }}"></script>
	<script type="text/javascript" src="{{ asset("js/journal.js") }}"></script>
</body>
</html>