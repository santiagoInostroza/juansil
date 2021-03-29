function on(eventName, selector, handler) {
    document.addEventListener(eventName, function (event) {
        const elements = document.querySelectorAll(selector);
        const path = event.composedPath();
        path.forEach(function (node) {
            elements.forEach(function (elem) {
                if (node === elem) {
                    handler.call(elem, event);
                }
            });
        });
    }, true);
}


//SELECT 2
$(document).ready(function () {
    $('.select2').select2({
        width: '100%'
    });
    $('.select2Mul').select2({
        closeOnSelect: false,
        width: '100%'
    });
});

//SLUG
$(document).ready(function () {
    $(".to_slug").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '.slug',
        space: '-'
    });
});


//ALERTA SWEET ALERT
$(document).on("submit", '.alerta_eliminar', function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Eliminar?',
        text: "No podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
})

//TEXT
ClassicEditor
    .create(document.querySelector('.ckeditor'))
    .catch(error => {
        console.log(error);
    });





function alerta(texto = "Ingresa texto", titulo = "Alerta!!") {
    var div = document.createElement("div");
    var h3 = document.createElement("h3");
    var p = document.createElement("p");
    var titulo = document.createTextNode(titulo)
    var contenido = document.createTextNode(texto);

    h3.appendChild(titulo);
    p.appendChild(contenido);
    div.appendChild(h3);
    div.appendChild(p);

    div.style.position = "fixed";
    div.style.top = "0px";
    div.style.left = "0";
    div.style.width = "100%";
    div.style.zIndex = "9999";

    div.classList.add('p-4');
    div.classList.add('bg-danger');
    div.classList.add('card');

    document.body.appendChild(div);



    setTimeout(function () {
        div.style.transition = "2s";
        div.style.opacity = "0";
        var padre = div.parentNode;
        setTimeout(function () {
            padre.removeChild(div);
        }, 2000);
    }, 3000);
}



// DATATABLES
$(document).ready(function () {
    $('.dataTable').DataTable({
        responsive: true,
        language: {
            "lengthMenu": "Mostrar " +
                `
                            <select class='custom-select custom-select-sm form-control dorm-control-sm'>
                                <option value='10'>10</option>
                                <option value='25'>25</option>
                                <option value='50' selected>50</option>
                                <option value='100'>100</option>
                                <option value='-1'>Todos</option>
                                </select>
                            ` +
                "  registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "", //"Página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            'search': 'Buscar',
            'paginate': {
                'next': 'siguiente',
                'previous': 'anterior'
            }
        },
        "paging": false,
        "bFilter": false,
    });


});


// LOADER
function mostrar_loader() {
    var div = document.createElement("div");
    var div2 = document.createElement("div");

    div.appendChild(div2);

    div.id = "loader-content";
    div2.id = "loader";
    document.body.appendChild(div);
}
function cerrar_loader() {
    eliminarElemento("#loader-content");
}
function eliminarElemento(selector) {
    var div = document.querySelector(selector);
    var padre = div.parentNode;
    padre.removeChild(div);
}



