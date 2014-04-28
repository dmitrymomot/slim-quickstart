<?php

/**
 * Log request info
 */
$app->hook('log.request.info', function ($msg = null) use ($app) {
	$data = array(
		'Request URL' 		=> $app->request()->getUrl().$app->request()->getPathInfo(),
		'Request referrer' 	=> $app->request()->getReferrer(),
		'Client IP' 		=> $app->request()->getIp(),
		'User Agent' 		=> $app->request()->getUserAgent(),
		'Script name' 		=> $app->request()->getScriptName(),
	);
	$app->log->info($msg, $data);
});

/**
 * Encode body data to Content-Type format
 * @todo handler for all formats
 */
$app->hook('slim.after.dispatch', function () use ($app) {
	$contentType = $app->response->header('Content-Type');
	if ($contentType == 'application/json') {
		$app->response->setBody(json_encode(array('body' => $app->response->getBody())));
	}
});

/**
 * Set response as JSON if request is AJAX
 */
$app->hook('slim.before.router', function () use ($app) {
	if ($app->request->isAjax()) {
		$app->response->header('Content-Type', 'application/json');
	}
});

/**
 * show time and memory
 */
if ($app->config('debug')) {
	$app->hook('slim.after', function () use ($app) {

		$contentTypes = array('plain/text', 'text/html');
		$contentType = $app->response->header('Content-Type');

		if (in_array($contentType, $contentTypes)) {
			$data = '<hr/><small>Time: '.round((microtime(TRUE) - START_TIME), 3).' sec; Memory: '.sprintf('%01.2f', (((memory_get_usage() - START_MEMORY) / 1024) / 1024)).' MB</small>';
			echo $data;
		}
	});
}
