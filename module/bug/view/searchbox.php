<?php
$searchSeverity = isset($_GET['search_severity']) ? $_GET['search_severity'] : '';
$searchKey = isset($_GET['search_key']) ? $_GET['search_key'] : '';
$searchStatus = isset($_GET['search_status']) ? $_GET['search_status'] : '';
switch($browseType){
    case 'openedbyme':
        include './searchbox_openedbyme.php';
        break;
    case 'resolved': 
    case 'assigntome':
    case 'unresolved':
    case 'closed':
    case 'notconfirmed':
        include './searchbox_assigntome.php';
        break;
    case 'showall':        
        include './searchbox_showall.php';
        break;    
    default :
        include './searchbox_normal.php';
}
?>