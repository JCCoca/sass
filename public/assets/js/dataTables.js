Object.assign(DataTable.defaults, {
    serverSide: true,
    responsive: true,
    autoWidth: false,
    processing: false,
    searching: true,
    lengthChange: true,
    pageLength: 10,
    language: {
        sEmptyTable: 'Nenhum registro encontrado', 
        sInfo: 'Mostrando de <span class="fw-semibold">_START_</span> até <span class="fw-semibold">_END_</span> de <span class="fw-semibold">_TOTAL_</span> registros',
        sInfoEmpty: 'Mostrando <span class="fw-semibold">0</span> até <span class="fw-semibold">0</span> de <span class="fw-semibold">0</span> registros',
        sInfoFiltered: '(Filtrados de <span class="fw-semibold">_MAX_</span> registros)',
        sInfoPostFix: '',
        sInfoThousands: '.',
        sLengthMenu: '_MENU_ resultados por página',
        sLoadingRecords: 'Carregando...',
        sProcessing: 'Processando...',
        sZeroRecords: 'Nenhum registro encontrado',
        sSearch: 'Pesquisa',
        oPaginate: {
            sNext: 'Próximo',
            sPrevious: 'Anterior',
            sFirst: 'Primeiro',
            sLast: 'Último'
        },
        oAria: {
            sSortAscending: ': Ordenar colunas de forma ascendente',
            sSortDescending: ': Ordenar colunas de forma descendente'
        }
    },
    layout: {
        topStart: 'search',
        topEnd: 'pageLength',
        bottomStart: 'info',
        bottomEnd: 'paging'
    }
});

window.DataTable = DataTable;

window.myDataTable = (id, args = {}) => {
    let method = args['method'] ?? 'GET';
    let url = args['url'] ?? window.location.href;
    let dataType = args['dataType'] ?? 'json';
    let data = args['data'] ?? function(){};
    let columns = args['columns'] ?? [];

    return new DataTable(id, {
        ajax: {
            method: method,
            url: url,
            dataType: dataType,
            data: data,
            error(error) {
                let response = error.responseJSON;
                console.log(response.message);
            }
        },
        columns: columns
    });
};