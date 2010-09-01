<?php

function pager_navigation($pager, $uri)
{
	$navigation = '';

	if ($pager->haveToPaginate())
	{
		$uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';

		$navigation .= $pager->getPage();

		$navigation .= ' de ';

		$navigation .= $pager->getLastPage();

		$navigation .= '&nbsp&nbsp';
		
		$navigation .= link_to(image_tag('/sf/sf_admin/images/first.png', array('border'=> 0)), $uri.'1');
		$navigation .= link_to(image_tag('/sf/sf_admin/images/previous.png', array('border'=> 0)), $uri.$pager->getPreviousPage()).' ';

		$navigation .= ' '.link_to(image_tag('/sf/sf_admin/images/next.png', array('border'=> 0)), $uri.$pager->getNextPage());
		$navigation .= link_to(image_tag('/sf/sf_admin/images/last.png', array('border'=> 0)), $uri.$pager->getLastPage());

	}



	return $navigation;
}
