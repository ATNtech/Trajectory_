<table id="table" class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>shortname</th>
        <th>fullname</th>
        <th>site</th>
        <th>edudirection</th>
        <th>eduprogram</th>
        <th>federaldistrict</th>
        <th>region</th>
        <th>legaladdress</th>
        <th>submission</th>
        <th>headname</th>
        <th>phone</th>
        <th>email</th>
        <th>briefinformation</th>
        <th>regnumber</th>
        <th>taxpayernumber</th>
        <th>regcode</th>
        <th>type</th>
        <th>year</th>
        <th>address</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>


<script>
    $(document).ready(function () {
        // alert(123)
        var table1 = $('#table').DataTable({
            "ajax": {
                "url": '/main/getMinobr'
            },
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'columns': [
                { data: 'id' },
                { data: 'shortname' },
                { data: 'fullname' },
                { data: 'site' },
                { data: 'edudirection' },
                { data: 'eduprogram' },
                { data: 'federaldistrict' },
                { data: 'region' },
                { data: 'legaladdress' },
                { data: 'submission' },
                { data: 'headname' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'briefinformation' },
                { data: 'regnumber' },
                { data: 'taxpayernumber' },
                { data: 'regcode' },
                { data: 'type' },
                { data: 'year' },
                { data: 'address' },
            ],
            // "pageLength": 25,
            // "searching": false,
            "lengthChange": false,
            // "info":     false,
            // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l>p<"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"i>>>',
            "dom": '<"top"f>rt<"bottom"lpi><"clear">',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Russian.json"
            }
        });
    })
</script>