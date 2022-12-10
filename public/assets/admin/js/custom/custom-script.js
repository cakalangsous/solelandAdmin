/***

**************************************
**									**
**	starter-kit custom javascript	**
**									**
**			made by Benkin			**
**									**
**************************************

***/

// ready function begin
$(() => {

    $(".delete-role-form").submit((e) => {
        e.preventDefault();
		let role = e.target.dataset.role;
        swal({
            title: `Delete "${role}" role?`,
            text: "This role may be associated with user(s)!",
            icon: "error",
            buttons: {
                cancel: true,
                delete: "Yes, Delete this role!",
            },
        }).then(willDelete => {
			if(willDelete) {
				e.target.submit();
			}else {
				return false;
			}
		})
    });

    $(".delete-perm-form").submit((e) => {
        e.preventDefault();
		let perm = e.target.dataset.perm;
        swal({
            title: `Delete "${perm}" permission?`,
            text: "This permission may be associated with role(s)!",
            icon: "error",
            buttons: {
                cancel: true,
                delete: "Yes, Delete this permission!",
            },
        }).then(willDelete => {
			if(willDelete) {
				e.target.submit();
			}else {
				return false;
			}
		})
    });

	$(".delete-user-form").submit((e) => {
        e.preventDefault();
		let user = e.target.dataset.user;
        swal({
            title: `Delete user "${user}"?`,
            text: "This user may be associated with role!",
            icon: "error",
            buttons: {
                cancel: true,
                delete: "Yes, Delete this user!",
            },
        }).then(willDelete => {
			if(willDelete) {
				e.target.submit();
			}else {
				return false;
			}
		})
    });

    $('.user-banned').change(function (e) { 
        e.preventDefault();
        
        var status = $(this).prop('checked');
        
        let user = $(this).data('user');
        let name = $(this).data('name');

        let ban_text = status == true ? 'Banned':'UnBaned'
        let ban_cap = status == true ? `This user can't login anymore!` : 'This user can be logged in!'
        swal({
            title: `${ban_text} user "${name}"?`,
            text: ban_cap,
            icon: "warning",
            buttons: {
                cancel: true,
                delete: `Yes, ${ban_text} this user!`,
            },
        }).then(willDelete => {
			if(willDelete) {

                const url = `${base_url}/admin/users/ban`;
				$.ajax({
                    type: "POST",
                    url,
                    data: {_token: token, user, status},
                    dataType: "json",
                    success: function (res) {
                        if (res.status == true) {
                            swal({
                                title: `User ${name} is ${ban_text}`,
                                icon: 'success'
                            });
                            return;
                        }
                    }
                });
			}else {
				// e.target.removeAttribute('checked')
                $(this).prop('checked', false)
			}
		})
    });

    if (active === 'access') {
        let role_on_load = $('.tab a.active').data('role');
        getAccess(role_on_load);

        $('.tab a').click(function (e) {
            e.preventDefault();
            $('.access_loader').removeClass('hide');
            let role = $(this).data('role');

            $('.checkbox-table').addClass('hide');

            getAccess(role)
        });

        function getAccess(role) {
            let html = '';
            $.ajax({
                type: "POST",
                url: `${base_url}/admin/access/get_by_role`,
                data: {_token: token, role},
                dataType: "JSON",
                success: function (res) {
                    if (res.status===true) {
                        let group_name;
                        $.each(res.perms, function (index, value) {

                            // group_name = index.replace('_', ' ');
                            group_name = index.split('_').join(' ');
                            group_name = group_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            });
                            
                            html += `<tr>
                                        <td width="25%">
                                            <p>
                                                <label>
                                                    <input type="checkbox" class="parent ${index}-parent" data-target="${index}" />
                                                    <span>${group_name}</span>
                                                </label>
                                            </p>
                                        </td>`;
                            $.each(value, function (index2, value2) { 
                                let perm_check = '';
                                $.each(res.role_perms, function (roleIndex, roleValue) { 
                                    if (roleValue.id == value2.id) {
                                        perm_check = `checked="checked"`;
                                    }
                                });

                                html += `<td class="${index}">
                                            <p>
                                                <label>
                                                    <input type="checkbox" name="perms[]" value="${value2.id}" ${perm_check} data-parent="${index}" />
                                                    <span>${value2.name}</span>
                                                </label>
                                            </p>
                                        </td>`;
                            });

                            html += `</tr>`;
                        });
                        
                        $('.access_loader').addClass('hide');
                        $('.checkbox-table').html(html);
                        $('.checkbox-table').removeClass('hide');

                    };
                }
            });
        }
        $(document).on('click', 'input:checkbox', function(event) {
            check_group($(this))
        });

        function check_group(param_data) {
            const check_class = param_data.data('parent');
            const table_id = param_data.parents('table').attr('id');
            const total_checkbox = $(`table#${table_id} td.${check_class}`).length;
            const checked_checkbox = $(`table#${table_id} td.${check_class} input:checked`).length
            const checkbox_parent = $(`input:checkbox.${check_class}-parent`);
            
            if ((checked_checkbox < total_checkbox) && (checkbox_parent.attr('id')==undefined) ) {
                checkbox_parent.prop('checked', false);
                checkbox_parent.prop('indeterminate', true);
            } else {
                checkbox_parent.prop('indeterminate', false);
                checkbox_parent.prop('checked', true);
            }
    
            if (checked_checkbox == 0) {
                checkbox_parent.prop('indeterminate', false);
            }
        }
    }


    $(document).on('click', 'input:checkbox.parent', function(event) {
        let target = $(this).data('target');
        let state = $(this).prop('checked');

        $(`td.${target} input:checkbox`).prop('checked', state);
    });

    setTimeout(() => {
        $('.card-alert').slideUp('slow');
    },5000)

    // table builder
    $(document).on('click', '.add_btn', function (e) { 
        e.preventDefault();
        
        let html = `<div class="row">
                        <div class="input-field col s12 m4 l3">
                            <input type="text" name="field_name[]">
                            <label>Field Name</label>
                        </div>

                        <div class="input-field col s12 m4 l2">
                            <select class="select2" name="data_type[]">
                                <option value="">Data Type</option>
                                <option value="rectangle">Rectangle</option>
                                <option value="rombo">Rombo</option>
                                <option value="romboid">Romboid</option>
                                <option value="trapeze">Trapeze</option>
                                <option value="traible">Triangle</option>
                                <option value="polygon">Polygon</option>
                            </select>
                        </div>

                        <div class="input-field col s12 m2 l1">
                            <input type="number" name="length[]">
                            <label>Length</label>
                        </div>

                        <div class="input-field col s12 m2 l2">
                            <p>
                                <label>
                                    <input type="checkbox" name="primary_key[]" />
                                    <span>Primary Key</span>
                                </label>
                            </p>
                        </div>

                        <div class="input-field col s12 m2 l2">
                            <p>
                                <label>
                                    <input type="checkbox" name="nullable[]" />
                                    <span>Nullable</span>
                                </label>
                            </p>
                        </div>

                        <div class="input-field col s12 m4 l1">
                            <a href="javascript:void(0)" class="btn btn-small waves-effect waves-light center red darken-2 remove_btn">
                                <i class="material-icons center">remove</i>
                            </a>
                        </div>

                    </div>`;
        
        $('#new_field_wrapper').append(html);
        $('.select2').formSelect();
    });

    $(document).on('click', '.remove_btn', (e) => {
        e.target.closest('.row').remove();
    });

    $('.delete-form').submit(function(e) {
        e.preventDefault();
		let data = e.target.dataset.data;
        swal({
            title: `Delete data "${data}"?`,
            text: "This data can't be restored anymore!",
            icon: "error",
            buttons: {
                cancel: true,
                delete: "Yes, Delete this data!",
            },
        }).then(willDelete => {
			if(willDelete) {
				e.target.submit();
			}else {
				return false;
			}
		});
    });
}); // end ready function
