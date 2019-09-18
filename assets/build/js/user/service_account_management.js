$(document).ready(function () {

	$('#account_form').on('submit', function () {

		var seller_type = $('#account_seller_type').val();
		var person_name = $('#account_person_name').val();
		var person_phone = $('#account_person_phone').val();
		var person_email = $('#account_person_email').val();
		var person_contact = $('#account_person_contact').val();
		var manufacture = $("input:radio[name ='account_manufacture']:checked").val();
		var seller_name = $('#account_seller_name').val();
		var sales_year = $('#account_sales_year').val();
		var sales_revenue = $('#account_sales_revenue').val();
		var sku = $('#account_sku').val();
		var third_party = $("input:radio[name ='account_third_party']:checked").val();
		var fba = $("input:radio[name ='account_fba']:checked").val();
		var company = $('#account_company').val();

		if (person_name=='' || person_phone=='' || person_email=='' || person_contact=='' || seller_name==''
			|| sales_year=='' || sales_revenue=='' || company=='')
		{
			return;
		}

		$.ajax({
			url: base_url + 'user/services/AccountManagement/register',
			method: 'POST',
			data: {
				seller_type: seller_type,
				person_name: person_name,
				person_phone: person_phone,
				person_email: person_email,
				person_contact: person_contact,
				manufacture: manufacture,
				seller_name: seller_name,
				sales_year: sales_year,
				sales_revenue: sales_revenue,
				sku: sku,
				third_party: third_party,
				fba: fba,
				company: company
			},
			dataType: 'text',
			async: false,
			success: function (data) {

				if (data == 'success')
				{
					popUpToast('success', 'Thank you!\nWe have received your application, we will contact you when we are on-boarding the next round of new accounts.');
				}
				else if (data == 'already')
				{
					popUpToast('warning', 'We have already received your application.\nWe will notify you when we are on-boarding the next round of new accounts');
				}
				else
				{
					popUpToast('warning', 'Failed');
				}
			}
		});
		
		return;
	});
	
	$('#account_edit_btn').on('click', function () {

		if ($(this).text() != 'Edit')
		{
			return;
		}

		setTimeout(function () {
			$('#account_edit_btn').text('Save');
		}, 10);

		$('input').map(function () {

			$(this).attr('readonly', false);

			if ($(this).attr('type') == 'radio')
			{
				$(this).parent().removeClass('disabled');
				$(this).attr('disabled', false);
			}

		});

		$('select').map(function () {
			$(this).attr('disabled', false);
		});

	});

	$('#account_edit_form').on('submit', function () {

		if ($('#account_edit_btn').text()!='Save')
		{
			return;
		}

		var seller_type = $('#account_seller_type').val();
		var person_name = $('#account_person_name').val();
		var person_phone = $('#account_person_phone').val();
		var person_email = $('#account_person_email').val();
		var person_contact = $('#account_person_contact').val();
		var manufacture = $("input:radio[name ='account_manufacture']:checked").val();
		var seller_name = $('#account_seller_name').val();
		var sales_year = $('#account_sales_year').val();
		var sales_revenue = $('#account_sales_revenue').val();
		var sku = $('#account_sku').val();
		var third_party = $("input:radio[name ='account_third_party']:checked").val();
		var fba = $("input:radio[name ='account_fba']:checked").val();
		var company = $('#account_company').val();

		if (person_name=='' || person_phone=='' || person_email=='' || person_contact=='' || seller_name==''
			|| sales_year=='' || sales_revenue=='' || company=='')
		{
			return;
		}

		$.ajax({
			url: base_url + 'user/services/AccountManagement/update',
			method: 'POST',
			data: {
				seller_type: seller_type,
				person_name: person_name,
				person_phone: person_phone,
				person_email: person_email,
				person_contact: person_contact,
				manufacture: manufacture,
				seller_name: seller_name,
				sales_year: sales_year,
				sales_revenue: sales_revenue,
				sku: sku,
				third_party: third_party,
				fba: fba,
				company: company
			},
			dataType: 'text',
			async: false,
			success: function (data) {

				if (data == 'success')
				{
					$('#account_edit_btn').text('Edit');

					$('input').map(function () {

						$(this).attr('readonly', true);

						if ($(this).attr('type') == 'radio')
						{
							$(this).parent().addClass('disabled');
							$(this).attr('disabled', true);
						}

					});

					$('select').map(function () {
						$(this).attr('disabled', true);
					});

					popUpToast('success', 'Successfully updated.');
				}
				else
				{
					popUpToast('warning', 'Failed.');
				}
			}
		});

		return;
	});

	//--- Common ---//
	function popUpToast(status, message){

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "7000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		return toastr[status]( message );
	}

});
