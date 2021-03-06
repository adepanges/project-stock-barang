$(document).ready(function(){
    var numberer = 1;
    dataTableComponent = $('#dataTableComponent').on('preXhr.dt', function ( e, settings, data ){
            numberer = data.start + 1;
            $('.row .white-box').block({
                message: '<h3>Please Wait...</h3>',
                css: {
                    border: '1px solid #fff'
                }
            });
        }).on('xhr.dt', function ( e, settings, json, xhr ){
            $('.row .white-box').unblock();
            if(!document.datatable_search_change_event)
            {
                $("div.dataTables_filter input").unbind();
                $("div.dataTables_filter input").keyup( function (e) {
                    if (e.keyCode == 13) {
                        dataTableComponent.search( this.value ).draw();
                    }
                });
            }
            document.datatable_search_change_event = true;
        }).DataTable({
            language: {
                infoFiltered: ""
            },
            serverSide: true,
            bInfo: false,
            ajax: {
                url: document.app.site_url + '/user/role/get/' + user_role.user_id,
                type: 'POST'
            },
            columns: [
                {
                    name: 'Number',
                    width: "5%",
                    orderable: false,
                    render: function ( data, type, full, meta ) {
                        return numberer++;
                    }
                },
                { data: "role_label" },
                { data: "created_at" },
                {
                    data: 'user_role_id',
                    width: "12%",
                    orderable: false,
                    render: function ( data, type, full, meta ) {
                        var button = [];

                        button.push('<button onclick="del('+data+')" type="button" class="btn btn-danger btn-outline btn-circle btn-sm m-r-5"><i class="icon-trash"></i></button>');

                        return button.join('');
                    }
                }
            ]
        });


    // $('#userModal').on('hidden.bs.modal', function () {
    //     $(this).find('.switchery').click();
    // })
});

function add(){
    $('#FormData')[0].reset();
    formPopulate('#FormData', {
        user_id: user_role.user_id
    });
    $('#formModal').modal({
        backdrop: 'static',
        keyboard: false
    });
}

$('#btnSaveFormData').click(function(e){
    if(formValidator('#FormData')){
        var data = serialzeForm('#FormData');
        $('.preloader').fadeIn();
        $.ajax({
            method: "POST",
            url: document.app.site_url+'/user/role/add',
            data: data
        })
        .done(function( response ) {
            $('.preloader').fadeOut();
            var title = 'Berhasil!',
                timer = 1000;
                showConfirmButton = false;

            if(!response.status) {
                var timer = 3000;
                title = 'Gagal!';
                showConfirmButton = true;
            } else {
                $('#FormData')[0].reset()
                dataTableComponent.ajax.reload()
                $('#formModal').modal('toggle')
            }

            swal({
                title: title,
                text: response.message,
                timer: timer,
                showConfirmButton: showConfirmButton
            });
        });
    }
})

function del(id){
    swal({
        title: "Are you sure?",
        text: "Anda akan menghapus role ini!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
            $('.preloader').fadeIn();
            $.ajax({
                method: "POST",
                url: document.app.site_url+'/user/role/del/'+id
            })
            .done(function( response ) {
                $('.preloader').fadeOut();
                dataTableComponent.ajax.reload()
                var title = 'Berhasil!';
                if(!response.status) title = 'Gagal!';

                swal({
                    title: title,
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: true
                });
            });
        }
    });
}
