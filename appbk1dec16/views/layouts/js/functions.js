// JavaScript Document

//Function to show submenu when called
function displayDiv(id)
	{

		hideDiv(); //hide all other menus first
		if ($(id).is(":hidden")) {
		$(id).slideDown("slow");
		} else {
		$(id).slideUp();
		}
	}
	
function hideDiv()
	{
		var totalMenus = 2; //Change this value to the number of submenus
		for (var i=0;i<=totalMenus;i++){
			$('#catdiv'+i).slideUp("fast");
		}
	}