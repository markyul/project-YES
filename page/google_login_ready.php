<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/config/oauth_config.php");
?>
<script>
	location.href="<?=($google_client->createAuthUrl())?>";
</script>