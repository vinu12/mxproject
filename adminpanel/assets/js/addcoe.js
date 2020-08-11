/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author vinod K Maurya
 */

$(document).ready(function(){
	
	
	var addUserForm = $("#addcoe");
	var validator = addUserForm.validate({
	rules:{
			monthname :{ required : true , selected : true},
			
			noofcoe : { required : true },
			
			
			status : { required : true, selected : true}
			
			
		},
                    messages:{
			monthname : { required : "This field is required", selected : "Please select atleast one option" },
			noofcoe : { required : "This field is required", email : "Please enter no of coe" },
			
			status : { required : "This field is required", selected : "Please select atleast one option" }

			
		}
	});
	
	
});
