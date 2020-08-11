/**
 * @author vinod Kumar Maurya
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "admin_adminusers/deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		alert(confirmation);
		
		
		if(confirmation==true)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) 
				{ alert("Budget deleted successfully"); }
				
			});
		}
		else 
		{ 
		alert("Budget deletion failed"); 
		}
				
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
