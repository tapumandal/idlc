
var thanasDistrict = (function(){
	return {
        init: function () {
        	$('#division_id').on('change',function(){
				var selectedValue = $.trim($("#division_id").find(":selected").val());
				console.log(selectedValue);
				$.ajax({
		          type: "GET",
		          url: baseURL + "/get/division",
		          data: "district_id="+selectedValue,
		          datatype: 'json',
		          cache: false,
		          async: false,
		          success: function(result) {
		          	var data = JSON.parse(result);
		          	console.log(data);
		          	if(data.length === 0)
		              {
		              	$('#district_id').html($('<option>', {
		                      value: '',
		                      text : 'Choose District'
		                  }));

		              }else{
		              	$('#district_id').html($('<option>', {
		                    value: "",
		                    text : "Select District"
		                }));
		              	for(ik in data){
		                  $('#district_id').append($('<option>', {
		                      value: data[ik].district_id,
		                      text : data[ik].district_name
		                  }));
		                }
		              }
		          },
		          error:function(result){
		            alert("Some thing is Wrong");
		          }
		          });
			});
		}
	};
})();
$(document).ready(function(){
	thanasDistrict.init();
});