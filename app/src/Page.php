<?php

namespace {

	use SilverStripe\CMS\Model\SiteTree;

	class Page extends SiteTree
	{
		private static $belongs_many_many = [
			'PositionDescription' => PositionDescription::class
		];

		function StaticLink($action = null)
		{
			$link = parent::Link($action);
			if ($link == '/') {
				return $link;
			} else {
				return rtrim($link,"/") . ".html";
			}
		}
	}
}