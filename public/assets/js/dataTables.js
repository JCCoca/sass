Object.assign(DataTable.defaults, {
    serverSide: true,
    responsive: true,
    autoWidth: false,
    processing: false,
    searching: true,
    lengthChange: true,
    pageLength: 10,
    pagingType: 'simple_numbers',
    language: {
        sEmptyTable: 'Nenhum registro encontrado', 
        sInfo: 'Mostrando de <span class="font-weight-bold">_START_</span> até <span class="font-weight-bold">_END_</span> de <span class="font-weight-bold">_TOTAL_</span> registros',
        sInfoEmpty: 'Mostrando <span class="font-weight-bold">0</span> até <span class="font-weight-bold">0</span> de <span class="font-weight-bold">0</span> registros',
        sInfoFiltered: '(Filtrados de <span class="font-weight-bold">_MAX_</span> registros)',
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

Object.assign(DataTable.ext.classes, {
    layout: {
        row: 'row justify-content-between',
        cell: 'd-md-flex justify-content-between align-items-center',
        tableCell: 'col-12',
        start: 'dt-layout-start col-md-auto mr-auto',
        end: 'dt-layout-end col-md-auto ml-auto',
        full: 'table-responsive'
    },
    paging: {
        active: 'current',
        button: 'dt-paging-button',
        container: 'dt-paging btn-sm',
        disabled: 'disabled',
        nav: ''
    }
});

window.DataTable = DataTable;

window.myDataTable = (id, args = {}) => {
    let method = args['method'] ?? 'GET';
    let url = args['url'] ?? window.location.href;
    let dataType = args['dataType'] ?? 'json';
    let data = args['data'] ?? function(){};
    let columns = args['columns'] ?? [];
    let ordering = args['ordering'] ?? true;

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
        ordering: ordering,
        columns: columns
    });
};