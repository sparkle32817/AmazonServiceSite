var SnippetLogin=function(){
	var e=$("#m_login"),
		i=function(e,i,a){
			var l=$('<div class="m-alert m-alert--icon m-alert--outline alert alert-'+i+' alert-dismissible fade show" role="alert">' +
				'<div class="m-alert__icon"><i class="fa fa-warning"></i></div>' +
				'<span class="m-alert__text"></span>' +
				'<div class="m-alert__close">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>' +
				'</div>' +
				'</div>');
			e.find(".alert").remove();
				l.prependTo(e);
				l.find("span").html(a);
		};
	return{
		init:function(){
				$("#m_login_signin_submit").click(function(e){
					e.preventDefault();
					var a=$(this),
						l=$(this).closest("form");
					l.validate({
						rules:{
							lgin_username:{required:!0},
							lgin_password:{required:!0}
						}
					}),
					l.valid()&&(
						a.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
							l.ajaxSubmit({
								url:"",
								success:function(response){

									if (response=="admin")
									{
										window.location.replace(base_url+'admin');
									}
									else if(response=="employee")
									{
										window.location.replace(base_url+'employee');
									}
									else
									{
										a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
											i(l,"danger",response+"");
									}
								}
							})
					)}
				)
		}
	}
}();
jQuery(document).ready(function(){SnippetLogin.init()});