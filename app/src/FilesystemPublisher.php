<?php

namespace {

	use SilverStripe\Control\HTTPResponse;
	use SilverStripe\StaticPublishQueue\Publisher\FilesystemPublisher as SS_FilesystemPublisher;
	use MattClegg\dompdf\SS_DOMPDF;

	class FilesystemPublisher extends SS_FilesystemPublisher
	{
		/**
		 * @var string
		 */
		protected $fileExtension = 'html';

		public function setFileExtension($fileExtension)
		{
			$fileExtension = strtolower($fileExtension);
			if (!in_array($fileExtension, ['html', 'php', 'pdf'])) {
				$fileExtension = 'html';
			}
			$this->fileExtension = $fileExtension;
			return $this;
		}

		/**
		 * @param HTTPResponse $response
		 * @param string       $url
		 * @return bool
		 */
		protected function publishPage($response, $url)
		{
			if ($path = $this->URLtoPath($url)) {

				$urlSegments = explode("/", $path);
				$fileExtension = array_pop($urlSegments);
				if (in_array($fileExtension, ['html', 'php', 'pdf'])) {
					$path = implode("/", $urlSegments);
					$this->setFileExtension($fileExtension);
				}

				if ($this->getFileExtension() === 'php') {
					$phpContent = $this->generatePHPCacheFile($response);
					return $this->saveToPath($phpContent, $path . '.php');
				}

				if ($this->getFileExtension() === 'pdf') {
					$pdfOutput = $this->generatePDFCacheFile($response);
					return $this->saveToPath($pdfOutput, self::pathToFilename($path));
				}

				return $this->saveToPath($response->getBody(), $path . '.html');
			}
			return true;
		}

		/**
		 * Generate the content for a PDF file
		 *
		 * @param HTTPResponse $response
		 *
		 * @return string
		 */
		protected function generatePDFCacheFile($response)
		{
			$pdf = new SS_DOMPDF();
			$pdf->loadHtml($response->getBody());
			return $pdf->output();
		}

		public function getPublishedURLs($dir = null, &$result = [])
		{
			$results = parent::getPublishedURLs($dir,$result);

			foreach ($results as $index=>$path) {
				if(substr("$path", -1) != '/') {
					$results[$index] = $path . "/html";
					$results[] = $path . "/pdf";
				}
			}

			return $results;
		}

		public function purgeURL($url)
		{
			$urlSegments = explode("/", $url);
			$fileExtension = array_pop($urlSegments);
			return parent::purgeURL(implode("/", $urlSegments));
		}

		public static function pathToFilename($path)
		{
			if ($path === 'home') {
				$path = "cv";
			}
			return $path . '.pdf';
		}
	}
}
