<?php

namespace app\controllers;

use app\models\Main;
use Curl\Curl;
use fw\libs\Cache;
use DGApiClient\ApiConnection;
use fw\core\App;
use fw\core\base\View;
use fw\libs\Pagination;
use phpQuery;

/**
 * Description of Main
 *
 */
class MainController extends AppController{

//    public ApiConnection $client;

    public function __construct($route)
    {
        parent::__construct($route);
//        $api_key = 'ruuwae3480'; // rurbbn3446
//        $this->client = new ApiConnection('');
//        $this->client->timeout = 50000;
//        $this->client->version = '3.0';
//        $this->client->url = '3.0';
        require LIBS . '/phpQuery.php';

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

    }

    public function indexAction() {
        $this->layout = 'blog_clean';
    }
    public function landAction() {

    }
    public function obrnadzorAction() {}
    public function minobrAction() {}
    public function vkAction() {
        if ($this->isAjax()) {
            dt_ajax('vk',['id', 'name', 'url', 'img']);
            die;
        }
    }
    public function dgisAction() {
        if ($this->isAjax()) {
            dt_ajax('dgis',['id', 'name','name_ex', 'timezone_offset', 'latlon']);
            die;
        }
    }

    public function vsuAction() {
        if ($this->isAjax()) {
            dt_ajax('basa',[
                'Код',
                'Наименование специальности, направление подготовки',
                'Уровень образования',
                'Реализуемые формы обучения',
                'Описание ООП',
                'Учебный план',
                'Аннотации рабочих программ дисциплин с приложением копий',
                'Календарный учебный график',
                'Методические и иные документы',
                'Информации о практиках',
                'Использование электронного обучения',
            ]);
            die;
        }
    }

    public function dgisschoolsAction() {
        if ($this->isAjax()) {
            dt_ajax('dgschools',[
                'id','name','name_ex','full_name','address_name','address','adm_div','external_content','point','org','purpose_name', 'groups']);
            die;
        }
    }
    public function dgiskindersAction() {
        if ($this->isAjax()) {
            dt_ajax('dgkinders',[
                'id','name','name_ex','full_name','address_name','address','adm_div','external_content','point','org','purpose_name', 'groups']);
            die;
        }
    }
    public function dgisvuzAction() {
        if ($this->isAjax()) {
            dt_ajax('dgvuz',[
                'id','name','name_ex','full_name','address_name','address','adm_div','external_content','point','org','purpose_name', 'groups']);
            die;
        }
    }
    public function dgisallAction() {
        if ($this->isAjax()) {
            dt_ajax('dgall',[
                'id','name','name_ex','full_name','address_name','address','adm_div','external_content','point','org','purpose_name', 'groups']);
            die;
        }
    }

    public function dgispAction() {
        set_time_limit(900);
        $dir = ROOT."/tmp/2gis/";
//        $file = 'result_school.txt';
//        $file = 'result_sadic.txt';
//        $file = 'result_sadic2.txt';
        $file = 'result_vuz.txt';
        $urls = explode("\n", file_get_contents($dir . $file));
        $cache = new Cache();
        $items = [];
//        $exclude = [2100,2101,2102,2103,2104,2105,2106,2107,2108,2109,2110,2111,2112,2113,2114,2115,2116,2117,2118,2119,2120,2121,2122,2123,2124,2125,2126,2127,2128];
//        $exclude = [2100,2101,2102,2103,2104,2105,2106,2107,2108,2109,2110,2111,2112,2113,2114,2115,2116,2117,2118,2119,2120,2121,2122,2123,2124,2125,2126,2127,2128];
        $exclude = [];
        foreach ($urls as $k => $url) {
            if (in_array($k, $exclude)) continue;
            if (empty($url)) continue;
            if(!$res = $cache->get($url)) {;
                $res = file_get_contents($url);
                $cache->set($url, $res, 3600*24*5);
            }
            if ($res === false) continue;
            $json_a = json_decode($res, true);
            if ($json_a === null) continue;
            try {
                $items = $json_a['result']['items'];
            } catch (\Exception $exception) {
                $exclude[] = $k;
                $cache->delete($url);
                continue;
            }
//            foreach($items as $item) {
//                $city = \R::dispense('dgvuz');
//                if (!empty($item['id'])) $city['uid'] = $item['id'];
//                if (!empty($item['address'])) $city['address'] = json_encode($item['address']);
//                if (!empty($item['address_name'])) $city['address_name'] = $item['address_name'];
//                if (!empty($item['adm_div'])) $city['address'] = json_encode($item['adm_div']);
//                if (!empty($item['external_content'])) $city['external_content'] = json_encode($item['external_content']);
//                if (!empty($item['flags'])) $city['flags'] = json_encode($item['flags']);
//                if (!empty($item['full_name'])) $city['full_name'] = $item['full_name'];
//                if (!empty($item['geometry'])) $city['geometry'] = json_encode($item['geometry']);
//                if (!empty($item['group'])) $city['groups'] = json_encode($item['group']);
//                if (!empty($item['links'])) $city['links'] = json_encode($item['links']);
//                if (!empty($item['name'])) $city['name'] = $item['name'];
//                if (!empty($item['name_ex'])) $city['name_ex'] = json_encode($item['name_ex']);
//                if (!empty($item['org'])) $city['org'] = json_encode($item['org']);
//                if (!empty($item['point'])) $city['point'] = json_encode($item['point']);
//                if (!empty($item['purpose_name'])) $city['purpose_name'] = $item['purpose_name'];
//                if (!empty($item['reviews'])) $city['reviews'] = json_encode($item['reviews']);
//                if (!empty($item['rubrics'])) $city['rubrics'] = json_encode($item['rubrics']);
//                if (!empty($item['schedule'])) $city['schedule'] = json_encode($item['schedule']);
//                if (!empty($item['stat'])) $city['stat'] = json_encode($item['stat']);
//                if (!empty($item['timezone_offset'])) $city['timezone_offset'] = $item['timezone_offset'];
//                if (!empty($item['type'])) $city['type'] = $item['type'];
//                $city['request_url'] = $url;
//                \R::store($city);
//            }
        }
        dd('ok', $exclude);
        $items = [];
        $dir = ROOT."/tmp/2gisMETA/";
        foreach (array_diff(scandir($dir), ['..', '.']) as $file) {
            $string = file_get_contents($dir . $file);
            if ($string === false) continue;
            $json_a = json_decode($string, true);
            if ($json_a === null) continue;
            $items = array_merge($items, $json_a['result']['items']);
        }
        dd($items);

        foreach($items as $item) {
            $city = \R::dispense('dgis');
            if (!empty($item['id'])) $city['uid'] = $item['id'];
            if (!empty($item['name'])) $city['name'] = $item['name'];
            if (!empty($item['rubr'])) $city['rubr'] = $item['rubr'];
            if (!empty($item['source_type'])) $city['source_type'] = $item['source_type'];
            if (!empty($item['timezone_offset'])) $city['timezone_offset'] = $item['timezone_offset'];
            if (!empty($item['type'])) $city['type'] = $item['type'];
            if (!empty($item['lat'])) $city['latlon'] = "{$item['lat']},{$item['lon']}";
            if (!empty($item['name_ex'])) $city['name_ex'] = json_encode($item['name_ex']);
            if (!empty($item['reviews'])) $city['reviews'] = json_encode($item['reviews']);
            if (!empty($item['schedule'])) $city['schedule'] = json_encode($item['schedule']);
            \R::store($city);
        }
        dd('ok');
    }

    public function obrrosAction() {
        if ($this->isAjax()) {
//            $data = [];
//            foreach (\R::findAll('obrros') as $item) {
//                $data[] = [
//                    $item['id'],
//                    $item['region'],
//                    $item['name'],
//                    $item['type']=='school' ? 'Школа' : 'УПО',
//                    strpos($item['url'],'http')!==false ?
//                        '<a href="'.$item['url'].'">ссылка</a>':
//                        '<a href="http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$item['url'].'">ссылка</a>',
//                ];
//            }
//            header('Content-Type: application/json');
//            echo json_encode(['data' => $data]);
            dt_ajax('obrros',['id', 'region', 'name', 'type', 'url']);
            die;
        }
    }

    public function obrrosParseAction() {
        $obrros = \R::findOne('obrros','name = ?', ['Гимназия №202 "Менталитет"']);
        $url = $obrros['url'];
        $cache = new Cache();
        $url = strpos($url, 'http') !== false ? $url : "http://xn--80aabfqjjba0cfdftira.xn--p1ai{$url}";
        if(!$res = $cache->get($url)) {
            $curl = new Curl();
            $res = $curl->get($url);
            $curl->close();
            $cache->set($url, $res, 3600*24*5);
        }
        $doc = phpQuery::newDocument($res);
        $district = trim($doc->find('.obrros_center strong a:nth-child(2)')->text());
        $city = trim($doc->find('.obrros_center strong a:nth-child(3)')->text());
        $address = trim($doc->find('h1')->next('div')->text());
        dd($obrros, $url,$city,$district, $address);
        dd(123);
    }

    public function obrrosUpoAction() {
        $url = 'http://xn--80aabfqjjba0cfdftira.xn--p1ai/upo';
        $cache = new Cache();
        $data = [];
        if(!$res = $cache->get($url)) {
            $curl = new Curl();
            $res = $curl->get($url, $data);
            $curl->close();
            $cache->set($url, $res, 3600*24*5);
        }
        $res2 = $this->parse3($res);
//        dd($res2);
        foreach ($res2 as $region => $schools) {
            foreach ($schools as $name => $url) {
                $obrros = \R::dispense('obrros');
                $obrros->region = $region;
                $obrros->name = $name;
                $obrros->type = 'upo';
                $obrros->url = $url;
                \R::store($obrros);
            }
        }
        dd($res2);
    }
    public function obrrosSchooldsAction() {
        $url = 'http://xn--80aabfqjjba0cfdftira.xn--p1ai/schools';

        $cache = new Cache();
        $data = [];

        if(!$res = $cache->get($url)) {
            $curl = new Curl();
            $res = $curl->get($url, $data);
            $curl->close();
            $cache->set($url, $res, 3600*24*5);
        }
        if(!$res2 = $cache->get('obrros.schools')) {
            $res2 = $this->parse2($res);
            $cache->set('obrros.schools', $res2, 3600*24*5);
        }

//        dd($res2);
//        foreach ($res2 as $region => $schools) {
//            foreach ($schools as $name => $url) {
//                $obrros = \R::dispense('obrros');
//                $obrros->region = $region;
//                $obrros->name = $name;
//                $obrros->type = 'school';
//                $obrros->url = $url;
//                \R::store($obrros);
//            }
//        }
        dd($res2);
    }

    public function getDatatableAction() {
        dt_ajax('govobrnadzor',['id', 'name', 'reg', 'no', 'doc', 'date', 'status']);
        die;
    }

    public function getMinobrAction() {
        dt_ajax('minobr',[
            'id', 'shortname', 'fullname', 'site', 'edudirection', 'eduprogram', 'federaldistrict',
            'region', 'legaladdress', 'submission', 'headname', 'phone', 'email', 'briefinformation',
            'regnumber', 'taxpayernumber', 'regcode', 'type', 'year', 'address'
        ]);
        die;
    }

    public function parseAction() {
        set_time_limit(900);
        $url = 'http://isga.obrnadzor.gov.ru/rlic/search/?page=';
        $cache = new Cache();
dd(1);
        foreach (\R::getCol('select id from govlicenseorgan where id >= 40') as $organ) {
//            ob_start(); region_id=45 and licenseorgan_id=40
            foreach (\R::getCol('select id from govregions where id > 45') as $region) {
                $data = ['regionId' => $region,'licenseOrganId' => $organ];
                $key = "{$organ}-{$region}-gov";
//                echo $key . '<br>';
                $page = 1;

                if(!($res = $cache->get($key))) {
                    if(!$res2 = $cache->get("$key-$page")) {
                        $curl = new Curl();
                        $res2 = $curl->post($url . $page, $data);
                        $curl->close();
                        $res2 = $this->parse($res2);
                        $cache->set("$key-$page", $res2, 3600*24*5);
                    }
                    $items = $res2['items'];
                    $total = $res2['total'];
                    if ($res2) {
                        if (count($items) == 10 && count($items) < $total) {
                            while (count($items) < $total) {
                                $page++;
                                if(!$res2 = $cache->get("$key-$page")) {
                                    $curl = new Curl();
                                    $res2 = $curl->post($url . $page, $data);
                                    $curl->close();
                                    $res2 = $this->parse($res2);
                                    $cache->set("$key-$page", $res2, 3600*24*5);
                                }
                                $items = array_merge($items, $res2['items']);
                            }
                            $res['items'] = $items;
                        }
                    }
                    $res['items'] = $items;
                    $res['total'] = $total;
                    $cache->set($key, $res, 3600*24*5);

                }
//dd(count($res['items'])); //110688
                if (!empty($res['items'])) {
//                    $ct = 0;
                    foreach ($res['items'] as $item) {
//                        $ct++;
//                        if ($ct < 2541) continue;
                        $city = \R::dispense('govobrnadzor');
                        $city->name = $item[0];
                        $city->reg = $item[1];
                        $city->no = $item[2];
                        $city->doc = $item[3];
                        $city->date = $item[4];
                        $city->status = $item[5];
                        $city->region_id = $region;
                        $city->licenseorgan_id = $organ;
                        \R::store($city);
                    }
                }
            }
//            ob_end_flush();

//            $organ = \R::load('govlicenseorgan', $organ);
//            $organ->loaded = 1;
//            \R::store($organ);

        }



        dd('ok');
        die;

//        if(!$res = $cache->get($key)) {
//            $res = $this->client->send($source, $data);
//            $total = $res['total'];
//            $items = $res['items'];
//            if (count($items) == 10 && count($items) < $total) {
//                while (count($items) < $total) {
//                    if (empty($data['page'])) $data['page'] = 2;
//                    else $data['page']++;
//                    $res = $this->client->send($source, $data);
//                    $items = array_merge($items, $res['items']);
//                }
//                $res['items'] = $items;
//            }
//            $cache->set($key, $res, 3600*24*5);
//        }
    }

    private function parse($html) {
        $doc = phpQuery::newDocument($html);
        $total = preg_replace("#.+\((\d+)\)#si", "$1", $doc->find('h3')->text());
        if ($total=='Ничего не найдено') return [
            'total' => 0,
            'items' => []
        ];;

        $table = $doc->find('table')[0];
        $rows = [];
        foreach ($table->find('tbody tr') as $tr) {
            $tr = pq($tr);
            $rows[] = [
                $tr->find('td:nth-child(1)')->text(),
                $tr->find('td:nth-child(2)')->text(),
                $tr->find('td:nth-child(3)')->text(),
                $tr->find('td:nth-child(4)')->text(),
                $tr->find('td:nth-child(5)')->text(),
                $tr->find('td:nth-child(6)')->text(),
            ];
        }

        return [
            'total' => $total,
            'items' => $rows
        ];
    }

    private function parse2($html) {
        $doc = phpQuery::newDocument($html);
        $table = $doc->find('.obrros_content table')[0];
        $rows = [];
        foreach ($table->find('tr') as $tr) {
            $tr = pq($tr);
            foreach ($tr->find('td a') as $td) {
                $td = pq($td);
                $rows[$td->text()] = $this->parse2add($td->attr('href'));
            }
        }
        return $rows;
    }

    private function parse3($html) {
        $doc = phpQuery::newDocument($html);
        $table = $doc->find('.obrros_content table')[0];
        $rows = [];
        foreach ($table->find('tr') as $tr) {
            $tr = pq($tr);
            foreach ($tr->find('td a') as $td) {
                $td = pq($td);
                $rows[$td->text()] = $this->parse3add($td->attr('href'));
            }
        }
        dd($rows);
        return $rows;
    }

    private function parse3add($url, $page = 0) {
        $data = [];
        $cache = new Cache();

        if(!$res = $cache->get('http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$url)) {
            $curl = new Curl();
            $res = $curl->get('http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$url, $data);
            $curl->close();
            $cache->set('http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$url, $res, 3600*24*5);
        }

        $doc = phpQuery::newDocument($res);
        $table = $doc->find('.obrros_content .obrros_center')[0];
        $rows = [];
//        $pages = $table->find('tr td:nth-child(2) a:last')[0]->attr('href');
//        $pages = preg_replace("#.+page\=(\d+)#si", "$1", $pages);
//        if (!$pages) $pages = 0;

        foreach ($table->find('a') as $a) {
            $a = pq($a);
            $href = $a->attr('href');
//            if (strpos($href,'page=')!==false)  continue;
//            if (!is_numeric($a->text())) {
                $rows[$a->text()] = $href;
//            }
        }
//        dd($rows);
//        if ($page == 0) $url .= '&page=0';
//        if ($page < $pages) {
//            $new_page = $page+1;
//            $r = $this->parse2add(str_replace('page='.$page, 'page='.$new_page, $url), $new_page);
//            if ($new_page==1) dd($rows,$r,$rows + $r);
//            $rows = $rows + $r;
//        }

        return $rows;
    }

    private function parse2add($url, $page = 0) {
        $data = [];
        $cache = new Cache();

        if(!$res = $cache->get('http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$url)) {
            $curl = new Curl();
            $res = $curl->get('http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$url, $data);
            $curl->close();
            $cache->set('http://xn--80aabfqjjba0cfdftira.xn--p1ai'.$url, $res, 3600*24*5);
        }

        $doc = phpQuery::newDocument($res);
        $table = $doc->find('.obrros_content table')[0];
        $rows = [];
        $pages = $table->find('tr td:nth-child(2) a:last')[0]->attr('href');
        $pages = preg_replace("#.+page\=(\d+)#si", "$1", $pages);
        if (!$pages) $pages = 0;

        foreach ($table->find('tr td:nth-child(2) a') as $a) {
            $a = pq($a);
            $href = $a->attr('href');
            if (strpos($href,'page=')!==false)  continue;
            if (!is_numeric($a->text())) {
                $rows[$a->text()] = $href;
            }
        }
        if ($page == 0) $url .= '&page=0';
        if ($page < $pages) {
            $new_page = $page+1;
            $r = $this->parse2add(str_replace('page='.$page, 'page='.$new_page, $url), $new_page);
//            if ($new_page==1) dd($rows,$r,$rows + $r);
            $rows = $rows + $r;
        }

        return $rows;
    }

    function get_c($url, $post = 0,$auth = false) {
        $agent= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 YaBrowser/21.6.4.786 Yowser/2.5 Safari/537.36';
//        $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_URL, $url ); // отправляем на
        curl_setopt($ch, CURLOPT_HEADER, 0); // пустые заголовки
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // возвратить то что вернул сервер
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // следовать за редиректами
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);// таймаут4
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);// просто отключаем проверку сертификата

        // referer: https://savesubs.com/process?url=https://youtu.be/5tcs2qXP3Pg
        curl_setopt($ch, CURLOPT_REFERER, 'http://isga.obrnadzor.gov.ru/rlic/'); //'https://savesubs.com/process?url=https://youtu.be/5tcs2qXP3Pg');
        curl_setopt($ch,CURLOPT_HTTPHEADER,[
            'Origin: http://isga.obrnadzor.gov.ru',
            'Host: isga.obrnadzor.gov.ru',
'Accept: text/html, */*; q=0.01',
'Cookie: PHPSESSID=l355gto6aasa1scs9gknr90nu7',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8'
//            'Accept-Encoding: gzip, deflate'
//            ':authority: isga.obrnadzor.gov.ru',
//            ':method: POST',
//            ':path: /rlic/'
        ]);

        if ($auth)
            curl_setopt($ch, CURLOPT_COOKIEJAR,  '/var/www/html/my_cookies.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE,  '/var/www/html/my_cookies.txt');

        curl_setopt($ch, CURLOPT_POST, $post !== 0);
        if ($post) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        }
        $data = curl_exec($ch);
        curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        return $data;
    }








    public function _aindexAction() {
//        $string = file_get_contents(WWW."/list.json");
//        if ($string === false) {
//            // deal with error...
//        }
//
//        $json_a = json_decode($string, true);
//        if ($json_a === null) {
//            // deal with error...
//        }
//        foreach($json_a['result']['items'] as $item) {
////         dd($item);
//            \R::exec('insert into citiesdgis(id) values('.$item['id'].')');
//            $city = \R::dispense('citiesdgis');
//            $city->id = $item['id'];
//            $city->name = $item['name'];
//            $city->type = $item['type'];
//            \R::store($city);
//        }
//        dd('ok');

//        dd($client->getRequest('items'));

        $source = 'items';
//        $source = 'region/list'; //Поиск региона
        $q = [
            'вуз,техникум,колледж,институт,МОУ СОШ,гимназия,лицей,школа с углубленным изучением',
            'спортивная школа,спортивная секция,музыкальная школа,творческий кружок,профессиональный кружок,онлайн-школа,онлайн-кружок,онлайн-университет'
        ];

        foreach (\R::getCol('select id from citiesdgis') as $region_id) {
            $data = [
                'q' => $q[0],
                'type' => 'branch',
                'region_id' => $region_id
            ];
            $res = $this->getData('items', $data);
            debug($res);
            $data = [
                'q' => $q[1],
                'type' => 'branch',
                'region_id' => $region_id
            ];
            $res = $this->getData('items', $data);
            debug($res);
        }



        dd('ok');
    }

    public function getData($source = 'items', $data = []) {
        $cache = new Cache();
        $key = $this->client->getRequest($source, $data);
        if(!$res = $cache->get($key)) {
//            $res = $this->client->send($source, $data);
//            $total = $res['total'];
//            $items = $res['items'];
//            if (count($items) == 10 && count($items) < $total) {
//                while (count($items) < $total) {
//                    if (empty($data['page'])) $data['page'] = 2;
//                    else $data['page']++;
//                    $res = $this->client->send($source, $data);
//                    $items = array_merge($items, $res['items']);
//                }
//                $res['items'] = $items;
//            }
//            $cache->set($key, $res, 3600*24*5);
        }
//        echo '<code style="color: darkred; font-weight:bold; border: 1px dashed gray; padding: 3px;">'.$key . '</code>';
        return $res;
    }

    public function _indexAction(){
        $model = new Main;

        $lang = App::$app->getProperty('lang')['code'];
        $total = \R::count('posts', 'lang_code = ?', [$lang]);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 2;

        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $posts = \R::findAll('posts', "lang_code = ? LIMIT $start, $perpage", [$lang]);
        View::setMeta('Blog :: Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact( 'posts', 'pagination', 'total'));
    }
    
    public function testAction(){
        if($this->isAjax()){
            $model = new Main();
            $post = \R::findOne('posts', "id = {$_POST['id']}");
            $this->loadView('_test', compact('post'));
            die;
        }
        echo 222;
    }
    
}
