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
	
	
	var addUserForm = $("#addstaff");
	var validator = addUserForm.validate({
	rules:{
			fname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "admin_adminusers/checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			grade : { required : true, selected : true},
			reporting : { required : true, selected : true},
			department : { required : true, selected : true},
			division : { required : true, selected : true}
			
		},
		messages:{
			fname :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			password : { required : "This field is required" },
			cpassword : {required : "This field is required", equalTo: "Please enter same password" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			reporting : { required : "This field is required", selected : "Please select atleast one option" },
grade : { required : "This field is required", selected : "Please select atleast one option" },
department : { required : "This field is required", selected : "Please select atleast one option" },
division : { required : "This field is required", selected : "Please select atleast one option" }
			
		}
	});
	
	
});
