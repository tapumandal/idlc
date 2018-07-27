
var deleteCheck = (function(){
	return {
        init: function () {
			$('.deleteButton').on('click',function(){
				var confirmValue = confirm("Are you sure! You want to delete this!");
				if (confirmValue == true) {
					return true;
				}else{
					return false;
				}
			});
		}
	};
})();

$(document).ready(function(){
	deleteCheck.init();
});