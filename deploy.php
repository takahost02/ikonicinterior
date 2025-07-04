<?php
// === Config ===
$repoPath = '/home/ikonicinterior/accounts.ikonicinterior.com';  
$branch = 'main';
$logFile = '/home/ikonicinterior/accounts.ikonicinterior.com/deploy.log';       

// === Pull and Deploy ===
$cmd = "cd $repoPath && git pull origin $branch && /bin/rsync -av  ./ $repoPath 2>&1";
exec($cmd, $output, $return_var);

// === Logging ===
file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "]\n" . implode("\n", $output) . "\n\n", FILE_APPEND);

// === Response ===
if ($return_var === 0) {
    http_response_code(200);
    echo "✅ Deployment Successful.";
} else {
    http_response_code(500);
    echo "❌ Deployment Failed.\n";
}
?>
