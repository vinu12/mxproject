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
	
	
	var addUserForm = $("#addrating");
	var validator = addUserForm.validate({
	rules:{
			
			
			reasonrating :{ required : true },
			reporting : { required : true, selected : true},
			employeename : { required : true, selected : true},
			Rating : { required : true, selected : true}
			
			
		},
		messages:{
			reasonrating :{ required : "This field is required" },
			
			reporting : { required : "This field is required", selected : "Please select atleast one option" },
employeename : { required : "This field is required", selected : "Please select atleast one option" },
Rating : { required : "This field is required", selected : "Please select atleast one option" }
			
		}
	});
	
	
});
