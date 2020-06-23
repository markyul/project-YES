<?php

	$response = $youtube->channels->listChannels('snippet', array(
		'id' => "UCeGQoK-ZfaCEuemIiTMY7XQ",
    ));

	print_r($response);
?>