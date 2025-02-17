$(document).ready(function () {
    let table = $("#suporteTable").DataTable({
        dom: '<"d-flex justify-content-between"<"d-flex align-items-center"l><f>>' +
            '<"table-responsive"t>' +
            '<"d-flex justify-content-between"<i><p>>',
        language: {
            lengthMenu: "Exibir _MENU_ registros por página",
            zeroRecords: "Nenhum registro encontrado",
            info: "Exibindo página _PAGE_ de _PAGES_",
            infoEmpty: "Nenhum registro disponível",
            infoFiltered: "(filtrado de _MAX_ registros no total)",
            search: "Buscar:",
            paginate: {
                previous: "Anterior",
                next: "Próximo",
            },
        },
        pageLength: 10,
    });

    $("#filter-tipo").on('change', function () {
        let tipo = $(this).val();
        table.column(3).search(tipo).draw();
    });

});
