var ChangePassword=function(){
    i=function(e,i,a){
        var l=$('<div class="m-alert m-alert--icon m-alert--outline alert alert-'+i+' alert-dismissible fade show form-group" role="alert">' +
            '<span class="m-alert__text"></span>' +
            '<div class="m-alert__close">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>' +
            '</div>' +
            '</div>');
        e.find(".alert").remove(),
            l.prependTo(e),
            mUtil.animateClass(l[0],"fadeIn animated"),
            l.find("span").html(a)
    };
    return{
        init:function(){
                $("#change_password_submit").click(function(e){
                    alert('click');
                    e.preventDefault();
                    var change_btn=$(this),
                        form=$(this).closest("form");
                    form.validate({
                        rules:{
                            cur_password : {
                                required : !0
                                // minlength : 5
                            },
                            new_password : {
                                required : !0
                                // minlength : 5
                            },
                            confirm_password : {
                                required : !0
                                // minlength : 5,
                                // equalTo : "#new_password"
                            },
                        }
                    }),
                    form.valid()&&(
                        alert(form.attr('class')),
                        change_btn.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),
                            form.ajaxSubmit({
                                url : base_url + 'profile/password_update',
                                success:function(response){
                                    if (response=="ok")
                                    {
                                        change_btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                                            i(form,"success","Password is changed successfully.");

                                        form.clearForm();
                                        form.validate().resetForm();
                                    }
                                    else
                                    {
                                        change_btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),
                                            i(form,"danger","Current password is not correct. Please try again.");
                                    }
                                }
                            })
                    )
                })
        }
    }
}();
jQuery(document).ready(function(){
    // ChangePassword.init();
});