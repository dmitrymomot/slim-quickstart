<?php


$app->hook('slim.after.dispatch', function () use ($app) {

        $defaults = array(
            'application/json',
            'application/xml',
            'text/xml',
            'text/csv',
        );

        $contentType = $app->response->headers->get('Content-Type');

        if (in_array($contentType, $defaults))
		{
			$app->response->setBody(json_encode(array('body' => $app->response->getBody())));
		}
});

$app->hook('slim.before.router', function () use ($app) {

	if ($app->request->isAjax())
	{
		$app->response->headers->set('Content-Type', 'application/json');
	}
});

$app->hook('slim.after', function () use ($app) {

	$contentTypes = array('plain/text', 'text/html');
	$contentType = $app->response->headers->get('Content-Type');

	if (in_array($contentType, $contentTypes))
	{
		$data = "<hr/>Time: ".round((microtime(TRUE) - START_TIME), 3)." sec; Memory: ".sprintf('%01.2f', (((memory_get_usage() - START_MEMORY) / 1024) / 1024))." MB";
		echo $data;
	}
});
