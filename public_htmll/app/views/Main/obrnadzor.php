<?php /*if(!empty($posts)): */?><!--
    <?php /*foreach($posts as $post): */?>
        <div class="content-grid-info">
            <img src="/blog/images/post1.jpg" alt=""/>
            <div class="post-info">
                <h4><a href="<?/*=$post->id;*/?>"><?/*=$post->title;*/?></a>  July 30, 2014 / 27 Comments</h4>
                <p><?/*=$post->excerpt;*/?></p>
                <a href="<?/*=$post->id;*/?>"><span></span><?php /*__('read_more');*/?></a>
            </div>
        </div>
    <?php /*endforeach; */?>
    <div class="text-center">
        <p>Статей: <?/*=count($posts);*/?> из <?/*=$total;*/?></p>
        <?php /*if($pagination->countPages > 1): */?>
            <?/*=$pagination;*/?>
        <?php /*endif; */?>
    </div>
<?php /*else: */?>
    <h3>Posts not found...</h3>
--><?php /*endif; */?>

<table id="table" class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Название организации</th>
        <th>Рег. номер</th>
        <th>Серия и номер бланка</th>
        <th>Решение о выдаче</th>
        <th>Срок действия</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    $(document).ready(function () {
        // alert(123)
        var table1 = $('#table').DataTable({
            "ajax": {
                "url": '/main/getDatatable'
            },
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'columns': [
                { data: 'id' },
                { data: 'name' },
                { data: 'reg' },
                { data: 'no' },
                { data: 'doc' },
                { data: 'date' },
                { data: 'status' },
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
