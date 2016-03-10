$(document).ready(function(){
	$(window).scroll(function(){
		
		var header = $("#header");
		
		if(header.offset().top > 30){
			header.addClass("sticky");
		}else{
			header.removeClass("sticky");
		}
	});
	
	$(".btn").tooltip();
	
	$(".table-row").click(function(){
		var etuId = $(this).attr("etu-id");
		var ensId = $(this).attr("ens-id");
		$(".table-row.success").removeClass("success");
		$(this).addClass("success");
		if(!isNaN(etuId)){
			$.ajax({
				url:"ajax",
				data:{
					id_etudiant:etuId
				},
				success:function(data){
					data = JSON.parse(data);
					var user = data.user;
					$("#nom").val(user.nom);
					$("#prenom").val(user.prenom);
					$("#telephone").val(user.tel);
					$("#email").val(user.email);
					$("#login").val(user.login);
					$("#password").val(user.password);
				}
			});
		}else if(!isNaN(ensId)){
			$.ajax({
				url:"ajax",
				data:{
					id_enseignant:ensId
				},
				success:function(data){
					data = JSON.parse(data);
					var user = data.user;
					$("#nom").val(user.nom);
					$("#prenom").val(user.prenom);
					$("#telephone").val(user.tel);
					$("#email").val(user.email);
					$("#login").val(user.login);
					$("#password").val(user.password);
				}
			});
		}
	});
	
});