$(document).ready(function(){
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function() {
        new Switchery($(this)[0], $(this).data());
    });

    var numberer_user = 1;
    dataTableComponent = $('#dataTableComponent').on('preXhr.dt', function ( e, settings, data ){
            numberer_user = data.start + 1;
            data.role_id = $('#filterSection [name=role_id]').val();

            $('.row .white-box').block({
                message: '<h3>Please Wait...</h3>',
                css: {
                    border: '1px solid #fff'
                }
            });
            return data;
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
            serverSide: true,
            bInfo: false,
            ajax: {
                url: document.app.site_url + '/user/get',
                type: 'POST'
            },
            language: {
                infoFiltered: ""
            },
            columns: [
                {
                    name: 'Number',
                    width: "5%",
                    orderable: false,
                    render: function ( data, type, full, meta ) {
                        return numberer_user++;
                    }
                },
                { data: "username" },
                { data: "email" },
                { data: "first_name" },
                { data: "last_name" },
                {
                    data: "status",
                    render: function ( data, type, full, meta ) {
                        var text = '<span class="label label-danger">deactivated</span>';
                        if(data == 1) text = '<span class="label label-success">activated</span>';
                        return text;
                    }
                },
                {
                    data: 'user_id',
                    width: "12%",
                    orderable: false,
                    render: function ( data, type, full, meta ) {
                        var button = [];
                        button.push('<button onclick="upd('+data+')" type="button" class="btn btn-info btn-outline btn-circle btn-sm m-r-5"><i class="ti-pencil-alt"></i></button>');

                        // hapus
                        button.push('<button onclick="del('+data+')" type="button" class="btn btn-danger btn-outline btn-circle btn-sm m-r-5"><i class="icon-trash"></i></button>');

                        // set access
                        button.push('<a href="'+document.app.site_url+'/user/role/index/'+data+'" class="btn btn-info btn-outline btn-circle btn-sm m-r-5"><i class="fa fa-list-ul"></i></a>');
                        return button.join('');
                    }
                }
            ]
        });
});


function add(){
    $('#FormData')[0].reset();
    formPopulate('#FormData', {
        user_id: 0
    })
    $('#formModal').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function upd(id){
    $('.preloader').fadeIn();
    $.ajax({
        method: "POST",
        url: document.app.site_url+'/user/get/byid/'+id
    })
    .done(function( response ) {
        $('.preloader').fadeOut();
        formPopulate('#FormData', response)
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
            url: document.app.site_url+'/user/app/save',
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
        text: "Anda akan menghapus data ini!",
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
                url: document.app.site_url+'/user/del/index/'+id
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
