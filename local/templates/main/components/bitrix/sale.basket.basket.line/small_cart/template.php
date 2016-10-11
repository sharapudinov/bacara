<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

  $this->createFrame()->begin("Загрузка"); 
?>

<?
$total = 0;
$price = 0;
foreach($arResult['CATEGORIES']['READY'] as $prods) { 
	$total += $prods['QUANTITY'];
	
	
	$price += $prods['QUANTITY'] * $prods['PRICE'];
}

?>

<?if(intval($total) > 0) { ?>
<input type="hidden" class="amount_summ-cart" value="<?=$price?>">
<a href="/cart/" class="cart_link"> Корзина</a>: <?=declOfNum($total, array("товар", "товара", "товаров"))?> на сумму <span class="total_summ-cart"><?=number_format($price, 2, '.', ' ')?></span> руб.
<? } else { ?>
	Корзина пуста
<? } ?>
