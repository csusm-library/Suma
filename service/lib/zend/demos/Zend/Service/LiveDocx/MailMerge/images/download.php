<?php

require_once dirname(__FILE__) . '/../../common.php';


system('clear');

print(Demos_Zend_Service_LiveDocx_Helper::wrapLine(
    PHP_EOL . 'Downloading Remotely Stored Images' .
    PHP_EOL .
    PHP_EOL)
);

$mailMerge = new Zend_Service_LiveDocx_MailMerge();

$mailMerge->setUsername(DEMOS_ZEND_SERVICE_LIVEDOCX_USERNAME)
          ->setPassword(DEMOS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

$counter = 1;
foreach ($mailMerge->listImages() as $result) {
    printf('%d) %s', $counter, $result['filename']);
    $image = $mailMerge->downloadImage($result['filename']);
    file_put_contents('downloaded-' . $result['filename'], $image);
    print(" - DOWNLOADED.\n");
    $counter++;
}

print(PHP_EOL);

unset($mailMerge);