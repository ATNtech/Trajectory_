<table id="table" class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Название</th>
        <th>Название (доп.)</th>
<!--        <th>Полное название</th>-->
        <th>Адрес</th>
        <th>Координаты</th>
        <th>Организация</th>
        <th>Тип</th>
        <th>Картинка</th>
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
                { data: 'name' },
                { data: 'name_ex', render: (data) => {
                    if (!data) return data;
                    let obj = JSON.parse(data)
                    return Object.keys(obj).map((key) => obj[key]).join(' / ')
                } },
                // { data: 'address_name' },
                { data: 'full_name' },

                { data: 'point', render: (data) => {
                    if (!data) return data;
                    let obj = JSON.parse(data)
                    return Object.keys(obj).map((key) => obj[key]).join(',')
                } },
                { data: 'groups', render: (data) => {
                    if (!data) return data;
                    let obj = JSON.parse(data)[0];
                    return '<a target="_blank" href="https://2gis.ru/firm/'+obj.id+'">'+obj.id+'</a>'
                } },
                { data: 'purpose_name' },
                { data: 'external_content', render: (data) => {
                    if (!data) return data;
                    let obj = JSON.parse(data)[0];
                    if (!obj['main_photo_url'] === undefined) return '';
                    return '<img width="200" class="img-thumbnail" src="'+obj['main_photo_url']+'"/>'
                } },
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