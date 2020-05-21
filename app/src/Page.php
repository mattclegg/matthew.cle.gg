<?php

namespace {

	use SilverStripe\CMS\Model\SiteTree;
	use SilverStripe\Control\Director;

	class Page extends SiteTree
	{
		private static $belongs_many_many = [
			'PositionDescription' => PositionDescription::class
		];

		private static $default_sort = "\"URLSegment\"";

		function Tag()
		{
			if ($this->URLSegment == 'home') {
				return 'web';
			} else {
				return $this->URLSegment;
			}
		}

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