<?php
	function loadTemplate($file, $templateVars) {
		extract($templateVars);
		ob_start();
		require $file;
		$content = ob_get_clean();
		return $content;
	}
?>