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
      $("#add-menu-form .imgError").html("Please upload file in these format only (jpg, jpeg, png)");
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
      $("#edit-menu-form .imgError").html("Please upload file in these format only (jpg, jpeg, png)");
      $("#edit-menu-form .upImg").attr('src', '');
    }
  });

  // MENU SECTION
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
      image: {required: true,}
    },
    messages: {
      username: {required: 'This field is required', minlength: 'Username must be at least 3 characters long'},
      jenis: {required: 'This field is required'},
      stock: {required: 'This field is required'},
      harga: {required: 'This field is required'},
      image: {required: 'This field is required'}
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
    var id = $(this).attr('data-menuId');
    $.ajax({
      type: 'post',
      url: 'menu_fetch_single.php',
      data: {id: id},
      dataType: 'json',
      success: function (data) {
        $("#edit-menu-modal").find("input[name='id']").val(data.id);
        $("#edit-menu-modal").find("input[name='nama_menu']").val(data.nama_menu);
        $("#edit-menu-modal").find("select[name='jenis']").val(data.jenis);
        $("#edit-menu-modal").find("input[name='stock']").val(data.stok);
        $("#edit-menu-modal").find("input[name='harga']").val(data.harga);
      }
    });
  });

  $('form[id="edit-menu-form"]').validate({
    rules: {
      nama_menu: {required: true,minlength: 3},
      jenis: {required: true},
      stock: {required: true,digits: true},
      harga: {required: true,digits: true},
      image: {required: true,}
    },
    messages: {
      username: {
        required: 'This field is required',
        minlength: 'Username must be at least 3 characters long'},
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
            title: "Meja updated",
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

// function loadMenu() {
//   var tableUser = $('#table-user').DataTable({
//     "ajax": {
//       "url": "menu_fetch.php",
//     },
//     // "columns": [ 
//     //   {"data": 'kode_menu'}, 
//     //   {"data": 'gambar'}, 
//     //   {"data": 'nama_menu'}, 
//     //   {"data": 'jenis'}, 
//     //   {"data": 'stok'}, 
//     //   {"data": 'harga'}, 
//     //   {"data": 'harga'}, 
//     // ],
//   });
// }

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

function loadUser() {
  $.ajax({
    type: 'POST',
    url: 'employee_load.php',
    success: function (data) {
      $('.table-user-body').html(data);
    }
  });
}