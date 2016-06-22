<?
//se debe incluir para que couch_list_view.php funcione

$couch_types = CouchType::get_all();
$images = get_pictures_for_coachs($couch_list);
if( ! isset($list_header)){
  $list_header="";
}
