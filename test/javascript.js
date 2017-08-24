$(document).ready(function(){
	//OPEN IMAGE FROM LATEST IMAGES
	$("img").click(function(){
		var imgName = $(this).attr("src");
		$(".modal").show();
		$('.modalForImages').attr('src', imgName);
		alert(imgName);
	 })
	//CLOSE IMAGE FROM LATEST IMAGES
	$(".close").click(function(){
		$(".modal").hide();	
		$('.modalForImages').attr('src', "");
		alert(imgName);
	});
	//SEND THE COMMENTS 
	$(".addCommentSubmit").click(function(){
		event.preventDefault();
		var addCommentForm = $(".addCommentForm" ).serialize();
		var addCommentMessage = $('.addCommentMessage').val();
		var addCommentImage = $(".modalForImages").attr("src");
		$.ajax({
			type: "POST",
			url: "sendComment.php",
			dataType:'text',
			data:{
				addCommentMessage:addCommentMessage,
				addCommentImage:addCommentImage
			},
			success:function(response){
				if (response==true){
					alert("Коментирахте успешно");
					location.reload();
				}else{
					alert(response);
				}
			}	
		})
	})
	//ADMINISTRATIVE PART AND USER PART BUTTONS
	$(".enterAdmin").click(function(){
		$.ajax({
			type: "POST",
			url: "enterAdmin.php",
			dataType:'text',
			success:function(response){
				alert("Влезнахте в администраторската част");
			},
			error:function(response){
				alert("Грешка");
			}
		})
	});
	//USER PART AND USER PART BUTTONS
	$(".enterUser").click(function(){
		
		$.ajax({
			type: "POST",
			url: "enterUser.php",
			dataType:'text',
			success:function(response){
				alert("Влезнахте в потребителската част");
			},
			error:function(response){
				alert("Грешка");
			}
		})
	});
	//USED FOR SWITCHING BETWEEN LOGIN AND REGISTER PANELS
	$("#registerModalButtons").click(function(){
		$("#registerModal").show();
		$("#loginModal").hide();
	})
	$("#loginModalButtons").click(function(){
		$("#loginModal").show();
		$("#registerModal").hide();
	})
	//FOR REGISTERING
	$(".registerSubmit").click(function(){
		event.preventDefault();
		var registerForm = $("#registerForm" ).serialize();
		var registerName = $('.registerName').val();
		var registerPassowrd = $('.registerPassowrd').val();
		$.ajax({
			type: "POST",
			url: "register.php",
			dataType:'text',
			data:{
				registerName:registerName,
				registerPassowrd:registerPassowrd
			},
			success:function(response){
				if (response==true){
					alert("Вие се регистрирахте, можте да влезнете в профила си");
					location.reload();
				}else{
				alert(response);
				}
			}
		})
	});
	//FOR LOGGING IN
	$(".loginSubmit").click(function(){
		event.preventDefault();
		varloginForm = $("#loginForm" ).serialize();
		var loginName = $('.loginName').val();
		var loginPassowrd = $('.loginPassowrd').val();
		$.ajax({
			type: "POST",
			url: "login.php",
			dataType:'text',
			data:{
				loginName:loginName,
				loginPassowrd:loginPassowrd
			},
			success:function(response){
				if (response==true){
					alert("Влезнахте в акаунта си");
					location.reload();
				}else{
					alert(response);
				}
			}	
		})
	});
	//FOR LOGGING OUT
	$("#logoutButton").click(function(){
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "logout.php",
			dataType:'text',
			success:function(response){
				if (response==true){
					alert("Вие излезнахте от акаунта с");
					location.reload();
				}else{
				alert(response);
				}
			}
		})
	});
	//FOR SENDING MESSAGES IN CONTACTS
	$(".contactSubmit").click(function(){
		event.preventDefault();
		var contactForm = $(".contactForm" ).serialize();
		var contactName = $('.contactName').val();
		var contactEmail = $('.contactEmail').val();
		var contactMessage = $('.contactMessage').val();
		$.ajax({
			type: "POST",
			url: "sendMessage.php",
			dataType:'text',
			data:{
				contactName:contactName,
				contactEmail:contactEmail,
				contactMessage:contactMessage
			},
			success:function(response){
				if (response==true){
					alert("Вие изпратихте вашто съобщение");
					location.reload();
				}else{
				alert(response);
				}
			}
		})
	});
	//FOR EDITING PROFILE DATA
	$(".editProfileSubmit").click(function(){
		event.preventDefault();
		var editProfileForm = $(".editProfileForm" ).serialize();
		var editProfileName = $('.editProfileName').val();
		var editProfilePassowrd = $('.editProfilePassowrd').val();
		$.ajax({
			type: "POST",
			url: "editProfile.php",
			dataType:'text',
			data:{
				editProfileName:editProfileName,
				editProfilePassowrd:editProfilePassowrd
			},
			success:function(response){
				if (response==true){
					alert("Успешна промяна в данните");
					location.reload();
				}else{
				alert(response);
				}
			}
		})
	});
});
