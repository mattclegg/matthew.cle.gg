<?php

namespace {

	use SilverStripe\CMS\Controllers\ContentController;

	class PageController extends ContentController
	{
		private static $allowed_actions = [
			'pdf'
		];

		protected function init()
		{
			parent::init();
			// You can include any CSS or JS required by your project here.
			// See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
		}
	}
}
