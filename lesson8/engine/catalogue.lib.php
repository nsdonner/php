<?php
/**
 * готовим страницу каталога
 * @param $page_vars
 */
function prepareCataloguePage(&$page_vars){
    $goods = getAssocResult("SELECT id_good, good_name, good_price
                           FROM goods 
                           WHERE is_active = 1");

    $page_vars["goods"] = $goods;
}


