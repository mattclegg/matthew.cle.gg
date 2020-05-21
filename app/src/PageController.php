<?php

namespace {

	use SilverStripe\Assets\Filesystem;
	use SilverStripe\CMS\Controllers\ContentController;
	use MattClegg\dompdf\SS_DOMPDF;

	class PageController extends ContentController
	{
		private static $allowed_actions = [
			'pdf',
			'pdfraw'
		];

		public function getRequest()
		{
			if($this->URLSegment) {
				$pdf = new SS_DOMPDF();
				$pdf->loadHtml($this->pdfraw());
				$temporaryPath = tempnam(TEMP_PATH, 'filesystempublisher_');
				if (!file_put_contents($temporaryPath, $pdf->output()) === false) {
					$base = defined('PUBLIC_PATH') ? PUBLIC_PATH : BASE_PATH;
					$publishPath = $base . DIRECTORY_SEPARATOR . 'cache';
					Filesystem::makeFolder(dirname($publishPath));
					rename($temporaryPath, $publishPath . DIRECTORY_SEPARATOR . $this->data()->Tag() . ".pdf");
				}
			}
			return parent::getRequest();
		}

		public function pdfraw()
		{
			return $this->renderWith('Pdf');
		}

		public function pdf() {
			$pdf = new SS_DOMPDF();
			$pdf->loadHtml($this->pdfraw());
			return $pdf->stream(
				"$this->URLSegment.pdf",
				['Attachment' => 0]
			);
		}
	}
}
