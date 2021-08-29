<table id="table" class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Регион</th>
        <th>Название</th>
        <th>Тип</th>
        <th>Ссылка</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>


<script>
    $(document).ready(function () {
        // alert(123)
        var table1 = $('#table').DataTable({
            "ajax": {
                "url": ''
            },
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'columns': [
                { data: 'id' },
                { data: 'region' },
                { data: 'name' },
                { data: 'type', render: (data, type) => { return data==='school'?'Школа':'УПО'} },
                { data: 'url', render: (data, type) => {
                    return '<a target="_blank" href="'+(data.indexOf("http") === 0 ?'':'http://xn--80aabfqjjba0cfdftira.xn--p1ai') + data + '">ссылка</a>';
                }}
            ],
            "pageLength": 25,
            // "searching": false,
            "lengthChange": false,
            // "info":     false,
            // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l>p<"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"i>>>',
            "dom": '<"top"f>rt<"bottom"lpi><"clear">',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Russian.json"
            },
        });

    })
</script>