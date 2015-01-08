<?php
/**
 * Created by PhpStorm.
 * User: Mike
 * Date: 15/1/4
 * Time: 下午11:22
 */

namespace api\components\base;

use Yii;
use yii\filters\ContentNegotiator;
use yii\base\InvalidConfigException;
use yii\web\Response;
use yii\web\Request;
use yii\web\UnsupportedMediaTypeHttpException;

class MyContentNegotiator extends ContentNegotiator
{
	public $getBodyParam;

	/**
	 * Negotiates the response format.
	 * @param Request $request
	 * @param Response $response
	 * @throws InvalidConfigException if [[formats]] is empty
	 * @throws UnsupportedMediaTypeHttpException if none of the requested content types is accepted.
	 */
	protected function negotiateContentType($request, $response)
	{
		if (!empty($this->formatParam) && ($format = $this->getBodyParam[$this->formatParam]) !== null) {
			if (in_array($format, $this->formats)) {
				$response->format = $format;
				$response->acceptMimeType = null;
				$response->acceptParams = [];
				return;
			} else {
				throw new UnsupportedMediaTypeHttpException('The requested response format is not supported: ' . $format);
			}
		}

		$types = $request->getAcceptableContentTypes();
		if (empty($types)) {
			$types['*/*'] = [];
		}

		foreach ($types as $type => $params) {
			if (isset($this->formats[$type])) {
				$response->format = $this->formats[$type];
				$response->acceptMimeType = $type;
				$response->acceptParams = $params;
				return;
			}
		}

		if (isset($types['*/*'])) {
			// return the first format
			foreach ($this->formats as $type => $format) {
				$response->format = $this->formats[$type];
				$response->acceptMimeType = $type;
				$response->acceptParams = [];
				return;
			}
		}

		throw new UnsupportedMediaTypeHttpException('None of your requested content types is supported.');
	}
}