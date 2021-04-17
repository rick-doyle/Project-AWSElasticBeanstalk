function myform_validation()
{
	var myform = document.form_vali;
	var filter=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(myform.name.value=="")
	{
		alert("Please Enter Name");
		document.form_vali.name.focus();
		return false;
	}
	if (!filter.test(myform.email.value))
  	{
		alert("Please enter a valid email address");
		document.form_vali.email.focus();
		return false;
	}
	if(myform.address.value=="")
	{
		alert("Please Enter address");
		document.form_vali.address.focus();
		return false;
	}
	
}

function myform1_validation()
{
	var myform = document.form_vali;
	if(myform.username.value=="")
	{
		alert("Please Enter Username");
		document.form_vali.username.focus();
		return false;
	}
	
	if(myform.password.value=="")
	{
		alert("Please Enter Password");
		document.form_vali.password.focus();
		return false;
	}
	
}
