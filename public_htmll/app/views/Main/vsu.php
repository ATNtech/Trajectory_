<table id="table" class="table table-bordered">
    <thead>
    <tr>
        <th>Код</th>
        <th>Наименование специальности, направление подготовки</th>
        <th>Уровень образования</th>
        <th>Реализуемые формы обучения</th>
        <th>Описание ООП</th>
        <th>Учебный план</th>
        <th>Аннотации рабочих программ дисциплин с приложением копий</th>
        <th>Календарный учебный график</th>
        <th>Методические и иные документы</th>
        <th>Информации о практиках</th>
        <th>Использование электронного обучения</th>
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
                { data: 'Код' },
                { data: 'Наименование специальности, направление подготовки' },
                { data: 'Уровень образования' },
                { data: 'Реализуемые формы обучения' },
                { data: 'Описание ООП', render: (data, type) => { return '<a target="_blank" href="' + data + '">ссылка</a>' } },
                { data: 'Учебный план' },
                { data: 'Аннотации рабочих программ дисциплин с приложением копий' },
                { data: 'Календарный учебный график' },
                { data: 'Методические и иные документы' },
                { data: 'Информации о практиках' },
                { data: 'Использование электронного обучения' },
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