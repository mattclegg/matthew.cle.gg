<?php

namespace {

	use SilverStripe\CMS\Controllers\ContentController;
	use SilverStripe\View\Parsers\URLSegmentFilter;
	use SilverStripe\Control\Director;
	use Grasenhiller\WkHtmlToX\WkPdf;

	class PageController extends ContentController
	{
		private static $allowed_actions = [
			'pdf'
		];

		public function pdf() {
			$pdf = new SS_DOMPDF();
			$pdf->setHTML($this->renderWith('Pdf'));
			$pdf->render();
			$pdf->toFile($this->Link());
		}
	}
}
