<?php

//if (!function_exists('dd')) {
//    function dd()
//    {
//        array_map(function($x) {
//            dump($x);
//        }, func_get_args());
//        die;
//    }
//}

//if (!function_exists('dd')) {
//    function dd(...$vars)
//    {
//        foreach ($vars as $v) {
//            dump($v);
//        }
//
//        exit(1);
//    }
//}
function dt_ajax($table, $fields = []) {
    ## Read value
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length']; // Rows display per page
    $columnIndex = $_POST['order'][0]['column']; // Column index
    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
    $searchValue = $_POST['search']['value']; // Search value

    ## Search
    $searchQuery = " ";
    if($searchValue != ''){
        $sql = [];
        foreach ($fields as $field) $sql[] = "`$field` like '%" . $searchValue . "%'";
        $searchQuery = " and ( " . implode(' or ', $sql) . " ) ";
    }

    ## Total number of records without filtering
    if (is_array($table)) {
        $sql = [];
        foreach ($table as $item) $sql[] = "select count(*) as allcount from $item";
        $sel = implode(' UNION ', $sql);
    } else $sel = "select count(*) as allcount from $table";
    $records = \R::getRow($sel);
    $totalRecords = $records['allcount'];

    ## Total number of record with filtering
    if (is_array($table)) {
        $sql = [];
        foreach ($table as $item) $sql[] = "select count(*) as allcount from $item WHERE 1 ".$searchQuery;
        $sel = implode(' UNION ', $sql);
    } else $sel = "select count(*) as allcount from $table WHERE 1 ".$searchQuery;
    $records = \R::getRow($sel);
    $totalRecordwithFilter = $records['allcount'];

    ## Fetch records
    if (is_array($table)) {
        $sql = [];
        foreach ($table as $item) $sql[] = "select * from $item WHERE 1 ".$searchQuery;
        $empQuery = implode(' UNION ', $sql)." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    } else $empQuery = "select * from $table WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $empRecords = $empQuery;
    $data = array();

    foreach (\R::getAll($empRecords) as $row) {
        $dataset = [];
        foreach ($fields as $field) $dataset[$field] = $row[$field];
        $data[] = $dataset;
    }

    ## Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );
    echo json_encode($response);
}

if (! function_exists('varexport')) {
    function varexport($expression, $file = null)
    {
        $return = TRUE;
        $export = var_export($expression, TRUE);
        $patterns = [
            "/array \(/" => '[',
            "/^([ ]*)\)(,?)$/m" => '$1]$2',
            "/=>[ ]?\n[ ]+\[/" => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];
        $export = preg_replace(array_keys($patterns), array_values($patterns), $export);

        if ($file) {
            return file_put_contents($file, "<?php \n\nreturn $export;");
        }

        if ((bool)$return) return $export; else echo $export;
    }
}

if (! function_exists('config')) {
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return \fw\core\App::$config->all();//app('config');
        }

        if (is_array($key)) {
            return \fw\core\App::$config->set($key);
        }

        return \fw\core\App::$config->get($key, $default);
    }
}

if (! function_exists('now')) {
    /**
     * Create a new Carbon instance for the current time.
     *
     * @param  \DateTimeZone|string|null  $tz
     * @return \Illuminate\Support\Carbon
     */
    function now($tz = null)
    {
        return \Illuminate\Support\Carbon::now($tz);
//        return Date::now($tz);
    }
}

function debug($arr, $die = false){
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if($die) die;
}

function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit;
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

function __($key){
    echo \fw\core\base\Lang::get($key);
}