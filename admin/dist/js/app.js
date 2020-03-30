$(document).ready(function () {

  $("#add-menu-form .imgInput").change(function () {
    var fileName = $(this).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    // var allow = ["jpg","jpeg"];
    if(ext == "jpg" || ext == "jpeg") {
      readURL(this);
      $("#add-menu-form .imgError").css("display", "none");
    }
    else {
      $("#add-menu-form .imgInput").val("");
      $("#add-menu-form .imgError").css("display", "block");
      $("#add-menu-form .imgError").html("Please upload file in these format only (jpg or jpeg)");
      $("#add-menu-form .upImg").attr('src', '');
    }
  });

  $("#edit-menu-form .imgInput").change(function () {
    var fileName = $(this).val();
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
    // var allow = ["jpg","jpeg"];
    if (ext == "jpg" || ext == "jpeg") {
      readURL2(this);
      $("#edit-menu-form .imgError").css("display", "none");
    } else {
      $("#edit-menu-form .imgInput").val("");
      $("#edit-menu-form .imgError").css("display", "block");
      $("#edit-menu-form .imgError").html("Please upload file in these format only (jpg or jpeg)");
      $("#edit-menu-form .upImg").attr('src', '');
    }
  });

  // MENU SECTION
  $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
  }, 'File size must be less than {0}');

  var tableMenu = $('#table-menu').DataTable({
    dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    "ajax": {
      "url": "menu_fetch.php",
    },
  });

  $('form[id="add-menu-form"]').validate({
    rules: {
      nama_menu: {required: true,minlength: 3},
      jenis: {required: true},
      stock: {required: true,digits: true},
      harga: {required: true,digits: true},
      image: {
        required: true,
        filesize: 300000,
      }
    },
    messages: {
      username: {required: 'This field is required', minlength: 'Username must be at least 3 characters long'},
      jenis: {required: 'This field is required'},
      stock: {required: 'This field is required'},
      harga: {required: 'This field is required'},
      image: {
        required: 'This field is required',
        filesize: " file size must be less than 300 KB.",
      }
    },
    submitHandler: function (form) {
      var data = new FormData(form)
      $.ajax({
        url: "menu_add.php",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "New menu added",  
          });
          $("#add-menu-form")[0].reset();
          $('#add-menu-modal').modal('toggle');
          tableMenu.ajax.reload();
        }
      });
    }
  });

  $('#table-menu').on('click', '.edit-menu', function () {
    var path = "../../../assets/images/menu/";
    var id = $(this).attr('data-menuId');
    $.ajax({
      type: 'post',
      url: 'menu_fetch_single.php',
      data: {id: id},
      dataType: 'json',
      success: function (data) {
        $("#edit-menu-modal").find("input[name='id']").val(data.id);
        $("#edit-menu-modal").find("input[name='nama_menu']").val(data.nama_menu);
        $("#edit-menu-modal").find("textarea[name='desc']").val(data.description);
        $("#edit-menu-modal").find("select[name='jenis']").val(data.jenis);
        $("#edit-menu-modal").find("input[name='harga']").val(data.harga);
        $("#edit-menu-modal").find("#upImg").attr("src", path + data.gambar);
      }
    });
  });

  $('form[id="edit-menu-form"]').validate({
    rules: {
      nama_menu: {required: true, minlength: 3},
      desc: {required: true, minlength: 3},
      jenis: {required: true},
      stock: {required: true,digits: true},
      harga: {required: true,digits: true},
      // image: {required: true}
    },
    messages: {
      nama_menu: {
        required: 'This field is required',
        minlength: 'Name must be at least 3 characters long'},
      desc : {},
      jenis: {required: 'This field is required'},
      stock: {required: 'This field is required'},
      harga: {required: 'This field is required'},
      image: {required: 'This field is required'}
    },
    submitHandler: function (form) {
      var data = new FormData(form)
      $.ajax({
        url: "menu_edit.php",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function () {
          swal.fire({
            icon: "success",
            title: "Menu updated",
          });
          tableMenu.ajax.reload();
          $('#edit-menu-modal').modal('toggle');
          $("#edit-menu-form")[0].reset();
          $("#edit-menu-form .imgInput").val("");
          $("#edit-menu-form .upImg").attr('src', '');
        }
      });
    }
  });

  $('#table-menu').on('click', '.del-menu', function () {
    var id = $(this).attr('data-menuId');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          url: 'menu_delete.php',
          data: {id: id},
          success: function () {
            tableMenu.ajax.reload();
            Swal.fire(
              'Deleted!',
              'Your menu has been deleted.',
              'success'
            )
          }
        });
      }
    })
  });
  // END MENU SECTION

  // MENU DETAIL SECTION
    if ($('#table-ing-detail').length) // use this if you are using id to check
      {
        var id = $('#menu_id').val()
        var tableIngDetail = $('#table-ing-detail').DataTable({
          "paging": false,
          "searching": false,
          "ajax": {
            "url": "menu_detail_fetch.php",
            "type": "POST",
            "data": {id: id}
          },
        });
      }

  $('form[id="add-menu-detail-form"]').validate({
    rules: {
      ingredient_id: {
        required: true
      },
      use_qty: {
        required: true,
        number: true,
        min: 1
      }
    },
    messages: {
      ingredient_id: {
        required: 'This field is required'
      },
      use_qty: {
        required: 'This field is required',
        number: 'This field must be numberic',
      },
    },
    submitHandler: function (form) {
      $.ajax({
        url: "menu_detail_add.php",
        type: "POST",
        data: $(form).serialize(),
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "New ingredient added",
          });
          $("#add-menu-detail-form")[0].reset();
          $('#add-menu-detail-modal').modal('toggle');
          tableIngDetail.ajax.reload();
        }
      });
    }
  });

  $('#table-ing-detail').on('click', '.edit-menu-det', function () {
    var id = $(this).attr('data-id');
    $.ajax({
      type: 'post',
      url: 'menu_detail_fetch_single.php',
      data: { id: id },
      dataType: 'json',
      success: function (response) {
        $("#edit-menu-detail-modal").find("input[name='id']").val(response.id);
        $("#edit-menu-detail-modal").find("select[name='ingredient_id']").val(response.ingredient_id);
        $("#edit-menu-detail-modal").find("input[name='use_qty']").val(response.use_qty);
      }
    });
  });

  $('form[id="edit-menu-detail-form"]').validate({
    rules: {
      ingredient_id: {
        required: true
      },
      use_qty: {
        required: true,
        number: true,
        min: 1
      }
    },
    messages: {
      ingredient_id: {
        required: 'This field is required'
      },
      use_qty: {
        required: 'This field is required',
        number: 'This field must be numberic',
      },
    },
    submitHandler: function (form) {
      $.ajax({
        url: "menu_detail_edit.php",
        type: "POST",
        data: $(form).serialize(),
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "Ingredient updated",
          });
          $("#edit-menu-detail-form")[0].reset();
          $('#edit-menu-detail-modal').modal('toggle');
          tableIngDetail.ajax.reload();
        }
      });
    }
  });

  $('#table-ing-detail').on('click', '.del-menu-det', function () {
    var id = $(this).attr('data-id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          url: 'menu_detail_delete.php',
          data: { id: id },
          success: function () {
            tableIngDetail.ajax.reload();
            Swal.fire(
              'Deleted!',
              'Ingredient has been deleted.',
              'success'
            )
          }
        });
      }
    })
  });

  // END MENU DETAIL SECTION

  // INGREDIENT SECTION
  var tableIng = $('#table-ing').DataTable({
    "ajax": {
      "url": "bahan_fetch.php"
    },
  });

  $('form[id="add-ing-form"]').validate({
    rules: {
      name: {
        required: true
      },
      unit: {
        required: true
      },
      qty: {
        required: true,
        number: true,
        min: 1
      }
    },
    messages: {
      name: {
        required: 'This field is required'
      },
      unit: {
        required: 'This field is required'
      },
      number: {
        required: 'This field is required',
        number: 'This field must be numberic',
      },
    },
    submitHandler: function (form) {
      $.ajax({
        url: "bahan_add.php",
        type: "POST",
        data: $(form).serialize(),
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "New ingredient added",
          });
          $("#add-ing-form")[0].reset();
          $('#add-ing-modal').modal('toggle');
          tableIng.ajax.reload();
        }
      });
    }
  });

  $('#table-ing').on('click', '.edit-ing', function () {
    var id = $(this).attr('data-ingId');
    $.ajax({
      type: 'post',
      url: 'bahan_fetch_single.php',
      data: {
        id: id
      },
      dataType: 'json',
      success: function (data) {
        $("#edit-ing-modal").find("input[name='id']").val(data.id);
        $("#edit-ing-modal").find("input[name='name']").val(data.name);
        $("#edit-ing-modal").find("input[name='unit']").val(data.unit);
        $("#edit-ing-modal").find("input[name='qty']").val(data.qty);
      }
    });
  });

  $('form[id="edit-ing-form"]').validate({
    rules: {
      name: {
        required: true
      },
      unit: {
        required: true
      },
      qty: {
        required: true,
        number: true,
        min: 1
      }
    },
    messages: {
      name: {
        required: 'This field is required'
      },
      unit: {
        required: 'This field is required'
      },
      number: {
        required: 'This field is required',
        number: 'This field must be numberic',
      },
    },
    submitHandler: function (form) {
      $.ajax({
        url: "bahan_edit.php",
        type: "POST",
        data: $(form).serialize(),
        success: function () {
          swal.fire({
            icon: "success",
            title: "Ingredient updated",
          });
          tableIng.ajax.reload();
          $('#edit-ing-modal').modal('toggle');
        }
      });
    }
  });

  $('#table-ing').on('click', '.del-ing', function () {
    var id = $(this).attr('data-ingId');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          url: 'bahan_delete.php',
          data: { id: id },
          success: function () {
            tableIng.ajax.reload();
            Swal.fire(
              'Deleted!',
              'Ingredient has been deleted.',
              'success'
            )
          }
        });
      }
    })
  });

  // END INGREDIENT SECTION

  // TABLE SECTION
  var tableMeja = $('#table-meja').DataTable({
    "ajax": {"url": "meja_fetch.php"},
  });

  $('form[id="add-meja-form"]').validate({
    rules: {
      nama_meja: {required: true},
      status: {required: true}
    },
    messages: {
      nama_meja: {required: 'This field is required'},
      status: {required: 'This field is required'},
    },
    submitHandler: function (form) {
      $.ajax({
        url: "meja_add.php",
        type: "POST",
        data: $(form).serialize(),
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "New table added",
          });
          $("#add-meja-form")[0].reset();
          $('#add-meja-modal').modal('toggle');
          tableMeja.ajax.reload();
        }
      });
    }
  });

  $('#table-meja').on('click', '.edit-meja', function () {
    var id = $(this).attr('data-mejaId');
    $.ajax({
      type: 'post',
      url: 'meja_fetch_single.php',
      data: {
        id: id
      },
      dataType: 'json',
      success: function (data) {
        $("#edit-meja-modal").find("input[name='kode_meja']").val(data.kode_meja);
        $("#edit-meja-modal").find("input[name='nama_meja']").val(data.nama_meja);
        $("#edit-meja-modal").find("select[name='status']").val(data.status);
      }
    });
  });

  $('form[id="edit-meja-form"]').validate({
    rules: {
      nama_meja: {required: true},
      status: {required: true}
    },
    messages: {
      nama_meja: {required: 'This field is required'},
      status: {required: 'This field is required'},
    },
    submitHandler: function (form) {
      $.ajax({
        url: "meja_edit.php",
        type: "POST",
        data: $(form).serialize(),
        success: function () {
          swal.fire({
            icon: "success",
            title: "Table updated",
          });
          tableMeja.ajax.reload();
          $('#edit-meja-modal').modal('toggle');
        }
      });
    }
  });

  $('#table-meja').on('click', '.del-meja', function () {
    var id = $(this).attr('data-mejaId');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          url: 'meja_delete.php',
          data: {id: id},
          success: function () {
            tableMeja.ajax.reload();
            Swal.fire(
              'Deleted!',
              'Table has been deleted.',
              'success'
            )
          }
        });
      }
    })
  });
  // END TABLE SECTION

  // USER SECTION
  var tableUser = $('#table-user').DataTable({
    "ajax": {"url": "user_fetch.php"},
  });

  $('form[id="add-user-form"]').validate({
    rules: {
      username: {required: true,minlength: 3},
      password: {required: true,minlength: 5},
      role: {required: true}
    },
    messages: {
      username: {required: 'This field is required',minlength: 'Username must be at least 3 characters long'},
      password: {minlength: 'Password must be at least 5 characters long'},
      role: {required: 'Please select role'}
    },
    submitHandler: function(form) {
      $.ajax({
        url: "user_add.php",
        type: "POST",
        data: $(form).serialize(),
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "New user added",
          });
          $("#add-user-form")[0].reset();
          $('#add-user-modal').modal('toggle');
          tableUser.ajax.reload();
        }
      });
    }
  });

  $('#table-user').on('click', '.edit-user', function () {
    var id = $(this).attr('data-userId');
    $.ajax({
      type: 'post',
      url: 'user_fetch_single.php',
      data: {id: id},
      dataType: 'json',
      success: function (data) {
        $("#edit-user-modal").find("input[name='id']").val(data.id);
        $("#edit-user-modal").find("input[name='username']").val(data.username);
        $("#edit-user-modal").find("input[name='password']").val(data.password);
        $("#edit-user-modal").find("select[name='role']").val(data.role);
      }
    });
  });

  $('form[id="edit-user-form"]').validate({
    rules: {
      username: {required: true,minlength: 3},
      password: {required: true,minlength: 5},
      role: {required: true}
    },
    messages: {
      username: {required: 'This field is required',minlength: 'Username must be at least 3 characters long'},
      password: {minlength: 'Password must be at least 5 characters long'},
      role: {required: 'Please select role'}
    },
    submitHandler: function(form) {
      $.ajax({
        url: "user_edit.php",
        type: "POST",
        data: $(form).serialize(),
        success: function (data) {
          swal.fire({
            icon: "success",
            title: "User updated",
          });
          $('#edit-user-modal').modal('toggle');
          tableUser.ajax.reload();
        }
      });
    }
  });

  $('#table-user').on('click', '.del-user', function () {
    var id = $(this).attr('data-userId');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          url: 'user_delete.php',
          data: {id: id},
          success: function () {
            tableUser.ajax.reload();
            Swal.fire(
              'Deleted!',
              'User has been deleted.',
              'success'
            )
          }
        });
      }
    })
  });
  // END USER SECTION 

  // PENJUALAN SECTION
    var tablePenjualan = $('#table-penjualan').DataTable({
      "ajax": {"url": "penjualan_fetch.php"},
      "order": [[0, "desc"]]
    });
  // END PENJUALAN SECTION
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#add-menu-form .upImg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#edit-menu-form .upImg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

// function loadUser() {
//   $.ajax({
//     type: 'POST',
//     url: 'employee_load.php',
//     success: function (data) {
//       $('.table-user-body').html(data);
//     }
//   });
// }